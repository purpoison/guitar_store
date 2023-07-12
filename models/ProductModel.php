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
            if (!$filters && $limit != 0) {
                $sql .= " GROUP BY pr.id LIMIT :offset, :limit";
            } else if ($filters == 'empty') {
                return false;
            } else if (!$filters && $limit == 0) {
                $sql .= " GROUP BY pr.id";
                $sth = $dbh->query($sql, PDO::FETCH_ASSOC);
                $result = $sth->fetchAll();
                return $result;
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
            }

            $sth->execute();
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
    public function store($data, $filePath)
    {
        $myJson = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        // echo "<pre>";
        // var_dump($myJson);
        // exit;
        if (file_put_contents($filePath, $myJson)) {
            // echo 'Data saved to JSON file successfully.';
        } else {
            // echo $filePath . PHP_EOL;
            // echo 'Error saving data to JSON file.';
        }
    }
}
