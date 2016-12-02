<?php
	 
	namespace Drupal\exportinfo;

	use Drupal\Core\Controller\ControllerBase;
	use Drupal\Core\Database\Driver\mysql;

	
	 
	class exportinfo extends ControllerBase {
	  public function content() {

		$uid = \Drupal::currentUser()->id();

	  	if($uid == 1){
	  	
	  			include '../../../register/include.php';

	  			{
			  	global $databases;
				$db_settings = $databases['default']['default'];

				$db_host = $db_settings['host'] . ":" . $db_settings['port'];
				$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_settings['database'];

				$username = $db_settings['username'];
				$password = $db_settings['password'];
				try {
					$dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch(PDOException $e) {
					echo "Connection to database failed: " . $e->getMessage();
				}
				}
	  			
	  			//$dbh = get_dbh();
	  	
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
	  			}

		}
	}

?>