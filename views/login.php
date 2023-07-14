<div class="container">
    <?php
    if (empty($data['userInfo']) == true) {
        echo "<div class='message-wrap'><h1>:( <br>Sorry, but user with this email or password does not exist</h1></div>";
    } else {
        echo "<h1> Hello, {$data['userInfo'][0]->name}! <br> You are login</h1>";
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['userInfo'][0]->name;
        $_SESSION['userid'] = $data['userInfo'][0]->id;
        // var_dump($_SESSION);
        header("location: {$_SERVER['SCRIPT_NAME']}");
    }
    ?>
</div>