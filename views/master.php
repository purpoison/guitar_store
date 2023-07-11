<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar store</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    ?>
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
                        <?php
                        if (isset($_SESSION['login'])) {
                            echo "<a href='?page=logout' class='log-out'> <img src='../img/exit.png' alt='log out'>Log out</a>
                            ";
                        } else {
                            echo " <a href='#' class='sign-in'> <img src='../img/user.png' alt='user'>Sign In</a>";
                        }
                        ?>

                        <a href="#" class="bag"><img src="../img/bag.png" alt="bag">Bag<span class="bag-counter">0</span></a>
                    </div>
                </div>
            </div>
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
    <div class="go-to-top">
    </div>

    <div class="popup">
        <div class="popup__body">
            <form action=<?= $_SERVER['SCRIPT_NAME'] . '?page=login' ?> method="POST" class="popup__form sign-in-form" id="signup">
                <div class="popup__close">
                </div>
                <div class="flex">
                    <h3 class="title">Log In</h3>
                    <label for="user_email">Email</label>
                    <input type="email" name="user_email" id="user_email" required>
                    <label for="user_password">Password</label>
                    <input type="password" name="user_password" id="user_password" maxlength="10">
                    <button type="submit" class="popup__btn btn" name="login">Sign In</button>
                    <span>or</span>
                    <a href="#" class="create-acc">Create account</a>
                </div>
            </form>
            <form action=<?= $_SERVER['SCRIPT_NAME'] . '?page=signup' ?> method="POST" class="popup__form sign-up-form hidden">
                <div class="popup__close">
                </div>
                <div class="flex">
                    <h3 class="title">Registration</h3>

                    <label for="new_user_name">Full Name</label>
                    <input type="text" name="new_user_name" id="new_user_name" required>
                    <label for="new_user_phone">Phone</label>
                    <!-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  -->
                    <input type="tel" name="new_user_phone" id="new_user_phone" placeholder="+1..." required maxlength="16">
                    <label for="new_user_address">Adress</label>
                    <input type="text" name="new_user_address" id="new_user_address" required>
                    <label for="new_user_email">Email</label>
                    <input type="email" name="user_email" required id="new_user_email">
                    <label for="new_user_password">Password</label>
                    <input type="password" name="user_password" maxlength="10" id="new_user_password" required>
                    <!-- <label for="repeatpassword">Password confirmation</label>
                    <input type="password" name="repeatpassword" id="repeatpassword" maxlength="10" required> -->
                    <button type="submit" class="popup__btn btn" name="signup">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>