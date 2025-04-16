<?php
/**
 * Configuration file for Development version
 *   You can create one for:
 *   development.php
 *   staging.php
 *   production.php
 */

/****************************/
/* == Base Configuration == */
/* @var string */
/****************************/

/**
 * Site Base URL with http:// or https:// prefix and trailing slash
 * @var string
 */
$site = "http://".$_SERVER['HTTP_HOST']."/fleet_management2/";
/**
 * URL parse method
 *   - REQUEST_URI, suitable for Nginx
 *   - PATH_INFO, suitable for XAMPP
 *   - ORIG_PATH_INFO
 * @var string
 */
$method = "PATH_INFO";//REQUEST_URI,PATH_INFO,ORIG_PATH_INFO,
/**
 * Admin Secret re-routing
 * this is alias for app/controller/admin/*
 * @var string
 */
$admin_secret_url = 'admin';
/**
 * Base URL with http:// or https:// prefix and trailing slash
 * @var string
 */
$cdn_url = '';

/********************************/
/* == Database Configuration == */
/* Database connection information */
/* @var array of string */
/********************************/
$db['host']  = 'localhost';
$db['user']  = 'root';
$db['pass']  = '';
$db['name']  = 's3demo_fleetmgt2';
$db['port'] = '3306';
$db['charset'] = 'utf8mb4';
$db['engine'] = 'mysqli';
$db['enckey'] = '';

/****************************/
/* == Session Configuration == */
/* @var string */
/****************************/
$saltkey = 's3mEFr4';

/********************************/
/* == Timezone Configuration == */
/* @var string */
/****************************/
$timezone = 'Asia/Jakarta';

/********************************/
/* == Core Configuration == */
/* register your core class, and put it on: */
/*   - app/core/ */
/* all var $core_* value in lower case string*/
/* @var string */
/****************************/
$core_prefix = 'ji_';
$core_controller = 'controller';
$core_model = 'model';

/********************************/
/* == Controller Configuration == */
/* register your onboarding (main) controller */
/*   - make sure dont add any traing slash in array key of routes */
/*   - all var $controller_* value in lower case string */
/*   - example $routes['produk/(:any)'] = 'produk/detail/index/$1' */
/*   - example example $routes['blog/id/(:num)/(:any)'] = 'blog/detail/index/$1/$2'' */
/* @var string */
/****************************/
$controller_main='home';
$controller_404='notfound';

/********************************/
/* == Controller Re-Routing Configuration == */
/* make sure dont add any traing slash in array key of routes */
/* @var array of string */
/****************************/
// $routes['produk/(:any)'] = 'produk/detail/index/$1';
// $routes['blog/id/(:num)/(:any)'] = 'blog/detail/index/$1/$2';


/********************************/
/* == Another Configuration == */
/* configuration are in array of string format */
/*  - as name value pair */
/*  - accessing value by $this->semevar->key in controller extended class */
/*  - accessing value by $this->semevar->key in model extended class */
/****************************/

//firebase messaging
$semevar['fcm'] = new stdClass();
$semevar['fcm']->version = '';
$semevar['fcm']->apiKey = '';
$semevar['fcm']->authDomain = '';
$semevar['fcm']->databaseURL = '';
$semevar['fcm']->projectId = '';
$semevar['fcm']->storageBucket = '';
$semevar['fcm']->messagingSenderId = '';
$semevar['fcm']->appId = '';

// example
$semevar['site_name'] = 'Seme Framework';
$semevar['email_from'] = 'noreply@thecloudalert.com';
$semevar['email_reply'] = 'hi@thecloudalert.com';
$semevar['app_name'] = 'Seme Framework';
$semevar['app_logo'] = 'Seme Framework';

$semevar['site_version'] = '23.12.05';
$semevar['site_title'] = 'Fleet Management';
$semevar['site_name'] = 'Cenah Fleet Management';
$semevar['site_name_admin'] = 'Admin Fleet Management';
$semevar['site_description'] = '';
$semevar['site_email'] = 'hi@cenah.co.id';
$semevar['site_replyto'] = 'hi@cenah.co.id';
$semevar['site_phone'] = '085861624300';
$semevar['site_suffix'] = ' - Fleet Management';
$semevar['site_keyword'] = 'Cenah';
$semevar['site_author'] = 'Cenah';
$semevar['site_logo'] = 'media/logo.png';
$semevar['site_logo_white'] = '';
$semevar['site_login_bg'] = 'media/login-bg.jpg';
$semevar['site_login_logo'] = 'media/login-logo.png';
$semevar['admin_site_suffix'] = ' - Admin Fleet Management';
$semevar['admin_login_bg'] = 'skin/admin/img/background-login.jpg';
$semevar['admin_login_logo'] = 'media/logo.png';
$semevar['header_img'] = 'skin/admin/img/placeholders/headers/dashboard_header.jpg';
$semevar['admin_logo'] = '';
$semevar['email_from'] = 'noreply@thecloudalert.com';
$semevar['email_reply'] = 'hi@thecloudalert.com';
$semevar['app_name'] = 'Fleet Management';
$semevar['app_logo'] = '';
$semevar['app_logo_light'] = '';
$semevar['app_link_android'] = '';
$semevar['app_link_ios'] = '';
$semevar['company_alias'] = 'Cenah';
$semevar['company_name'] = 'PT Cipta Esensi Merenah';
$semevar['company_address'] = 'Jakarta';
$semevar['company_logo'] = '';
$semevar['company_url'] = 'https://www.cenah.co.id/';
$semevar['fcm_server_token'] = '';
$semevar['copyright'] = $semevar['site_title'].' v'.$semevar['site_version'].' '.date('Y');

$semevar['admin_site_title'] = 'Admin Page';
$semevar['admin_site_title_suffix'] = ' - '.$semevar['admin_site_title'];
