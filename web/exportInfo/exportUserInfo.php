<?php
	include '../register/include.php';

	$dbh = get_dbh();

	$stmt = $dbh->prepare("	SELECT cuidadores_users.email as email, community_users_groups.group_id as faixa_etaria, community_users.username as username, community_users.is_activated as activada 
								FROM cuidadores_users, community_users_groups, community_users
								WHERE cuidadores_users.id_community = community_users.id AND community_users_groups.user_id = cuidadores_users.id_community
								
							UNION 
							SELECT cuidadores_users.email as email, NULL as faixa_etaria, NULL as username, NULL as activada
								FROM cuidadores_users, community_users_groups, community_users
								WHERE cuidadores_users.id_community IS NULL 
							");
		$stmt->execute();


		header('Content-type: text/html');
		header('Content-Disposition: attachment; filename="downloaded.txt"');
		
		echo "<table>"; // start a table tag in the HTML

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){   //Creates a loop to loop through results
			echo "<tr><td>" . $row['email'] . "</td><td>" . $row['faixa_etaria'] . "</td></tr>". $row['username'] . "</td></tr>". $row['activada'] . "</td></tr>";  //$row['index'] the index here is a field name
			}

echo "</table>";

?>