<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "landing";
$route['404_override'] = '';

$route['login'] = 'auth/login_form';
$route['register'] = 'auth/registration_form';

$route['survey_settings/(:num)'] = 'survey_settings/settings/$1';
$route['survey_builder/(:num)'] = 'survey_builder/builder/$1';
$route['survey_send/(:num)'] = 'survey_send/send/$1';
$route['survey_analyze/(:num)'] = 'survey_analyze/analyze/$1';
$route['take_survey/(:num)'] = 'take_survey/render_survey/$1';


$route['assets/(:any)'] = 'assets/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */