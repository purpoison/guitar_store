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
    foreach ($data as $key => $value) {
        $info = json_encode($value);
        $div .= "<div class='product__card' data-href='?page=product&product_id={$value->id}'>
            <img src='{$value->img_path}' class='card__img' alt='{$value->name}'>
            <h5 class='card__title'>{$value->name}</h5>
            <p class='card__price'>$ {$value->price}</p>
            <div class='card__rating'>
                <ul class='rating__stars'>";
        $div .= generateRating($value->rating);
        $div .= "</ul>
            </div>
            <div class='card__buttons'>
                <a href='#' class='btn btn-add-to-bag' data-productId={$key} onclick='cartLSadd($info)' >Add to bag</a>
            </div>
        </div>";
    }
    return $div;
}

function generateRating($avg)
{
    $rez = '';
    if (!is_null($avg)) {
        $rating = round($avg);
        for ($i = 1; $i <= $rating; $i++) {
            $rez .= "<li class='full-star'>★</li>";
        }
        if ((5 - $rating) > 0) {
            for ($i = 1; $i <= (5 - $rating); $i++) {
                $rez .= "<li class='empty-star'>★</li>";
            }
        }
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $rez .= "<li class='empty-star'>★</li>";
        }
    }
    return $rez;
}

function generateFilters($data, $action)
{
    $div = "<form action='{$action}?page=search' method='POST' class='filters-form'>";
    foreach ($data as $filter_name => $filter) {
        $name = toUpperCase($filter_name);
        $div .= "<div class='filter-wrap'>
            <h3 class='filter__title'>{$name}</h3>
            <div class='filter__content'>";
        foreach ($filter as $id => $value) {
            $div .= "<ul class='filter__content-list'>
                <li> <input type='checkbox' name='{$filter_name}_id[{$value}]' id='{$value}-{$id}' value={$id}>
                    <label for='{$value}-{$id}'>{$value}</label>
                </li>
            </ul>";
        }
        $div .= "</div><button type='submit' class='btn filter-btn' onclick='rememberFilter()'>Show</button> </div>";
    }
    $div .= "</form>";
    return $div;
}

function createPaginationBtns($total_page)
{
    $div = "<div class='pagination-wrap'>";
    if (isset($_GET['subPage']) && intval($_GET['subPage']) > 1) {
        $page = intval($_GET['subPage']) - 1;
        $div .= "<a href='index.php?subPage={$page}' class='pagination-btn prev'>Prev</a>";
    }

    for ($btn = 1; $btn <= $total_page; $btn++) {
        $div .= "<a href='?subPage={$btn}' class='pagination-btn' id='{$btn}'>$btn</a>";
    }

    if (isset($_GET['subPage']) && intval($_GET['subPage']) < $total_page) {
        $page = intval($_GET['subPage']) + 1;
        $div .= "<a href='index.php?subPage={$page}' class='pagination-btn next'>Next</a>";
    }
    $div .= "</div>";
    return $div;
}
