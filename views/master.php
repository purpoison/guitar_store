<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar store</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="header">
            <div class="container">
                <div class="navbar">
                    <a href="?page=home" class="logo"><img src="../img/logo.svg" alt="logo"></a>
                    <nav class="main-menu">
                        <ul>
                            <?php

                            foreach (MAIN_MENU as $route => $name) :
                            ?>
                                <li>
                                    <a href="?page=<?php echo $route ?>"> <?php echo $name ?></a>
                                </li>
                            <?php
                            endforeach; ?>
                        </ul>
                    </nav>
                    <div class="actions">
                        <a href="#"> <img src="../img/user.png" alt="user">Sign In</a>
                        <a href="#" class="bag"><img src="../img/bag.png" alt="bag">Bag<span class="bag-counter">0</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__poster">
            <img src="../img/promo.png" alt="promo">
        </div>


    </header>
    <?php
    require_once VIEWS_PATH . "/{$page}.php";

    ?>

    <footer>
        <div class="container">
            © Guitar world 2021 - <?php echo date('Y'); ?>
        </div>
    </footer>
</body>

</html>