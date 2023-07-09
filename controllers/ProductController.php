<?php
class ProductController
{
    public function index()
    {
        $offset = isset($_GET['subPage']) ? (intval($_GET['subPage']) - 1) * LIMIT : 0;
        $model = new ProductModel();
        $filter = new FilterModel();
        $total_page = $model->totalPages(LIMIT);
        $this->render("home", [
            'products' => $model->getProducts(LIMIT, $offset),
            'filters' => $filter->generateFilters(),
            'pages' => $total_page
        ]);
    }

    public function search()
    {
        if (isset($_POST)) {
            $offset = isset($_GET['subPage']) ? (intval($_GET['subPage']) - 1) * LIMIT : 0;
            $modelSearch = new SearchingModel();
            $searchData = $modelSearch->getSearchingProducts($_POST);
            $model = new ProductModel();
            $filter = new FilterModel();
            $total_page = $model->totalPages(LIMIT);
            $this->render("search", [
                'products' => $model->getProducts(LIMIT, $offset, $searchData),
                'filters' => $filter->generateFilters(),
                'pages' => $total_page
            ]);
        }
    }

    public function new()
    {
        $productsModel = new SpecificProductsModel();
        $newIds = $productsModel->getProductsId('new');
        $model = new ProductModel();
        $total_page = $model->totalPages(LIMIT);
        $this->render("new", [
            'products' => $model->getProducts(0, 0, $newIds),
            'pages' => $total_page
        ]);
    }

    public function used()
    {
        $productsModel = new SpecificProductsModel();
        $usedIds = $productsModel->getProductsId('pre owned');
        $model = new ProductModel();
        $this->render("used", [
            'products' => $model->getProducts(0, 0, $usedIds),
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
