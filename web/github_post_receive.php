<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
if ( $_POST['payload']) {
  $payload = json_decode($_POST['payload']);
  if ($payload->ref == "refs/heads/master")
    shell_exec( 'cd /var/www/repo/LDSO/ && git reset --hard HEAD && git pull' );
  else if ($payload->ref == "refs/heads/develop")
    shell_exec( 'cd /var/www/devrepo/LDSO/ && git reset --hard HEAD && git pull' );
}
?>
