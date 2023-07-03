<div class="header__poster">
    <img src="../img/promo.png" alt="promo">
</div>
<div class="container home">
    <div class="main-container">
        <div class="filters">
            <?php echo generateFilters($data['filters'], $_SERVER['SCRIPT_NAME']); ?>
        </div>
        <div class="products">
            <?php echo generateProductCard($data['products']) ?>
        </div>
    </div>

</div>