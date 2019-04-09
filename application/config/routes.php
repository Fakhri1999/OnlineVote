<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Home Routing
$route['default_controller'] = 'home';

// Login Routing
$route['login'] = 'Login';
$route['register'] = 'Login/register';
$route['logout'] = 'User/logout';

// User Routing


// Room Vote Routing
$route['room/([0-9a-zA-Z]{5})'] = 'Vote/roomVote/$1';
