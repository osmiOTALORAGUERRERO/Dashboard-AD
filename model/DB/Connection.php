<?php
class Connection
{
    private static $host;
    private static $db;
    private static $user;
    private static $password;
    
    private static function init()
    {
        self::$host = getenv('DB_HOST');
        self::$db = explode(',',getenv('DB_NAME'));
        self::$user = getenv('DB_USER');
        self::$password = getenv('DB_PASSWORD');
    }
    public static function schemaUser()
    {
        try{
            self::init();
            $connection = "mysql:host=". self::$host . ";dbname=" . self::$db[0];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ];
            // $pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection, self::$user, self::$password);

            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

    public static function schemaSales()
    {
        try{
            self::init();
            $connection = "mysql:host=". self::$host . ";dbname=" . self::$db[1];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ];
            // $pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection, self::$user, self::$password);

            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

    public static function schemaProduction()
    {
        try{
            self::init();
            $connection = "mysql:host=". self::$host . ";dbname=" . self::$db[2];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ];
            // $pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection, self::$user, self::$password);

            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}
