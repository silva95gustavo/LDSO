<?php
	if(file_exists('../sites/default/settings.php'))
		include '../sites/default/settings.php';
	else
		include '../../sites/default/settings.php';

	function get_dbh() {
		global $databases;
		$db_settings = $databases['default']['default'];

		$db_host = $db_settings['host'] . ":" . $db_settings['port'];
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

	function get_next_uid($dbh) {
		if(!$dbh->inTransaction())
			throw new Exception("dhh is not in transaction, uid might be used");

		$stmt = $dbh->prepare("SELECT MAX(uid) + 1 as uid FROM users");
		$stmt->execute();
		return $stmt->fetch()['uid'];
	}

	// returns false if no user, else the community/site ids
	function get_user($dbh, $email) {
		$stmt = $dbh->prepare("SELECT * FROM cuidadores_users WHERE email = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		return $stmt->fetch();
	}

	function check_password_site($dbh, $id, $password) {
		$stmt = $dbh->prepare("SELECT pass FROM users_field_data WHERE uid = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch();
		return $res && password_verify($password, $res['pass']);
	}

	function check_password_community($dbh, $id, $password) {
		$stmt = $dbh->prepare("SELECT password FROM community_users WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch();
		return $res && password_verify($password, $res['password']);
	}

	function nickname_exists($dbh, $nickname) {
		$stmt = $dbh->prepare("SELECT id FROM community_users WHERE username = :nickname");
		$stmt->bindParam(':nickname', $nickname);
		$stmt->execute();
		return $stmt->fetch() != false;
	}

	function create_user($dbh, $email, $id_site, $id_community, $birthday, $name, $associate_nr, $activate_token) {
		$query = 'INSERT INTO cuidadores_users (email';

		if($id_site) $query = $query . ',id_site';
		if($id_community) $query = $query . ',id_community';
		if($birthday) $query = $query . ',birthday';
		if($name) $query = $query . ',name';
		if($associate_nr) $query = $query . ',associate_nr';
		if($activate_token) $query = $query . ',activate_token';

		$query = $query . ') VALUES (:email';

		if($id_site) $query = $query . ',:id_site';
		if($id_community) $query = $query . ',:id_community';
		if($birthday) $query = $query . ',:birthday';
		if($name) $query = $query . ',:name';
		if($associate_nr) $query = $query . ',:associate_nr';
		if($activate_token) $query = $query . ',:activate_token';

		$query = $query . ');';

		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':email', $email);
		if($id_site) $stmt->bindParam(':id_site', $id_site);
		if($id_community) $stmt->bindParam(':id_community', $id_community);
		if($birthday) {
			$birthday_str = $birthday->y . ":" . $birthday->m . ":" . $birthday->d;
			$stmt->bindParam(':birthday', $birthday_str);
		}
		if($name) $stmt->bindParam(':name', $name);
		if($associate_nr) $stmt->bindParam(':associate_nr', $associate_nr);
		if($activate_token) $stmt->bindParam(':activate_token', $activate_token);
		
		$stmt->execute();
	}

	function update_user($dbh, $email, $id_site, $id_community, $birthday, $name, $associate_nr) {
		$query = 'UPDATE cuidadores_users ';

		$set = false;

		if($id_site) $query = $query . ($set ? ',' : 'SET') . ' id_site = :id_site';
		$set = $set || $id_site;
		if($id_community) $query = $query . ($set ? ',' : 'SET') . ' id_community = :id_community';
		$set = $set || $id_community;
		if($birthday) $query = $query . ($set ? ',' : 'SET') . ' birthday = :birthday';
		$set = $set || $birthday;
		if($name) $query = $query . ($set ? ',' : 'SET') . ' name = :name';
		$set = $set || $name;
		if($associate_nr) $query = $query . ($set ? ',' : 'SET') . ' associate_nr = :associate_nr';
		$set = $set || $associate_nr;
		
		$query = $query . ' WHERE email = :email;';

		$stmt = $dbh->prepare($query);
		if($id_site) $stmt->bindParam(':id_site', $id_site);
		if($id_community) $stmt->bindParam(':id_community', $id_community);
		if($birthday) {
			$birthday_str = $birthday->y . ":" . $birthday->m . ":" . $birthday->d;
			$stmt->bindParam(':birthday', $birthday_str);
		}
		if($name) $stmt->bindParam(':name', $name);
		if($associate_nr) $stmt->bindParam(':associate_nr', $associate_nr);

		$stmt->bindParam(':email', $email);
		$stmt->execute();
	}

	function create_user_drupal($dbh, $name, $email, $password, $status) {
		if(!$dbh->inTransaction())
			throw new Exception("dhh is not in transaction");

		$uid = get_next_uid($dbh);
		$uuid = gen_uuid();
		$langcode = 'pt-pt';

		$stmt = $dbh->prepare("INSERT INTO users (uid, uuid, langcode) VALUES (:uid, :uuid, :langcode)");
		$stmt->bindParam(':uid', $uid);
		$stmt->bindParam(':uuid', $uuid);
		$stmt->bindParam(':langcode', $langcode);
		$stmt->execute();

		$stmt = $dbh->prepare("INSERT INTO users_field_data (uid, langcode, preferred_langcode, name, pass, mail, timezone, status, created, changed, access, login, default_langcode) VALUES (:uid, :langcode, :langcode, :name, :pass, :mail, 'UTC', :status, :cur_time, :cur_time, 0, 0, 1)");

		$pass = password_hash($password, PASSWORD_DEFAULT);
		$cur_time = time();

		$stmt->bindParam(':uid', $uid);
		$stmt->bindParam(':langcode', $langcode);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':pass', $pass);
		$stmt->bindParam(':mail', $email);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':cur_time', $cur_time);
		$stmt->execute();

		return $uid;
	}

	function create_user_flarum($dbh, $username, $email, $password, $status) {
		if(!$dbh->inTransaction())
			throw new Exception("dhh is not in transaction");

		$password_hash = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $dbh->prepare("INSERT INTO community_users (username, email, password, join_time, is_activated) VALUES (:username, :email, :password, NOW(), :status)");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password_hash);
		$stmt->bindParam(':status', $status);
		$stmt->execute();

		$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() as id FROM community_users");
		$stmt->execute();
		$id = $stmt->fetch()['id'];

		return $id;
	}

	function set_flarum_user_group($dbh, $user_id, $group_id) {
		$stmt = $dbh->prepare("INSERT INTO community_users_groups (user_id, group_id) VALUES (:user_id, :group_id)");
		$stmt->bindParam(':user_id', $user_id);
		$stmt->bindParam(':group_id', $group_id);
		$stmt->execute();
	}

	function get_flarum_group($age) {
		$FLARUM_YOUNG = 5;
		$FLARUM_ADULT = 6;
		return $age >= 18 ? $FLARUM_ADULT : $FLARUM_YOUNG;
	}

	function activate_user($dbh, $email, $activate_token) {
		if(!$dbh->inTransaction())
			throw new Exception("dbh is not in transaction");

		$user = get_user($dbh, $email);

		if(!$user)
			return "User not found.";

		// Check token
		if($user['activate_token'] !== $activate_token)
			return "Invalid activation token";

		// Remove token
		$stmt = $dbh->prepare("UPDATE cuidadores_users SET activate_token = NULL WHERE email = :email AND activate_token = :activate_token");
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':activate_token', $activate_token);
		$stmt->execute();

		// Activate Drupal
		if($user['id_site']) {
			$stmt = $dbh->prepare("UPDATE users_field_data SET status = 1 WHERE uid = :uid");
			$stmt->bindParam(':uid', $user['id_site']);
			$stmt->execute();
		}

		// Activate Flarum
		if($user['id_community']) {
			$stmt = $dbh->prepare("UPDATE community_users SET is_activated = 1 WHERE id = :id");
			$stmt->bindParam(':id', $user['id_community']);
			$stmt->execute();
		}

		return false;
	}

	// http://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
	function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,

			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
?>