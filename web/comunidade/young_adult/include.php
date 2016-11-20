<?php
	$databases = include '../config.php';

	function get_dbh() {
		global $databases;
		$db_settings = $databases['database'];

		$db_host = $db_settings['host'];
		$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_settings['database'];

		$username = $db_settings['username'];
		$password = $db_settings['password'];
		try {
			$dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $dbh;
		} catch(PDOException $e) {
			echo "Connection to database failed: " . $e->getMessage();
		}

		return false;
	}

	function get_style($dbh) {
		$stmt = $dbh->prepare("SELECT * FROM community_settings WHERE community_settings.key = 'custom_header' OR community_settings.key = 'custom_less'");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	// Checks if the token belongs to a forum admin
	function isAdmin($dbh, $flarum_remember) {
		$stmt = $dbh->prepare("SELECT community_users_groups.user_id FROM community_access_tokens, community_users_groups WHERE community_access_tokens.id = :flarum_remember AND community_users_groups.group_id = 1 AND community_access_tokens.user_id = community_users_groups.user_id");
		$stmt->bindParam(':flarum_remember', $flarum_remember);
		$stmt->execute();
		return $stmt->fetch() != false;
	}

	// Get the current young users that are now over 18
	function getAdultsToNotify($dbh) {
		$stmt = $dbh->prepare("SELECT cuidadores_users.id_community, community_users.username, community_users.email, birthday, CURDATE(), TIMESTAMPDIFF(YEAR,birthday,CURDATE()) AS age FROM cuidadores_users, community_users_groups, community_users WHERE id_community IS NOT NULL AND id_community = community_users.id AND id_community = community_users_groups.user_id AND community_users_groups.group_id = 5 HAVING age >= 18");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	// Moves an user to the adult forum group
	function make_adult($dbh, $user_id) {
		$stmt = $dbh->prepare("UPDATE community_users_groups SET group_id = 6 WHERE group_id = 5  AND user_id = :user_id");
		$stmt->bindParam(':user_id', $user_id);
		$stmt->execute();
	}

	// Returns a list of new adults (over 18 y) that the admin wasn't notfied about yet
	function getAdultsNotNotifiedAdmin($dbh) {
		$stmt = $dbh->prepare("SELECT cuidadores_users.id_community, community_users.username, community_users.email, birthday, CURDATE(), TIMESTAMPDIFF(YEAR,birthday,CURDATE()) AS age FROM cuidadores_users, community_users_groups, community_users WHERE id_community IS NOT NULL AND id_community = community_users.id AND id_community = community_users_groups.user_id AND community_users_groups.group_id = 5 AND NOT cuidadores_users.admin_notified HAVING age >= 18");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	// Marks all the adults (as returned by the function above) as notified
	function markUsersNotified($dbh) {
		$stmt = $dbh->prepare("UPDATE cuidadores_users SET admin_notified = 1 WHERE id_community in (SELECT id_community FROM (SELECT cuidadores_users.id_community as id_community, community_users.username, community_users.email, birthday, CURDATE(), TIMESTAMPDIFF(YEAR,birthday,CURDATE()) AS age FROM cuidadores_users, community_users_groups, community_users WHERE id_community IS NOT NULL AND id_community = community_users.id AND id_community = community_users_groups.user_id AND community_users_groups.group_id = 5 AND NOT cuidadores_users.admin_notified HAVING age >= 18) as tbl)");
		$stmt->execute();
	}
?>