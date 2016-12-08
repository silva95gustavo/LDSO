<?php
	
	namespace Drupal\exportinfo;

	use Drupal\Core\Controller\ControllerBase;
	use Drupal\Core\Database\Database;
	use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Symfony\Component\HttpFoundation\Response;
	 
	class exportinfo extends ControllerBase {

	  public function content() {

		$uid = \Drupal::currentUser()->id();

	  	if($uid == 1){

				$dbh = Database::getConnection();
	  	
	  			$stmt = db_query("	SELECT 1 as type, cuidadores_users.associate_nr as associate_nr, cuidadores_users.name as name, cuidadores_users.email as email, community_users_groups.group_id as faixa_etaria, community_users.username as username, community_users.is_activated as activada 
										FROM cuidadores_users, community_users_groups, community_users
										WHERE cuidadores_users.id_community = community_users.id AND community_users_groups.user_id = cuidadores_users.id_community
									UNION 
									SELECT 2 as type, cuidadores_users.associate_nr as associate_nr, cuidadores_users.name as name, cuidadores_users.email as email, NULL as faixa_etaria, NULL as username, NULL as activada
										FROM cuidadores_users, community_users_groups, community_users
										WHERE cuidadores_users.id_community IS NULL 
									UNION
									SELECT 3 as type, NULL as associate_nr, NULL as name,community_users.email as email, community_users_groups.group_id as faixa_etaria, community_users.username as username, community_users.is_activated as activada 
										FROM cuidadores_users, community_users_groups, community_users
										WHERE community_users.email NOT IN (SELECT email FROM cuidadores_users) AND community_users_groups.user_id = community_users.id
									");
	  				
	  				$string = "<table>"; // start a table tag in the HTML
	  				$string = $string . "<tr><th>Tipo de Conta</th><th>Email</th><th>Nome</th><th>Nr Associado</th><th>Username</th><th>Faixa Etaria</th><th>Conta Activada</th></tr>";
	  	
	  				while ($row = $stmt->fetchAssoc()){  
	  					$string = $string . "<tr>";
	  					$string = $string . "<td>";
	  					switch($row['type']){
	  						case 1:
	  							$string = $string . "Ambos";
	  							break;
	  						case 2:
	  							$string = $string . "Website";
	  							break;
	  						case 3:
	  							$string = $string . "Comunidade";
	  							break;
	  						default:
	  							$string = $string . "Erro";
	  							break;
	  						}
	  					$string = $string . "</td><td>";
	  					$string = $string . $row['email'] . "</td><td>";
						if($row['name'])
							$string = $string . $row['name'];
						else $string = $string . "Nao Disponivel";
	  					$string = $string . "</td><td>";
						if($row['associate_nr'])
							$string = $string . $row['associate_nr'];
						else $string = $string . "Nao Disponivel";
	  					$string = $string . "</td><td>";
	  					if($row['username'])
	  						$string = $string . $row['username'];
	  					else $string = $string . "Nao Disponivel";
	  					$string = $string . "</td><td>";
	  					switch($row['faixa_etaria']){
	  						case 1:
	  							$string = $string . "Admin";
	  							break;
	  						case 5:
	  							$string = $string . "Jovem";
	  							break;
	  						case 6:
	  							$string = $string . "Adulto";
	  							break;
	  						default:
	  							$string = $string . "Nao Disponivel";
	  							break;
	  					}
	  					$string = $string . "</td><td>";
	  					if($row['activada'] == 1)
	  						$string = $string . "Activada";
	  					else if ($row['activada'] == 0) $string = $string . "Desactivada";
	  					else $string = $string . "Nao Disponivel";
	  					$string = $string . "</td>";
	  					$string = $string . "</tr>";
	  					}
		  	
	  				$string = $string . "</table>";

	  				$response = $string;

					header('Content-type: application/vnd.ms-excel');
					header('Content-Disposition: attachment; filename="userInfo.xls"');
	  				
	  				return new Response($response);
	  				}
	  			else
	  			{
	  				throw new AccessDeniedHttpException();
	  			}
		}
	}

?>