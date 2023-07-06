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
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $modelSearch = new SearchingModel();
            $searchData = $modelSearch->getSearchingProducts($_POST);
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
        $productsModel = new SpecificProductsModel();
        $newIds = $productsModel->getProductsId('new');
        $model = new ProductModel();
        $this->render("new", [
            'products' => $model->getProducts(0, $newIds)
        ]);
    }

    public function used()
    {
        $productsModel = new SpecificProductsModel();
        $usedIds = $productsModel->getProductsId('pre owned');
        $model = new ProductModel();
        $this->render("used", [
            'products' => $model->getProducts(0, $usedIds)
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
    public function product()
    {
        $model = new ProductDetales();
        $this->render("product", [
            'product_info' => $model->getProductDetales($_GET['product_id']),
            'product_reviews' => $model->getProductReviews($_GET['product_id']),
            'product_imgs' => $model->getProductImg($_GET['product_id'])
        ]);
    }
    private function render($page, $data = [])
    {
        extract($data);
        require_once VIEWS_PATH . "/master.php";
    }
}
