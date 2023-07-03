<?php
class SpecificProductsModel extends ConnectToDB
{
    public function getProductsId($condition)
    {
        $dbh = $this->connection();
        try {
            $sth = $dbh->query("SELECT id FROM products WHERE 'condition' = '{$condition}'");

            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        return $result;
    }
}
