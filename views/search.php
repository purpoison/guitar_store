<div class="container">
    <?php if ($data['products']) : ?>
        <div class="active-filters">
            <h3><i> Active filters:</i></h3>
            <span class="filter-amt">chosen <?= count($data['products']) ?> products:</span>
            <?php foreach ($_POST as $filter) :
                foreach ($filter as $key => $value) : ?>
                    <span class="active-filters-item"><?= toUpperCase($key) ?></span>
                <?php endforeach ?>
            <?php endforeach ?>
            <br>
        </div>
        <div class="main-container">
            <div class="filters">
                <?php echo generateFilters($data['filters'], $_SERVER['SCRIPT_NAME']); ?>
            </div>
            <div class="products">
                <?php echo generateProductCard($data['products']); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="not-available">
            <h2>Oops :(</h2>
            <h3>Out of stock </h3>
            <p> We are very sorry, but the products you are looking for are not available at the moment. <br>
                Don't be sad, we have many different products that you might like!</p>
            <a href="?page=home" class="btn">Go to home page</a>
        </div>
    <?php endif; ?>
</div>