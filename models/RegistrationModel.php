<?php
class RegistrationModel extends ConnectToDB
{
    public function isExist($data)
    {
        $dbh = $this->connection();
        try {
            $sql = "";
            $sth = $dbh->query($sql);

            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        return $result;
    }

    public function logIn($data, $operator)
    {
        $dbh = $this->connection();
        try {
            $sql = "SELECT * FROM customers WHERE email = :email $operator password = :password";
            $sth = $dbh->prepare($sql);
            $sth->bindValue(':email', $data['user_email'], PDO::PARAM_INT);
            $sth->bindValue(':password', $data['user_password'], PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        return $result;
    }
}
