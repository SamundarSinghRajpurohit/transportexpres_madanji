<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*data table image */
define('DT_HEIGHT','100px');
define('DT_WIDTH','100px');
define('TableStatusName',"Status");
/* company detail */
define('COMPANY_NAME','WEBNAPPMAKER');
define('COMPANY_LINK','http://webnappmaker.in/');
define('ADMIN_COLUMN_NAME','AdminId');
define('D_CONT',"Dashboard");
define('STATUS_NAME','Status');

/*session detail*/
define('SESSION_ID','AdminId');


/* Accounts ID */
define('SUNDRY_CR','26');
define('SUNDRY_DR','2');




/*
custom code for header comman data
*/
define('SAYING','Onpharno pledge to provide a quality product at a reasonable price.If you come in, we will give you a reason to come back.');
define('GOOGLE_MAP_LINK','https://goo.gl/maps/vKj1X18F5WS2');
define('GOOGLE_IFRAME_ADDRESS','https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14884.312196728379!2d72.786624!3d21.149292!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x79c254a80e395372!2sUniverse+Classes!5e0!3m2!1sen!2sin!4v1547645953289');
define('MAIL_TO','admin@webnappmaker.in');
define('PHONE_NO','+91 8511141438');
define('ADDRESS','424, Four Point, VIP Road, Vesu, Surat, India');
define('CORPORATE_OFFICE','PLOT NO 424, FOUR POINT, OPP CB HEALTH CLUB VIP ROAD, VESU, SURAT-395017');
define('BRANCH_OFFICE_MUMBAI','MAC, 14, RAYFREDA BUILDING, NR HOTEL SAI PLACE, ANDHERI KURLA ROAD, ANDHERI (E)-400 059, MUMBAI');
define('BRANCH_OFFICE_PUNE','MAC, 1ST FLOOR, UMED BHAVAN, NR CANARA BANK, STATION ROAD, PIMPARI – 411018, PUNE');
define('INTERNATIONAL','Arab Pharmacy, Tehran Province, Karaj, Charbagh central SQ., Iran,China');

/* for framework*/
define('DETAIL_TABLE','detail');
define('DETAIL_COLUMN','Reference');
define('TABLE_ROW','tableRow');
define('DETAIL_COLUMN_REFERNCE','Reference');
