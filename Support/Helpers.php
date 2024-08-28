<?php

/**
 * ################
 * ### VALIDATE ###
 * ################
 */


function is_email(string $email)
{
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_passwd(string $password)
{
	if(password_get_info($password)['algo']){
		return true;
	}
	return (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN ? true : false);
}

function passwd(string $password)
{
	return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

function passwd_verify(string $password, string $hash)
{	
	return password_verify($password, $hash);
}

function passwd_rehash(string $hash)
{
	return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

function csrf_input()
{
	session()->csrf();
	return "<input type='text' name='csrf' value='".(session()->csrf_token ?? "")."'/>";
}

function csrf_verify($request)
{
	if(empty(session()->csrf_token) || empty($request['csrf']) || $request['csrf'] != session()->csrf_token){
		return false;
	}
	return true;	
}

/**
 * ##############
 * ### STRING ###
 * ##############
 */

function str_slug(string $string)
{
	$string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);

	$formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
	$replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

	$slug = str_replace(["-----", "----", "---", "--"], "-", 
		str_replace(" ", "-", 
			trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
		)
	);
	return $slug;
}

function str_study_case(string $string)
{
	$string = str_slug($string);
	$stydlyCase = str_replace(" ", "", mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE));
	return $stydlyCase;
}
function str_camel_case(string $string)
{
	return lcfirst(str_study_case($string));
}
function str_title(string $string)
{
	return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}
function str_limit_words(string $string, int $limit, string $pointer = "...")
{
	$string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
	$arrWords = explode(" ", $string);
	$numWords = count($arrWords);

	if($numWords < $limit){
		return $string;
	}

	$words = implode(" ", array_slice($arrWords, 0, $limit));
	return "{$words}{$pointer}";
}
function str_limit_chars(string $string, int $limit, string $pointer = "...")
{
	$string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
	if(mb_strlen($string) <= $limit){
		return $string;
	}
	$chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
	return "{$chars}{$pointer}";
}

/**
 * #################
 * ### CALCULATE ###
 * #################
 */

function difference_days_between_dates($date1, $date2){
	$difference = strtotime($date2) - strtotime($date1);
	return abs(round($difference / 86400));
}

function numberReplace($value){
	$value_replace = str_replace('.', '', $value);
    $value = str_replace(',', '.', $value_replace);
	return $value;
}



/**
 * ##############
 * ### STRING ###
 * ##############
 */

function url(string $path)
{
	return BASE_URL .($path[0] == "/" ? mb_substr($path, 1) : $path);
}

function redirect(string $url)
{
	header("HTTP/1.1 302 Redirect");
	if(filter_var($url, FILTER_VALIDATE_URL)){
		header("Location: {$url}");		
		exit;
	}
	$location = url($url);
	header("Location: {$location}");
	exit;
}

/**
 * ##############
 * ### STRING ###
 * ##############
 */

function message()
{
	return new Message();
}

function session()
{
	return new Session();
}


/**
 * ##############
 * ### MODEL ###
 * ##############
 */

function users()
{
	return new Users();
}

/**
 * ##############
 * ## CSS - JS ##
 * ##############
 */

function customCSS($file_name){
	return "<link rel='stylesheet' href='".BASE_URL."Assets/css/".$file_name.".css'/>";
}