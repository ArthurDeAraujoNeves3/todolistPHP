<?php 

define("ENVIRONMENT", "development");
date_default_timezone_set('America/Fortaleza');

$config = array();
if(ENVIRONMENT == 'development'){
	/**
	 * DATABASE
	 */	
	define("CONF_DB_NAME", "todolist");
	define("CONF_DB_HOST", "localhost");
	define("CONF_DB_USER", "root");
	define("CONF_DB_PASS", "");	
	$config['options'] = [
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	];


	/**
	 * PROJECT URLs
	 */ 
	define("BASE_URL", "http://localhost/todolistPHP/");
	define("BASE_URL_ADMIN", BASE_URL."Admin");
	
	/**
	 * PROJECT TEMPLATE
	 */
	define("TEMPLATE", "default");
	define("TEMPLATE_ADMIN", "admin");

	/**
	 * DATES
	 */
	define("DATE_BR", "d/m/Y H:i:s");
	define("DATE_APP", "Y-m-d H:i:s");	
	/**
	 * PASSWORD
	 */
	define("CONF_PASSWD_MIN_LEN", 8);
	define("CONF_PASSWD_MAX_LEN", 40);
		
	/**
	 * MESSAGE
	 */
	define("CONF_MESSAGE_CLASS", "alert");
	define("CONF_MESSAGE_INFO", "alert-info");
	define("CONF_MESSAGE_SUCCESS", "alert-success");
	define("CONF_MESSAGE_WARNING", "alert-warning");
	define("CONF_MESSAGE_ERROR", "alert-danger");
	
	/**
	* MAIL
	*/
	define("CONF_MAIL_HOST", "smtp.gmail.com");
	define("CONF_MAIL_PORT", 465);
	define("CONF_MAIL_USER", "email");
	define("CONF_MAIL_PASS", "pass");
	define("CONF_MAIL_SENDER", ["name" => "name", "address" => "email"]);

	define("CONF_MAIL_OPTION_LANG", "br");
	define("CONF_MAIL_OPTION_HTML", true);
	define("CONF_MAIL_OPTION_AUTH", true);
	define("CONF_MAIL_OPTION_SECURE", "ssl");
	define("CONF_MAIL_OPTION_CHARSET", "utf-8");
	
	/**
	 * SESSION 
	 */
	define("CONF_SESSION_NAME", "quality_process_test");


} else{
	 
}
global $db;
try{
	$db = new PDO(
		"mysql:dbname=".CONF_DB_NAME.";charset=utf8;host=".CONF_DB_HOST, 
		CONF_DB_USER, 
		CONF_DB_PASS
	);
} catch(PDOException $e){
	echo "Erro: ".$e->getMessage();
	exit;
}