<?php
class AddReviewModel extends ConnectToDB
{
    public function addReview($data)
    {
        // echo "<pre>";
        // var_dump(
        //     date('Y-m-d H:i:s'),
        //     $data['title'],
        //     $data['body'],
        //     $data['rating'],
        //     $data['product_id'],
        //     $data['customer_id']
        // );
        // exit;
        $dbh = $this->connection();
        try {
            $sql = "INSERT INTO reviews (date, title, body, rating, product_id, customer_id) VALUES (:date, :title, :body, :rating, :product_id, :customer_id);";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                'date' => date('Y-m-d H:i:s'),
                'title' => $data['title'],
                'body' => $data['body'],
                'rating' => $data['rating'],
                'product_id' => $data['product_id'],
                'customer_id' => $data['customer_id']
            ]);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        $this->relocation($data['product_id']);
    }
    public function relocation($id)
    {
        header("location: {$_SERVER['SCRIPT_NAME']}?page=product&product_id={$id}");
    }
}
