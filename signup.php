<?php
require_once 'header.php'; ?>
<!--<script>
    function checkUser(user) {
        if (user.value == '') {
            O('info').innerHTML = ''
            return
        }

        params = "user=" + user.value;
        request = new ajaxRequest();
        request.open("POST", "checkuser.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.setRequestHeader("Content-length", params.length);
        request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function () {
            if (this.readyState == 4)
                if (this.status == 200)
                    if (this.responseText != null)
                        O('info').innerHTML = this.responseText
        }
        request.send(params)
    }

    function ajaxRequest() {
        try {
            var request = new XMLHttpRequest()
        }
        catch (e1) {
            try {
                request = new ActiveXObject("Msxml2.XMLHTTP")
            }
            catch (e2) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP")
                }
                catch (e3) {
                    request = false
                }
            }
        }
        return request
    }
</script>-->

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Введите логин и пароль для регистрации
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="col-md-3 text-center">
                <?php
                $error = $user = $pass = "";
                if (isset($_SESSION['user'])) destroySession();

                if (isset($_POST['user'])) {
                    $user = sanitizeString($_POST['user']);
                    $pass = sanitizeString($_POST['pass']);

                    if ($user == "" || $pass == "")
                        $error = "<div class='form-group alert-error'>Не все поля заполнены</div>";
                    else {
                        $result = queryMysql("SELECT * FROM members WHERE user='$user'");

                        if ($result->num_rows)
                            $error = "<div class='form-group alert-error'>Этот логин уже занят</div>";
                        else {
                            queryMysql("INSERT INTO members VALUES(id, '$user', '$pass') ");
                            /*queryMysql("UPDATE profiles SET user='$user' WHERE user='$user'");*/
                            queryMysql("INSERT INTO profiles VALUES ('$user','','','','dist/img/image_users/no_image.jpg') ");

                            die("<h4>Ваш аккаунт создан</h4> <a href='index.php'>Пожалуйста, залогиньтесь.</a>");
                        }
                    }
                } ?>


                <form method='post' action='signup.php'><?= $error ?>
                    <div class='form-group text-bold'>Логин</div>
                    <div class="form-group">
                        <input type='text' maxlength='16' name='user' value='<?= $user ?>'
                               onBlur='checkUser(this)'>
                    </div>
                    <div id='info'>

                    </div>
                    <div class='form-group text-bold'>Пароль</div>
                    <div class="form-group">
                        <input type='password' maxlength='16' name='pass' value='<?= $pass ?>'>
                    </div>
                    <div class="form-group">
                        <input type='submit' class="btn btn-primary" value='Зарегистрироваться'>
                    </div>
                </form>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<?php
require_once 'footer.php';
?>

