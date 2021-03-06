<?php
require_once 'header.php';

$error = $user = $pass = "";

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else {
        $result = queryMySQL("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");

        if ($result->num_rows == 0) {
            $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
        } else {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("Вы уже залогированы.  <a href='profile.php'>" .
                "Вернуться</a><br><br>");
        }
    }
}
?>
<form method='post' action='login.php'><?= $error ?>
    <div class='fieldname'>Логин</div>
    <input type='text' maxlength='16' name='user' value='<?= $user ?>'><br>
    <span class='fieldname'>Пароль</span>
    <input type='password' maxlength='16' name='pass' value='<?= $pass ?>'>
    <span class='fieldname'>&nbsp;</span>
    <div class="form-group">
        <input type='submit' class="btn btn-primary" value='Login'>
    </div>
</form>
<?php

/*require_once 'footer.php';*/

?>
