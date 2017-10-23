<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'cipaja');
   define('DB_TIPO', 'mysql');
   define('DB_DNS', DB_TIPO.":dbname=".DB_DATABASE.";host=".DB_SERVER);
   $db = new PDO(DB_DNS, DB_USERNAME,DB_PASSWORD);