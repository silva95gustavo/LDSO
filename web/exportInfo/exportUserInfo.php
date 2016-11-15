<?php
	include '../register/include.php';

	$dbh = get_dbh();

	$stmt = $dbh->prepare("	SELECT 1 as type, cuidadores_users.email as email, community_users_groups.group_id as faixa_etaria, community_users.username as username, community_users.is_activated as activada 
								FROM cuidadores_users, community_users_groups, community_users
								WHERE cuidadores_users.id_community = community_users.id AND community_users_groups.user_id = cuidadores_users.id_community
							UNION 
							SELECT 2 as type, cuidadores_users.email as email, NULL as faixa_etaria, NULL as username, NULL as activada
								FROM cuidadores_users, community_users_groups, community_users
								WHERE cuidadores_users.id_community IS NULL 
							UNION
							SELECT 3 as type, community_users.email as email, community_users_groups.group_id as faixa_etaria, community_users.username as username, community_users.is_activated as activada 
								FROM cuidadores_users, community_users_groups, community_users
								WHERE community_users.email NOT IN (SELECT email FROM cuidadores_users) AND community_users_groups.user_id = community_users.id
							");
		$stmt->execute();


		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="userInfo.xls"');
		
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><th>Tipo de Conta</th><th>Email</th><th>Username</th><th>Faixa Etaria</th><th>Conta Activada</th></tr>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
			echo "<tr>";
			echo "<td>";
			switch($row['type']){
				case 1:
					echo "Ambos";
					break;
				case 2:
					echo "Website";
					break;
				case 3:
					echo "Comunidade";
					break;
				default:
					echo "Erro";
					break;
				}
			echo "</td><td>";
			echo $row['email'] . "</td><td>";
			if($row['username'])
				echo $row['username'];
			else echo "Nao Disponivel";
			echo "</td><td>";
			switch($row['faixa_etaria']){
				case 1:
					echo "Admin";
					break;
				case 5:
					echo "Jovem";
					break;
				case 6:
					echo "Adulto";
					break;
				default:
					echo "Nao Disponivel";
					break;
			}
			echo "</td><td>";
			if($row['activada'] == 1)
				echo "Activada";
			else if ($row['activada'] == 0) echo "Desactivada";
			else echo "Nao Disponivel";
			echo "</td>";
			echo "</tr>";
			}

		echo "</table>";

?>