<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Home Routing
$route['default_controller'] = 'home';

// Login Routing
$route['login'] = 'Login';
$route['register'] = 'Login/register';
$route['forget'] = 'Login/forgetPassword';
$route['logout'] = 'User/logout';

// User Routing
$route['getProfile'] = 'User/getProfile';
$route['editProfile'] = 'User/editProfile';
$route['editPassword'] = 'User/editPassword';

// Room Vote Routing
$route['room'] = 'Vote/roomVote';
$route['roomDetails/([0-9a-zA-Z]{8})'] = 'Vote/detailVote/$1';
$route['endVote/([0-9a-zA-Z]{8})'] = 'Vote/endVoteNow/$1';
$route['createVote'] = 'Vote/createVote';
