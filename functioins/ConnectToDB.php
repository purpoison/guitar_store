<?php
class ConnectToDB
{
    public function connection()
    {
        $dsn = 'mysql:host=localhost;dbname=guitar_store';
        $user = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
        }
        return $dbh;
    }
}
