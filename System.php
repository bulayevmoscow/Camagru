<?php
	namespace my_sys_info;

	class my_sys_info {
		private static $config = [
			'host' => 'localhost',
			'db_name' => 'postgres',
			'port' => 5432,
			'login' => 'php_test',
			'password' => 1234,
		];

		public static function dbinfo() {
			return [
				'host' => self::$config['host'],
				'db_name' => self::$config['db_name'],
				'port' => self::$config['port'],
				'login' => self::$config['login'],
				'password' => self::$config['password'],
			];
		}
	}