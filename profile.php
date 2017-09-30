<?php

require_once 'header.php';

$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if ($result->num_rows)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
}
?>

    <div class="wrapper">

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
                <li class="active"><a href="profile.php"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a>
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
                <h3>Ваш Профиль</h3>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->
            <div class="col-md-3">

                <?php
                $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

                if ($result->num_rows)
                {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    /*echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
                    echo stripslashes($row['user_name']) . "<br style='clear:left;'><br>";
                    echo stripslashes($row['user_secondName']) . "<br style='clear:left;'><br>";*/
                }
                ?>

                <div class="form-group clearfix">
                    <img src="<?php echo $row['user_image'] ?>" class="message-img-left img-width" alt="User Image">
                </div>
                <div class="form-group">
                    <a class="btn-block btn btn-primary" href="edit_profile.php">Редактировать профиль</a>
                </div>
                <div class="form-group">
                    <a class="btn-block btn btn-primary" href="messages.php">Мои сообщения</a>
                </div>

            </div>

            <div class="col-md-4">
                <h3 class="text-bold">Имя:</h3>
                <p class="profile-p">
                    <?php if (isset($row['user_name'])) {
                        echo $row['user_name'];
                    } else {
                        echo "";
                    } ?>
                </p>

                <h3 class="text-bold">Фамилия:</h3>
                <p class="profile-p">
                    <?php if (isset($row['user_secondName'])) {
                        echo $row['user_secondName'];
                    } else {
                        echo "";
                    } ?>
                </p>
                <h3 class="text-bold">О себе:</h3>
                <p class="profile-p">
                    <?php if (isset($row['text'])) {
                        echo $row['text'];
                    } else {
                        echo "";
                    } ?>
                </p>

            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php
require_once 'footer.php';
die();

?>