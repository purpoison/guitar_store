<?php
class RegistrationModel extends ConnectToDB
{
    public function logIn($data, $operator)
    {
        $dbh = $this->connection();
        try {
            $sql = "SELECT * FROM customers WHERE email = :email {$operator} password = :password";
            $sth = $dbh->prepare($sql);
            $sth->bindValue(':email', $data['user_email'], PDO::PARAM_STR);
            $sth->bindValue(':password', $data['user_password'], PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        return $result;
    }

    public function signUp($data)
    {
        // echo "<pre>";
        // var_dump($data);
        // exit;
        $dbh = $this->connection();
        try {
            $sql = "INSERT INTO customers (name, email, phone, address, password) VALUES (:name, :email, :phone, :address, :password);";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                'name' => $data['new_user_name'],
                'email' => $data['user_email'],
                'phone' => $data['new_user_phone'],
                'address' => $data['new_user_address'],
                'password' => $data['user_password'],
            ]);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
    }
}
