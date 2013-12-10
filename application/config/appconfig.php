<?php
/******** setting default time zone ************/

//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set('Asia/Calcutta');

define('RECIPES_UPLOAD_DIR', str_replace("\\","/",FCPATH).'uploads/recipes/');
define('USER_UPLOAD_DIR', str_replace("\\","/",FCPATH).'uploads/users/');
define('INGREDIENTS_UPLOAD_DIR', str_replace("\\","/",FCPATH).'uploads/ingredients/');
define('BULK_UPLOAD_DIR', str_replace("\\","/",FCPATH).'uploads/bulk/');


/************* end default time zone ************/

/************************* start email config *************************/
$config['mail_config']['protocol']		= 'smtp';
$config['mail_config']['charset']		= 'iso-8859-1';
$config['mail_config']['smtp_host']	    = '';
$config['mail_config']['smtp_user']	    = '';
$config['mail_config']['smtp_pass']	    = '';
$config['mail_config']['smtp_port']	    = 587;
$config['mail_config']['smtp_timeout']  = '10';
$config['mail_config']['newline']       = "\r\n";
$config['mail_config']['crlf'] 			= "\r\n";
$config['mail_config']['mailtype']      = 'html'; 
$config['mail_config']['validation']    = TRUE; // bool whether to validate email or not 
$config['mail_config']['smtp_crypto']   = 'tls';  
$config['mail_config']['wordwrap'] 		= FALSE;


$config['web_admin_email_id'] = 'email@globalgraynz.com';
/************************* end email config ***************************/


/************************* start user type config ****************************/

$config['roles'] = array( 0 => 'Admin', 1 => 'User');

/*$config['health_level'][0] = array('id' => 1, 'name'=> 'Cholesterol Friendly');
$config['health_level'][1] = array('id' => 2, 'name'=> 'Pure Taste');
$config['health_level'][2] = array('id' => 3, 'name'=> 'Low Calorie');
$config['health_level'][3] = array('id' => 4, 'name'=> 'Diabetic Friendly');
$config['health_level'][4] = array('id' => 5, 'name'=> 'Nutrient Rich');
$config['health_level'][5] = array('id' => 6, 'name'=> 'Organic');
$config['health_level'][6] = array('id' => 7, 'name'=> 'Gluten Free');*/


/*$config['spice_level'][0] = array('id' => 1, 'name'=> 'None');
$config['spice_level'][1] = array('id' => 2, 'name'=> 'Mild');
$config['spice_level'][2] = array('id' => 3, 'name'=> 'Medium');
$config['spice_level'][3] = array('id' => 4, 'name'=> 'Hot');
$config['spice_level'][4] = array('id' => 5, 'name'=> 'Fiery');*/

$config['expert_level'][0] = array('id' => 1, 'name'=> 'Novice');
$config['expert_level'][1] = array('id' => 2, 'name'=> 'Intermediate');
$config['expert_level'][2] = array('id' => 3, 'name'=> 'Expert');
 

/*$config['food_type'][0] = array('id' => 1, 'name'=> 'Veg');
$config['food_type'][1] = array('id' => 2, 'name'=> 'Non-Veg');*/

$config['country'] = array('356' => 'India', '1' => 'United States of America');

$config['1states'] =  array(	
					 			'1' => 'Alabama', 
					 			'2' => 'Alaska',
					 			'3' => 'Arizona',
					 			'4' => 'Arkansas',
					 			'5' => 'California',
					 			'6' => 'Colorado',
					 			'7' => 'Connecticut',
					 			'8' => 'Delaware',
					 			'9' => 'Florida',
					 			'10' => 'Georgia',
					 			'11' => 'Hawaii',
					 			'12' => 'Idaho',
					 			'13' => 'Illinois',
					 			'14' => 'Indiana',
					 			'15' => 'Iowa',
					 			'16' => 'Kansas',
					 			'17' => 'Kentucky',
					 			'18' => 'Louisiana',
					 			'19' => 'Maine',
					 			'20' => 'Maryland',
					 			'21' => 'Massachusetts',
					 			'22' => 'Michigan',
					 			'23' => 'Minnesota',
					 			'24' => 'Mississippi',
					 			'25' => 'Missouri',
					 			'26' => 'Montana',
					 			'27' => 'Nebraska',
					 			'28' => 'Nevada',
					 			'29' => 'New Hampshire',
					 			'30' => 'New Jersey',
					 			'31' => 'New Mexico',
					 			'32' => 'New York',
					 			'33' => 'North Carolina',
					 			'34' => 'North Dakota',
					 			'35' => 'Ohio',
					 			'36' => 'Oklahoma',
					 			'37' => 'Oregon',
					 			'30' => 'Pennsylvania',
					 			'39' => 'Rhode Island',
					 			'40' => 'South Carolina',
					 			'41' => 'South Dakota',
					 			'42' => 'Tennessee',
					 			'43' => 'Texas',
					 			'44' => 'Utah',
					 			'45' => 'Vermont',
					 			'46' => 'Virginia',
					 			'47' => 'Washington',
					 			'48' => 'West Virginia',
					 			'49' => 'Wisconsin',
					 			'50' => 'Wyoming',
					 			'51' => 'Washington D.C.'
 			);

$config['356states'] = array(	'1'	=> 'Andhra Pradesh',
							'2' => 'Arunachal Pradesh',
							'3' => 'Assam',
							'4' => 'Bihar',
							'5' => 'Chhattisgarh',
							'6' => 'Goa',
							'7' => 'Gujarat',
							'8' => 'Haryana',
							'9' => 'Himachal Pradesh',
							'10' => 'Jammu and Kashmir',
							'11' => 'Jharkhand',
							'12' => 'Karnataka',
							'13' => 'Kerala',
							'14' => 'Madhya Pradesh',
							'15' => 'Maharashtra',
							'16' => 'Manipur',
							'17' => 'Meghalya',
							'18' => 'Mizoram',
							'19' => 'Nagaland',
							'20' => 'Odisha',
							'21' => 'Punjab',
							'22' => 'Rajasthan',
							'23' => 'Sikkim',
							'24' => 'TamilNadu',
							'25' => 'Tripura',
							'26' => 'Uttar Pradesh',
							'27' => 'Uttarakhand',
							'28' => 'West Bengal'
						);


$config['order_status'] = array(	0 => 'Pending', 
									1 => 'Payment Received via Phone', 
									2 => 'Shipped', 
									3 => 'Delivered',
									4 => 'Delivered and Payment Received',
									5 => 'Abort',
									6 => 'Completed'
									 );
$config['max_amount_to_avoid_shipping'] = 400;
$config['shipping_charges'] = 100;
/************************* end user type config ****************************/

$config['allmimetypes'] =  array('image/jpeg','image/gif','image/png',' application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/excel', 'application/vnd.ms-excel', 'application/msexcel','application/excel','application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv');
$config['allfiletypes'] = '*'; //'gif|jpg|png|jpeg|xlsx|xls|csv';
$config['allfilesize'] = '900000';


?>