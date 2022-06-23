<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//echo $_SERVER['SERVER_NAME'];
$route['default_controller'] 					= 	'welcome/index';
$route['404_override'] 							= 	'';
$route['translate_uri_dashes'] 					= 	FALSE;

$route['about-us'] 								= 	'about/index';
$route['contact-us'] 							= 	'contact/index';

$route['login/(:any)'] 							= 	'home/check/$1';

$route['login'] 								= 	'login/index';
$route['logout'] 								= 	'login/logout';
$route['sign-up'] 								= 	'signup/index';

$route['my-profile'] 							= 	'profile/index';
$route['edit-profile/(:any)'] 					= 	'profile/editprofile/$1';

$route['my-cart'] 								= 	'profile/cart';

$route['add-retailer/(:any)'] 					= 	'profile/addUsers/$1';
$route['add-user'] 								= 	'profile/addUsers';
$route['add-user/(:any)'] 						= 	'profile/addUsers/$1';

$route['top-up-recharge'] 						= 	'profile/recharge';

$route['refresh-point'] 						= 	'profile/refreshpoint';
$route['my-coupon'] 							= 	'profile/couponList';
$route['my-coupon/(:any)'] 						= 	'profile/couponList/$1';

$route['shopping-cart'] 						= 	'shopping_cart/index';
$route['user-cart'] 							= 	'shopping_cart/index';

$route['remove-item/(:any)'] 					= 	'shopping_cart/remove_items/$1';

$route['place-order'] 							= 	'order/placeOrder';					//not in used
$route['checkout'] 							    = 	'order/index';
$route['order-success/(:any)'] 					= 	'order/success/$1';


$route['order-list'] 							= 	'order/orderList';
$route['order-list/(:any)'] 					= 	'order/orderList/$1';

$route['my-wishlist'] 							= 	'profile/mywishlist';
$route['my-wishlist/(:any)'] 					= 	'profile/mywishlist/$1';

$route['dilivery-address'] 						= 	'diliveryAddress/index';
$route['add-dilivery-address'] 					= 	'diliveryAddress/create';
$route['edit-dilivery-address'] 				= 	'diliveryAddress/edit';
$route['edit-dilivery-address/(:any)'] 			= 	'diliveryAddress/edit/$1';
$route['delete-dilivery-address'] 				= 	'diliveryAddress/delete';
$route['delete-dilivery-address/(:any)'] 		= 	'diliveryAddress/delete/$1';

$route['productDetails'] 						= 	'product/index';
$route['product-details/(:any)'] 				= 	'products/productDetails/$1';
$route['product-details/(:any)/(:any)'] 		= 	'products/productDetails/$1/$2';
$route['our-products'] 							= 	'product_list/index';
$route['add-to-wishlist'] 						= 	'products/addtowishlist';

$route['winners-list'] 							= 	'winners/index';

$route['earning'] 								= 	'earning/index';
$route['help'] 									= 	'help/index';

$route['terms-condition'] 						= 	'termconditions/index';
$route['charities'] 						    = 	'charities/index';
$route['how-it-works'] 						    = 	'howitworks/index';
$route['faqs'] 					            	= 	'faqs/index';


$route['user-agreement'] 						= 	'user_agreement/index';
$route['privacy-policy'] 						= 	'privacypolicy/index';
$route['check-mobile'] 							= 	'signup/checkDuplicateMobile';
$route['check-email'] 							= 	'signup/checkDuplicateEmail';

$route['forgot-password']                       =   'login/forgotpassword';

$route['password-recover']                      =   'login/passwordrecover';


$route['delivery-policy'] 						= 	'deliverypolicy/index';
$route['cancellation-policy'] 					= 	'cancellationpolicy/index';
$route['refund-policy'] 						= 	'refundpolicy/index';


//echo '<pre>';  print_r($route); die;
