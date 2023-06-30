<div class="container home">
    <div class="main-container">
        <div class="filters">
            <p>Hi i'm filters
                <?php
                // echo "<pre>";
                // var_dump($data['filters']);
                ?>
            </p>
        </div>
        <div class="products">
            <?php
            foreach ($data['products'] as $value) :

            ?>
                <div class="product__card" style="width: 18rem;">
                    <img src="<?= $value->img_path ?>" class="card__img" alt="<?= $value->name ?>">
                    <h5 class="card__title"><?= $value->name ?></h5>
                    <p class="card__price">$<?= $value->price ?></p>
                    <div class="card__rating">
                        <ul class="rating__stars">
                            <?php
                            if (!is_null($value->rating)) {
                                $rating = round($value->rating);
                                for ($i = 1; $i <= $rating; $i++) {
                                    echo "<li class='full-star'>★</li>";
                                }
                                if ((5 - $rating) > 0) {
                                    for ($i = 1; $i <= (5 - $rating); $i++) {
                                        echo "<li class='empty-star'>★</li>";
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "<li class='empty-star'>★</li>";
                                };
                            }
                            ?>
                        </ul>
                        <span class="raiting">
                            <?php if ($value->review_amt) {
                                echo "({$value->review_amt})";
                            } ?></span>
                    </div>


                    <div class="card__buttons">
                        <a href="#" class="btn btn-add-to-bag">Add to bag</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>