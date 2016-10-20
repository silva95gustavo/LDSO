<?php 
$local_config = dirname(__FILE__) . '/config.local.php';
if (file_exists($local_config)) {
  return include $local_config;
}
return array (
  'debug' => true,
  'database' => 
  array (
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'cuidadores',
    'username' => 'root',
    'password' => 'qlamiepho4',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => 'community_',
    'strict' => false,
  ),
  'url' => 'http://cuidadores.tk/comunidade',
  'paths' => 
  array (
    'api' => 'api',
    'admin' => 'admin',
  ),
);

