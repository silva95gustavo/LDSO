<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
if ( $_POST['payload'] && $_POST['payload']['ref'] == "refs/head/master" ) {
  shell_exec( 'cd /var/www/html/ && git reset --hard HEAD && git pull' );
}
?>