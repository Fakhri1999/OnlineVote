<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
   // 'hostname' => ENVIRONMENT === 'production' ? getenv('DB_HOST') : 'localhost',
	// 'username' => ENVIRONMENT === 'production' ? getenv('DB_USER') : 'root',
	// 'password' => ENVIRONMENT === 'production' ? getenv('DB_PASSWORD') : '',
	// 'database' => ENVIRONMENT === 'production' ? getenv('DB_NAME') : 'onvot',
	'hostname' => getenv('DB_HOST'),
	'username' => getenv('DB_USER'),
	'password' => getenv('DB_PASSWORD'),
	'database' => getenv('DB_NAME'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
