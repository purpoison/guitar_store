<?php
class SearchingModel extends ConnectToDB
{
    public function getSearchingProducts($filters_array)
    {
        $dbh = $this->connection();
        try {
            $sql = "SELECT product_id FROM product_characteristics WHERE ";
            foreach ($filters_array as $filters => $filter) {
                $sql .= "{$filters} IN (";
                foreach ($filter as $value) {
                    if (end($filter) !== $value) {
                        $sql .= "{$value}, ";
                    } else {
                        $sql .= "{$value}";
                    }
                }
                $sql .= ")";
                if (count($filters_array) > 1 && $filter !== end($filters_array)) {
                    $sql .= " OR ";
                }
            }

            $sth = $dbh->query($sql);

            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        $idArray = [];
        foreach ($result as $item) {
            $idArray[] = $item->product_id;
        }
        return $idArray;
    }
}
