<?php

if ( ! function_exists('isLoggedIn'))
{
	function isLoggedIn(){
		$CI =& get_instance();

		$userName =  $CI->session->userdata('e');
		if(!$userName) 
			return FALSE;
		return TRUE;
	}
}


if(! function_exists('generatePassword'))
{
	function generatePassword(){
		$uchars = range('A','Z');
		$lchars = range('a','z');
		return  $uchars[rand(0,25)].
				$uchars[rand(0,25)].
				$lchars[rand(0,25)].
				$uchars[rand(0,25)].
				$lchars[rand(0,25)].
				rand(1,40).
				rand(1,40).
				$lchars[rand(0,25)];
	}
}

if ( ! function_exists('validateAccess'))
{
function validateAccess($user_id){
		if(empty($user_id)) return FALSE;
		
		$CI =& get_instance();

		$sql = "select * from users";
		$sql .= " where id= '".$user_id."' and status=1";
		$query = $CI->db->query($sql);
		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	} 
}

if ( ! function_exists('get_loggedin_role_redirect'))
{
	function get_loggedin_role_redirect()
	{
		$CI =& get_instance();
		$role = $CI->session->userdata('r');

		if(is_string($role)){

			if($role == 0){
				redirect('admindashboard', 'refresh');
			} 

			if($role == 1){
				redirect('welcome', 'refresh');
			} 
		}
	}
}

if ( ! function_exists('checkForValidAccess'))
{
	function checkForValidAccess($giveAccessTo){

		$CI =& get_instance();
		$currentRole =  $CI->session->userdata('r');

		if($currentRole === FALSE) return FALSE;
		
		if(!in_array($currentRole,$giveAccessTo))
		{
			return FALSE;
		}
		return TRUE;
	}
}

if ( ! function_exists('getCuisineName'))
{

	function getCuisineName($cs,$cid){
		foreach ($cs as $c) {
			if($c['id'] ==  $cid)
				return $c['name'];
		}
	}
}

if ( ! function_exists('convert_date_format'))
{
	function convert_date_format($date,$format)
	{
		if($format =='e2m' && $date)
		{
			$dateArray = explode('/',$date);
			return $dateArray[2].'-'.$dateArray[0].'-'.$dateArray[1];
		}
		
		if($format == 'm2e' && $date)
		{
			$dateArray = explode('-',$date);
			return $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
		}
		return '';
	}
}

if ( ! function_exists('convert_date_time_format'))
{
	function convert_date_time_format($date,$format)
	{
		if($format =='e2m' && $date)
		{
			$datetime = explode(' ',$date);
			$time ='';
			if(count($datetime))
			{
				if(isset($datetime[0]))
				{
					$dateArray = explode('/',$datetime[0]);
					$date = $dateArray[1].'-'.$dateArray[2].'-'.$dateArray[0];
				}
				if(isset($datetime[1]))
				{
					$timeArray = explode(':',$datetime[1]);
					$time = $timeArray[0].':'.$timeArray[1].':'.$timeArray[2];
				}
				return $date.' '.$time;
			}
			return false;
		}
		
		if($format == 'm2e' && $date)
		{
			$datetime = explode(' ',$date);
			$time ='';
			if(count($datetime))
			{
				if(isset($datetime[0]))
				{
					$dateArray = explode('-',$datetime[0]);
					$date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
				}
				if(isset($datetime[1]))
				{
					$timeArray = explode(':',$datetime[1]);
					$time = $timeArray[0].':'.$timeArray[1].':'.$timeArray[2];
				}
				return $date.' '.$time;
			}
			return false;
		}
	}
}

if ( ! function_exists('createForbiddenFile'))
{
	function createForbiddenFile($path){
		$content = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
		$ourFileHandle = fopen($path.'/index.html', 'w');
		fwrite($ourFileHandle, $content);
		fclose($ourFileHandle);
	}
}


if ( ! function_exists('create_user_directory'))
{
	function create_user_directory($uid,$path)
	{ 
		if(!is_dir($path.$uid))
		{
			mkdir($path.$uid, 0777);
			createForbiddenFile($path.$uid);
		}
	}
}

if ( ! function_exists('uploadAttachments'))
{
	function uploadAttachments($field,$uploadTo,$filesname,$filename){

		$CI =& get_instance();

		$config['upload_path'] = $uploadTo;
		$config['allowed_types'] = $CI->config->item('allfiletypes');
		$config['max_size'] = $CI->config->item('allfilesize');
		$config['max_width'] = '0';
		$config['max_height'] = '0';

		$CI->load->library('upload', $config);
		if(!empty($filesname)){
			$config['file_name'] = clean_file_name($filename);
			$CI->upload->initialize($config);
			if ( ! $CI->upload->do_upload($field)){
				$error = array('error' => $CI->upload->display_errors());
				log_message('error', 'library::uploadAllAttachments'.print_r($error,1));
				print_r($error); print_r($this->upload->data()); exit;
				return false;
			}
		}
		return true;
	}
}

if( ! function_exists('getStateName'))
{
	function getStateName($id,$countryId=356){
		$CI =& get_instance();
		$states = $CI->config->item($countryId.'states');
		return $states[$id];
	}
}

if( ! function_exists('getCountry'))
{
	function getCountry($id){
		$CI =& get_instance();
		$country = $CI->config->item('country');
		return $country[$id];
	}
}


if ( ! function_exists('showBanner'))
{
	function showBanner(){
		return '<div class="container">
		    <div class="row-fluid">
				<div class="banner">
				<ul>
				<li>
				<a href="javascript:void(0);" class="subscribe" >
					
				 <img src="'.base_url().'images/bannerpic-new.png" alt="food experience" /> 

					
					</a>
					</li>
					<ul>
				</div>   	
	        </div>
	    </div>';

	}
}


if ( ! function_exists('getHealthLevelId'))
{
	function getHealthLevelId($hl){
		$CI =& get_instance();
		$health_level = $CI->config->item('health_level');
		$hlcount = count($health_level);
		$id = '';
		for($i=0; $i<$hlcount; $i++){
			if(strtolower($health_level[$i]['name']) == strtolower($hl)){
				$id = $health_level[$i]['id'];
				break;
			}
		}
		return $id;
	}
}


if ( ! function_exists('getSpiceLevelId'))
{
	function getSpiceLevelId($sl){
		$CI =& get_instance();
		$spice_level = $CI->config->item('spice_level');
		$slcount = count($spice_level);
		$id = '';
		for($i=0; $i<$slcount; $i++){
			if(strtolower($spice_level[$i]['name']) == strtolower($sl)){
				$id = $spice_level[$i]['id'];
				break;
			}
		}
		return $id;
	}
}

if ( ! function_exists('getExpertLevelId'))
{
	function getExpertLevelId($el){
		$CI =& get_instance();
		$expert_level = $CI->config->item('expert_level');
		$elcount = count($expert_level);
		$id = '';
		for($i=0; $i<$elcount; $i++){
			if(strtolower($expert_level[$i]['name']) == strtolower($el)){
				$id = $expert_level[$i]['id'];
				break;
			}
		}
		return $id;
	}
}


if ( ! function_exists('getSeoUrl'))
{
	function getSeoUrl($title,$id){
		// replace non letter or digits by -
	  $title = preg_replace('~[^\\pL\d]+~u', '-', $title);

	  // trim
	  $title = trim($title, '-');

	  // transliterate
	  $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);

	  // lowercase
	  $title = strtolower($title);

	  // remove unwanted characters
	  $title = preg_replace('~[^-\w]+~', '', $title);

	  if (empty($title))
	  {
	    return 'n-a'.'-'.$id;
	  }

	  return $title.'-'.$id;

	}
}

if(! function_exists('isProductInCart'))
{
	function isProductInCart($iid){
		$CI =& get_instance();
		$CI->load->library('cart');
		foreach ($CI->cart->contents() as $items){
			if($items['id'] == $iid)
				return TRUE;
		}
		return FALSE;
	}
}

if(! function_exists('clean_file_name'))
{
	function clean_file_name($filename){
		$bad = array(
						"<!--",
						"-->",
						"'",
						"<",
						">",
						'"',
						'&',
						'$',
						'=',
						';',
						'?',
						'/',
						"%20",
						" ",
						"%22",
						"%3c",		// <
						"%253c",	// <
						"%3e",		// >
						"%0e",		// >
						"%28",		// (
						"%29",		// )
						"%2528",	// (
						"%26",		// &
						"%24",		// $
						"%3f",		// ?
						"%3b",		// ;
						"%3d"		// =
					);

		$filename = str_replace($bad, '', $filename);

		return stripslashes($filename);
	}
}


if(! function_exists('sendggmail'))
{
	function sendggmail($to,$cc,$bcc,$subject,$message){

		$CI =& get_instance();
	//	$CI->load->library('pmc');
	//	return $CI->pmc->send_email($to, $CI->config->item('web_admin_email_id'), $subject, $message);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Global Graynz <email@globalgraynz.com>' . "\r\n";
		$headers .= 'Reply-To: Global Graynz <email@globalgraynz.com>'. "\r\n";
		mail($to,$subject,$message,$headers);
		return 1;
		
	}
}

if(! function_exists('smarttruncate'))
{
	function smarttruncate($str,$length,$protectWord,$addElipse){
		if(strlen($str) <= $length)
			return $str;

		if($protectWord){
			$words = explode(' ', $str);
			$wc = count($words);
			$newWord = '';
			for($i=0; $i < $wc; $i++){
				if((strlen($newWord)+strlen($words[$i])) < $length){
					if($i != 0)
						$newWord .= ' '.$words[$i];
					else 
						$newWord .= $words[$i];
				} else {
					break;
				}
			}
			
			if(strlen($newWord) < strlen($str)){
				return  $addElipse ? $newWord.'...' : $newWord;
			}
		} else {
			return $addElipse ? substr($str, 0,$lenght).'...' : substr($str, 0,$lenght);
		}
	}
}

if(! function_exists('calculateShippingCost')){

	function calculateShippingCost($city,$state){
		$shippingCost = 100;
		if((strtolower($city) == 'bangalore' || strtolower($city) == 'bengaluru') &&  $state == 12)
		{
			$shippingCost = 0;
		} 
		if(strtolower($city) == 'chennai' &&  $state == 24)
		{
			$shippingCost = 0;
		} 
		if(strtolower($city) == 'pune' &&  $state == 15)
		{
			$shippingCost = 0;
		} 
		return $shippingCost;
	}
}


?>