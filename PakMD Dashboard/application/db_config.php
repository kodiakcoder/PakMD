<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'karimkre_appadmin');
define('DB_PASSWORD', 'Creative11!');
define('DB_DATABASE', 'karimkre_appdb');
define('SECRET_KEY', 'This is my secret key');
define('SECRET_IV', 'This is my secret key');
function getDB()
{
    $dbhost=DB_SERVER;
    $dbuser=DB_USERNAME;
    $dbpass=DB_PASSWORD;
    $dbname=DB_DATABASE;
    try
    {
        $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbConnection->exec("set names utf8");
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    catch (PDOException $e)
    {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}
?>
