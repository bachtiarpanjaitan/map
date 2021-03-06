<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//custom constant

define('BASE_URL', 'http://localhost/map/');
define('ASSETS',BASE_URL.'assets/');
define('APPNAME','MAPS');
define('USER_SESSION', 'user_session');
define('ACCESSCONTROLALLOWORIGIN','http://localhost/map/');

define('ROLE_ADMIN', 1);
define('ROLE_USER', 2);
define('ROLE_CUSTOMER', 3);

define('STATUS_ALLOWORDER', 1);
define('STATUS_ONBOOKING', 2);
define('STATUS_MAINTENANCE', 3);
define('BLOK_ADMIN', 0);

define('REQUESTTYPE_NEW', 1);
define('REQUESTTYPE_MAINTENANCE', 2);

define('REQUESTSTATUS_PENDING', 1);
define('REQUESTSTATUS_APPROVED', 2);
define('REQUESTSTATUS_REJECTED', 3);

define('UNITTYPE_REGULER', 1);
define('UNITTYPE_DORMITORY', 2);
