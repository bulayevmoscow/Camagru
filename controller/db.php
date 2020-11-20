<?php
//namespace database;
session_start();


function db_connect()
{
	return new PDO("pgsql:host='localhost';dbname=postgres", 'php_test', 1234);
}

