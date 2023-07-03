<div class="header__poster">
    <img src="../img/promo.png" alt="promo">
</div>
<div class="container home">
    <div class="main-container">
        <div class="filters">
            <form action="<?= $_SERVER['SCRIPT_NAME'] . "?page=search" ?>" method="POST">
                <?php foreach ($data['filters'] as $filter_name => $filter) : ?>
                    <div class="filter-wrap">
                        <h3 class="filter__title"><?= toUpperCase($filter_name) ?></h3>
                        <div class="filter__content">
                            <?php foreach ($filter as $id => $value) : ?>
                                <ul class="filter__content-list">
                                    <li> <input type="checkbox" name="<?= $filter_name . '_id' ?>[<?= $value ?>]" id="<?= $value . "-" . $id ?>" value="<?= $id ?>">
                                        <label for="<?= $value . "-" . $id ?>"><?= $value ?></label>
                                    </li>
                                </ul>
                            <?php endforeach ?>
                        </div>
                        <button type="submit" class="btn filter-btn">Show</button>
                    </div>
                <?php endforeach ?>
            </form>
        </div>
        <div class="products">
            <?php echo generateProductCard($data['products']) ?>
        </div>
    </div>

</div>