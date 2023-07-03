<?php
class ProductController
{
    public function index()
    {
        $model = new ProductModel();
        $filter = new FilterModel();
        $this->render("home", [
            'products' => $model->getProducts(5),
            'filters' => $filter->generateFilters()
        ]);
    }

    public function search()
    {
        if (isset($_POST)) {
            $modelSearch = new SearchingModel();
            $searchData = $modelSearch->getSearchingProducts($_POST);
            // echo "<pre>";
            // print_r($searchData);
            $model = new ProductModel();
            $filter = new FilterModel();
            $this->render("search", [
                'products' => $model->getProducts(0, $searchData),
                'filters' => $filter->generateFilters()
            ]);
        }
    }

    public function new()
    {
        $products = ['hello' => 'message'];
        $this->render("new", [
            'products' => $products
        ]);
    }

    public function used()
    {

        $products = ['hello' => 'message'];
        $this->render("used", [
            'products' => $products
        ]);
    }

    public function about()
    {
        $this->render("about");
    }

    public function contacts()
    {
        $this->render("contacts");
    }

    public function status404()
    {
        $this->render("404");
    }
    private function render($page, $data = [])
    {
        extract($data);
        require_once VIEWS_PATH . "/master.php";
    }
}
