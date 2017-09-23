<?php

require_once 'header.php';


?>


<?php

if ($loggedin) {
    echo "$user, you are logged in.";
}//if

else { ?>
    <div class="container">
        <div class="col-md-3">
            <?php
            $error = $user = $pass = "";

            if (isset($_POST['user'])) {
                $user = sanitizeString($_POST['user']);
                $pass = sanitizeString($_POST['pass']);

                if ($user == "" || $pass == "")
                    $error = "<div>Не все поля заполнены</div>";
                else {
                    $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

                    if ($result->num_rows == 0) {
                        $error = "<div class='bg-danger'>Имя пользователя/Пароль неверны</div>";

                    } else {
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $pass;
                        /*die("You are now logged in. Please <a href='members.php?view=$user'>" .
                            "click here</a> to continue.<br><br>");*/
                        header('Location: /SocSety/members.php?view=$user');
                    }//else
                }//else
            }
            ?>
            <form method='post'><?= $error ?>
                <div class='fieldname'>Имя пользователя</div>
                <input type='text' maxlength='16' name='user' value='<?= $user ?>'>
                <div class='fieldname'>Пароль</div>
                <input type='password' maxlength='16' name='pass' value='<?= $pass ?>'>
                <div>
                    <input type='submit' value='Войти'>
                </div>
            </form>
            <?php
            ?>
        </div>
        <div class="col-md-8">
            <div> Index -> Login</div>
            <p>ВКонтакте для мобильных устройств</p>
            <p>
                Чтобы всегда оставаться ВКонтакте с друзьями и близкими,
                теперь не обязательно находиться за компьютером. Установите официальное мобильное приложение ВКонтакте и
                оставайтесь в курсе новостей Ваших друзей, где бы Вы ни находились.
            </p>
            <p>
                Чтобы всегда оставаться ВКонтакте с друзьями и близкими,
                теперь не обязательно находиться за компьютером. Установите официальное мобильное приложение ВКонтакте и
                оставайтесь в курсе новостей Ваших друзей, где бы Вы ни находились.
            </p>
            <p>
                Чтобы всегда оставаться ВКонтакте с друзьями и близкими,
                теперь не обязательно находиться за компьютером. Установите официальное мобильное приложение ВКонтакте и
                оставайтесь в курсе новостей Ваших друзей, где бы Вы ни находились.
            </p>
        </div>
    </div>

<?php }//else ?>
<div class="col-md-12">
    <?php require_once 'footer.php'; ?>

</div>


