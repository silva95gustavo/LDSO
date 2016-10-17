<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
if ( $_POST['payload']) {
  $payload = json_decode($_POST['payload']);
  if ($payload->ref == "refs/heads/master")
    shell_exec( 'cd /var/www/repo/LDSO/ && git reset --hard HEAD && git pull' );
}
?>