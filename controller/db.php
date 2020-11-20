<?php
//namespace database;

function db_connect()
{
	require_once __DIR__.'/../System.php';
	$db = \my_sys_info\my_sys_info::dbinfo();
	return new PDO(sprintf("pgsql:host='%s';dbname=%s; port=%d",
		$db['host'], $db['db_name'], $db['port']), $db['login'], $db['password']);
}

function query_quotes($str)
{
	return "'".$str."'";
}

