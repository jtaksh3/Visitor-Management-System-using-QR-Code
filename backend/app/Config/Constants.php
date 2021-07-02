<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

define('_USERS_TABLE', 'Users');
define('_USERS_ADDITIONAL_DETAILS_TABLE', 'Users_Additional_Details');
define('_ADDRESSES_TABLE', 'Addresses');
define('_SLOTS_TABLE', 'Slots');
define('_AUTHENTICATION_TOKENS_TABLE', 'AuthenticationTokens');

define('_ID', 'id');
define('_STATUS', 'status');
define('_CREATED_AT', 'created_at');
define('_UPDATED_AT', 'updated_at');

define('_EMAIL', 'email');
define('_PASSWORD', 'password');
define('_ROLE', 'role');
define('_USER_ADDITIONAL_DETAILS_ID', 'user_additional_details_id');

define('_FULL_NAME', 'full_name');
define('_DESIGNATION', 'designation');
define('_ORGANIZATION', 'organization');
define('_PHONE_NO', 'phone_no');
define('_ADDRESS_ID', 'address_id');

define('_ADDRESS_LINE_1', 'address_line_1');
define('_ADDRESS_LINE_2', 'address_line_2');
define('_ADDRESS_LINE_3', 'address_line_3');
define('_CITY', 'city');
define('_STATE', 'state');
define('_COUNTRY', 'country');
define('_PINCODE', 'pincode');

define('_VISITOR_ID', 'visitor_id');
define('_HOST_ID', 'host_id');
define('_MEETING_AT', 'meeting_at');

define('_USER_ID', 'user_id');
define('_TOKEN', 'token');

define('_USER', 'user');
define('_USER_ADDITIONAL_DETAILS', 'user_additional_details');
define('_ADDRESS', 'address');
define('_LOGIN_CREDENTIALS', 'login_credentials');
define('_AUTHORIZATION', 'Authorization');
define('_ADMIN', 'admin');


define('_ACTIVE', 'active');
define('_NOT_ACTIVE', 'not_active');
define('_RETURN_TYPE', 'array');
define('_RESPONSE', 'response');
define('_SUCCESS_', 'success.');
define('_FAILED_', 'failed.');
define('_MESSAGE_', 'message');
define('_DATA', 'data');
define('_CONTENT_TYPE', 'application/json');
define('_NO_INPUTS_', 'no inputs entered');
define('_MISSING_FIELDS_', 'one or more fields are missing');
define('_ALREADY_EXISTS_', ' already exists');
define('_INCORRECT_CREDENTIALS_', 'invalid credentials entered');
define('_UNAUTHORIZED_', 'unauthorized user');
define('_NOT_EXISTS_', ' not exists.');


define('_CREATED_SUCCESS_', ' created successfully.');
define('_DELETED_SUCCESS_', ' deleted successfully.');
define('_UPDATED_SUCCESS_', ' updated successfully.');
define('_LOGIN_SUCCESS_', 'user login successful');

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
