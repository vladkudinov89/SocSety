<?php

require_once 'header.php';

if ($loggedin) {
    require_once 'header.php'; ?>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $row['user_image'] ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $row['user_name'] ?></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="profile.php"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a>
                </li>
                <li><a href="messages.php?view=<?php echo $user; ?>"><i class="fa fa-envelope"></i>
                        <span>Сообщения</span></a></li>
                <!--<li><a href="members.php?view=$user"><i class="fa fa-envelope"></i> <span>Сообщения</span></a></li>-->
                <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user-o"></i> <span>Друзья</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="members.php">Все друзья</a></li>
                        <li><a href="friends.php">Мои друзья</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Перейти в профиль
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->

            <a href="profile.php">Ваш профиль</a>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php
    require_once 'footer.php';
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
                    $result = queryMySQL("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");

                    if ($result->num_rows == 0) {
                        $error = "<div class='bg-danger'>Имя пользователя/Пароль неверны</div>";

                    } else {
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $pass;

                        /*die("You are now logged in. Please <a href='members.php?view=$user'>" .
                            "click here</a> to continue.<br><br>");*/

                        /*In Home*/
                        header('Location: /SocSety/profile.php');

                        /*In work*/
                        /*header('Location: /SocialDiplom/profile.php');*/
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


