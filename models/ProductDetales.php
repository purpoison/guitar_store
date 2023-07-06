<?php
class ProductDetales extends ConnectToDB
{
    public function getProductDetales($id)
    {
        $dbh = $this->connection();
        $sql = "SELECT pr.*, (SELECT AVG(rating) FROM reviews WHERE reviews.product_id = pr.id) AS rating 
         FROM products AS pr 
         LEFT JOIN reviews ON reviews.product_id = pr.id 
         WHERE pr.id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        try {
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL . $sql);
            exit;
        }
        return $result[0];
    }
    public function getProductReviews($id)
    {
        $dbh = $this->connection();
        $sql = "SELECT r.*, c.name FROM reviews AS r JOIN customers AS c ON c.id = r.customer_id WHERE r.product_id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        try {
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL . $sql);
            exit;
        }
        if (empty($result)) {
            return 'empty';
        } else {
            return $result;
        }
    }
    public function getProductImg($id)
    {
        $dbh = $this->connection();
        $sql = "SELECT path FROM product_imgs WHERE product_id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        try {
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL . $sql);
            exit;
        }
        return $result;
    }
}