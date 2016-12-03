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


		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="userInfo.xls"');
		
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><th>Email</th><th>Faixa Etária</th><th>Username</th><th>Conta Activada</th></tr>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
			echo "<tr>";
			echo "<td>" . $row['email'] . "</td><td>";
			if($row['faixa_etaria'])
				echo $row['faixa_etaria'];
			else echo "null";
			echo "</td><td>";
			if($row['username'])
				echo $row['username'];
			else echo "null";
			echo "</td><td>";
			if($row['activada'])
				echo $row['activada'];
			else echo "null";
			echo "</td>";
			echo "</tr>";
			}

		echo "</table>";

?>