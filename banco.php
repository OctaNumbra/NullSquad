<?php
class Banco
{
    private static $dbName = 'db_brazuna';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = '';
    private static $cont = null;

    public function __construct()
    {
        die('a função Init não é permitido');
    }

    public static function conectar()
    {
        if (null == self::$cont) {
            try {
                self::$cont = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        return self::$cont;
    }
    public static function desconectar()
    {
        self::$cont = null;
    }
}