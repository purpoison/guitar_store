<?php
class ProductModel extends ConnectToDB
{
    public function getProducts($limit, $offset, $filters = [])
    {
        $dbh = $this->connection();
        $sql = "SELECT pr.id, pr.name, pr.price, 
        (SELECT path FROM product_imgs WHERE product_imgs.product_id = pr.id LIMIT 1) AS img_path, (SELECT COUNT(*) FROM reviews WHERE reviews.product_id = pr.id) AS review_amt,
        (SELECT AVG(rating) FROM reviews WHERE reviews.product_id = pr.id) AS rating
        FROM products AS pr 
        LEFT JOIN product_imgs AS primg ON primg.product_id = pr.id 
        LEFT JOIN reviews ON reviews.product_id = pr.id";
        try {
            if (!$filters) {
                $sql .= " GROUP BY pr.id LIMIT :offset, :limit";
            } else if ($filters == 'empty') {
                return false;
            } else {
                $sql .= " WHERE pr.id IN (";
                foreach ($filters as $id) {
                    if (end($filters) !== $id) {
                        $sql .= "{$id}, ";
                    } else {
                        $sql .= "{$id}";
                    }
                }
                $sql .= ") GROUP BY pr.id";
            }
            $sth = $dbh->prepare($sql);

            if ($limit != 0) {
                $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
                $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
                // var_dump($offset, $limit, $sth);
                $sth->execute();
            } else {
                $sth->execute();
            }
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL . $sql);
            exit;
        }
        return $result;
    }

    public function totalPages($limit)
    {
        $dbh = $this->connection();
        $sql = "SELECT COUNT(*) AS total FROM products";
        try {
            $sth = $dbh->query($sql, PDO::FETCH_ASSOC);
            $length = $sth->fetch()['total'];
            $total_page = ceil($length / $limit);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }

        return $total_page;
    }
}
