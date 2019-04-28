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
$route['reset/(:any)'] = 'Login/resetPassword/$1';
$route['logout'] = 'User/logout';

// User Routing
$route['user'] = 'User';
$route['getProfile'] = 'User/getProfile';
$route['editProfile'] = 'User/editProfile';
$route['editPassword'] = 'User/editPassword';

// Room Vote Routing
$route['room'] = 'Vote/roomVote';
$route['roomDetails/([0-9a-zA-Z]{5})'] = 'Vote/detailVote/$1';
$route['roomResults/([0-9a-zA-Z]{5})'] = 'Vote/resultVote/$1';
$route['endVote/([0-9a-zA-Z]{5})'] = 'Vote/endVoteNow/$1';
$route['startVote/([0-9a-zA-Z]{5})'] = 'Vote/startVoteNow/$1';
$route['detailVoteChart/([0-9a-zA-Z]{5})'] = 'Vote/detailVoteChart/$1';
$route['submitVote'] = 'Vote/submitVote';
$route['createVote'] = 'Vote/createVote';
$route['deleteVote'] = 'Vote/deleteVote';
$route['updateVote'] = 'Vote/updateVote';

// Save to file
$route['saveToFile/([0-9a-zA-Z]{5})/excel'] = 'Vote/saveToExcel/$1';
$route['saveToFile/([0-9a-zA-Z]{5})/pdf'] = 'Vote/saveToPDF/$1';
