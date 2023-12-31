<div class="container product">
    <a href="?page=home" class="btn product-btn">Back to Home</a>

    <div class="flex-container">
        <div class="slider__wrap flex-item">
            <div class="swiper product-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($data['product_imgs'] as $item) : ?>
                        <div class="swiper-slide">
                            <div class="image-slider__image">
                                <img src="<?= $item->path ?>" alt="<?= $data['product_info']->name ?>">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
        <div class="product__info flex-item">
            <h1 class="product__name"><?= $data['product_info']->name ?></h1>
            <div>
                <div class="card__rating">
                    <ul class="rating__stars">
                        <?= generateRating($data['product_info']->rating) ?>
                    </ul>
                    <a href="#reviews" class="review__link">
                        <?php
                        if ($data['product_reviews'] !== 'empty' && count($data['product_reviews']) !== 1) {
                            echo count($data['product_reviews']) . ' reviews';
                        } else if ($data['product_reviews'] !== 'empty' && count($data['product_reviews']) == 1) {
                            echo '1 review';
                        } else {
                            echo '0 reviews';
                        }
                        ?>
                    </a>
                    <span>&nbsp|&nbsp</span>
                    <span>#<?= $data['product_info']->code ?></span>
                </div>
            </div>
            <h3 class="product__price">$ <?= $data['product_info']->price ?></h3>
            <div class="detales">
                <div>
                    <p class="produc-icon product__pickup"><b>Pickup</b> at <b>Paramus, NJ</b> <br><span>Available in 3-5 business days</span></p>

                </div>
                <div>
                    <p class="produc-icon product__delivery"><b>Free delivery</b> to United States</p>
                </div>
                <div>
                    <span class="financing">Special Financing offer</span>
                </div>

                <div class="product__payment">
                    As low as <span class="important">$<?= round($data['product_info']->price / 23) ?></span>/month
                    with 24 mo. financing
                </div>
            </div>
            <div class="product-description">
                <h3>Сharachteristics:</h3>
                <table class="product__charachteristics">
                    <tr>
                        <td class="table-title">Condition</td>
                        <td><?php if ($data['product_info']->condition == 'new') {
                                echo "<span class='green'> {$data['product_info']->condition}</span";
                            } else {
                                echo $data['product_info']->condition;
                            } ?></td>
                    </tr>
                    <tr>
                        <td class="table-title">Orientation</td>
                        <td><?= $data['product_info']->orientation ?></td>
                    </tr>
                    <tr>
                        <td class="table-title">Performance level</td>
                        <td><?= $data['product_info']->performance_lvl ?></td>
                    </tr>
                </table>
            </div>
            <?php
            $info = json_encode($data['product_info']); ?>
            <a href="#" class="btn btn-add-to-bag" data-productId=<?= ($data['product_info']->id - 1) ?> onclick='cartLSadd(<?= $info ?>)'>Add to bag</a>
        </div>
    </div>
    <div id="reviews">
        <h3 class="review__title"><?php if ($data['product_reviews'] !== 'empty' && count($data['product_reviews']) !== 1) : ?>Reviewed by <?= count($data['product_reviews']) ?> customers:
        <?php elseif ($data['product_reviews'] !== 'empty' && count($data['product_reviews']) == 1) : ?>
            Reviewed by 1 customer:
        <?php else : ?>
            No reviews yet :(
        <?php endif ?>
        </h3>
        <div class="write-review-text-wrap">
            <?php if (!isset($_SESSION['login'])) : ?>
                <span class="add-review-text">To write your review, please sign in first</span>
                <a href="#" class="btn sign-in">Sign In</a>
            <?php else : ?>
                <a href="#" class="btn write-review-btn">Write your review</a>
            <?php endif ?>
            <form action="<?= $_SERVER['SCRIPT_NAME'] . '?page=addreview' ?>" method="POST" class="add-review__form hidden">
                <input type="hidden" value="<?= $_SESSION['userid'] ?>" name="customer_id">
                <input type="hidden" value="<?= $data['product_info']->id ?>" name="product_id">
                <label for="rating">Your Overall Rating:</label>
                <div class="review-rating-radio">
                    <label for="rating"> 1</label>
                    <input type="radio" name="rating" value="1">
                    <label for="rating"> 2</label>
                    <input type="radio" name="rating" value="2">
                    <label for="rating"> 3</label>
                    <input type="radio" name="rating" value="3">
                    <label for="rating"> 4</label>
                    <input type="radio" name="rating" value="4">
                    <label for="rating"> 5</label>
                    <input type="radio" name="rating" value="5">
                </div>
                <input type="text" name='title' id="review-title" placeholder="Review title" required>
                <textarea name="body" id="review-body" cols="30" rows="10" placeholder="Your review"></textarea>
                <button type="submit" name="reviewSubmit" class="btn">Submit</button>
            </form>
        </div>

        <?php if ($data['product_reviews'] !== 'empty') :
            foreach ($data['product_reviews'] as $review) :
        ?>
                <div class="review">
                    <h4 class="review__author"><i><?= $review->name ?></i></h4>
                    <h3><?= $review->title ?></h3>
                    <ul class="rating__stars"><?= generateRating($review->rating) ?></ul>
                    <p><?= $review->body ?></p>
                    <span class="review-date gray"><i><?= $review->date ?></i></span>
                </div>
        <?php endforeach;
        endif ?>
    </div>
</div>