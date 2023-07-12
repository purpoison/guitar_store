<div class="header__poster">
    <img src="../img/promo.png" alt="promo">
</div>
<div class="container home">
    <div class="main-container">
        <div class="filters">
            <?php echo generateFilters($data['filters'], $_SERVER['SCRIPT_NAME']); ?>
            <a href="#" class="show-filters hidden">See all filters</a>
        </div>
        <div>
            <div class="products">
                <?php echo generateProductCard($data['products']) ?>
            </div>
            <?php if ($data['pages'] != 1) echo createPaginationBtns($data['pages']) ?>
        </div>
    </div>
</div>