<div class="container">
    <div class='message-wrap'>
        <?php

        if (empty($data['isexist'])) {
            echo "<h1>Welcome to our guitar world family! <br>Your registration is sucsessfull</h1>
        <a href='#' class='sign-in btn'>Sign In</a>";
        } else {
            echo "<h1>:(<br>We are sorry but user with this email: <br><span class='red'>{$data['isexist'][0]->email}</span><br> alredy exist</h1>";
        }
        ?>
    </div>
</div>