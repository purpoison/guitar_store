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
    private function render($page, $data = [])
    {
        extract($data);
        require_once VIEWS_PATH . "/master.php";
    }
}
