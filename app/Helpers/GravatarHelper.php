<?php
namespace App\Helpers;

/**
 * GravatarHelper
 */
class GravatarHelper
{
	/*
	*validate_gravatar
	*
	*check , if the gravatar has any avatar image or not
	*@param string $email or the user
	*@param boolean true or false
	*/
	
	public static function validate_gravatar($email)
	{
		$hash = md5($email);
		$uri = 'http://www.gravatar.com/avatar/'. $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		}else{
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}

	/*
	*gravatar_image
	*
	* @param string $email of the user
	* @param integer size of the image
	* @param string $d type of image if not gravatar image 
	* @param string gravatar imgae URL
	*/
 public static function gravatar_image($email, $size, $d="")
 {
 	$hash = md5($email);
 	$image_url = 'http://www.gravatar.com/avatar/'. $hash . '?s='. $size. '$d'.$d;
 	return $image_url;
 }

}