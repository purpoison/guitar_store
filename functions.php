<?php
function toUpperCase($word)
{
    $newStr = str_replace('_', ' ', $word);
    $result = strtoupper($newStr[0]) . substr($newStr, 1);
    return $result;
}

function generateProductCard($data)
{
    $div = '';
    foreach ($data as $value) {
        $div .= "<div class='product__card'>
            <img src='{$value->img_path}' class='card__img' alt='{$value->name}'>
            <h5 class='card__title'>{$value->name}</h5>
            <p class='card__price'>$ {$value->price}</p>
            <div class='card__rating'>
                <ul class='rating__stars'>";

        if (!is_null($value->rating)) {
            $rating = round($value->rating);
            for ($i = 1; $i <= $rating; $i++) {
                $div .= "<li class='full-star'>★</li>";
            }
            if ((5 - $rating) > 0) {
                for ($i = 1; $i <= (5 - $rating); $i++) {
                    $div .= "<li class='empty-star'>★</li>";
                }
            }
        } else {
            for ($i = 1; $i <= 5; $i++) {
                $div .= "<li class='empty-star'>★</li>";
            }
        }

        $div .= "</ul>
            </div>
            <div class='card__buttons'>
                <a href='#' class='btn btn-add-to-bag'>Add to bag</a>
            </div>
        </div>";
    }
    return $div;
}
