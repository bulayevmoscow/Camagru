<?php
//namespace database;

	use my_sys_info\my_sys_info;

	function db_connect()
	{
		require_once __DIR__.'/../System.php';
		$db = my_sys_info::dbinfo();
		return new PDO(sprintf("pgsql:host='%s';dbname=%s; port=%d",
			$db['host'], $db['db_name'], $db['port']), $db['login'], $db['password']);
	}

	function query_quotes($str)
	{
		return "'".$str."'";
	}


// TODO Создать функцию которая помечает что человеку нужен код из почты
	function mail_check_str($str, $len)
	{
//	if (preg_match("/[\w\d\s@]+$/", $str))
//	{
//		echo 'hi';
//	}
	}

	function parse_nbr_page($perefer_str)
	{
	preg_match('/(pages=\d*)/', $perefer_str, $match);
	return '&'.$match[0];
}