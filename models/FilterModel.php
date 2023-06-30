<?php
require_once __DIR__ . "../../functioins/ConnectToDB.php";

class FilterModel extends ConnectToDB
{

    public function generateFilters()
    {
        $filters_list = [
            'filter_brands' => 'brand',
            'filter_accessories' => 'accessories',
            'filter_body_materials' => 'body_material',
            'filter_categories' => 'category',
            'filter_colors' => 'color',
            'filter_countries' => 'country',
            'filter_number_of_strings' => 'number_of_strings'
        ];
        $filters = [];
        foreach ($filters_list as $filter_name => $filter_column) {
            $name = [];
            $data = $this->getFilter($filter_name, $filter_column);
            foreach ($data as $item) {
                $name[] = $item->$filter_column;
            }
            array_push($filters, $name);
            // array_push($filters, $this->getFilter($filter_name, $filter_column));
        }
        return $filters;
    }

    public function getFilter($filterName, $column)
    {
        $dbh = $this->connection();
        try {
            $sth = $dbh->query("SELECT {$column} FROM {$filterName}");

            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error! Code: {$e->getCode()}. Message: {$e->getMessage()}" . PHP_EOL);
            exit;
        }
        return $result;
    }
}
