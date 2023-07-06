<?php
class ProductModel extends ConnectToDB
{
    public function getProducts($num, $filters = [])
    {
        $sql = '';
        $dbh = $this->connection();
        try {
            if (!$filters) {
                $sql = "SELECT pr.id, pr.name, pr.price, 
                (SELECT path FROM product_imgs WHERE product_imgs.product_id = pr.id LIMIT 1) AS img_path, (SELECT COUNT(*) FROM reviews WHERE reviews.product_id = pr.id) AS review_amt,
                (SELECT AVG(rating) FROM reviews WHERE reviews.product_id = pr.id) AS rating
                FROM products AS pr 
                LEFT JOIN product_imgs AS primg ON primg.product_id = pr.id 
                LEFT JOIN reviews ON reviews.product_id = pr.id 
                GROUP BY pr.id";
                $sth = $dbh->query($sql);
            } else if ($filters == 'empty') {
                return false;
            } else {
                $sql = "SELECT pr.id, pr.name, pr.price, 
                (SELECT path FROM product_imgs WHERE product_imgs.product_id = pr.id LIMIT 1) AS img_path, (SELECT COUNT(*) FROM reviews WHERE reviews.product_id = pr.id) AS review_amt,
                (SELECT AVG(rating) FROM reviews WHERE reviews.product_id = pr.id) AS rating
                FROM products AS pr 
                LEFT JOIN product_imgs AS primg ON primg.product_id = pr.id 
                LEFT JOIN reviews ON reviews.product_id = pr.id WHERE pr.id IN (";
                foreach ($filters as $id) {
                    if (end($filters) !== $id) {
                        $sql .= "{$id}, ";
                    } else {
                        $sql .= "{$id}";
                    }
                }
                $sql .= ") GROUP BY pr.id";
                $sth = $dbh->query($sql);
            }
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL . $sql);
            exit;
        }
        return $result;
    }
}
