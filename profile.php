<?php

require_once 'header.php';


?>

<div class="wrapper">

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $user ?>.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $user; ?></p>
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
                <li class="active"><a href="profile.php"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a></li>
                <li><a href="messages.php?view=<?php echo $user; ?>"><i class="fa fa-envelope"></i> <span>Сообщения</span></a></li>
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
                <small>Профиль пользователя</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->
            <?php require_once 'request_data.php'; ?>
            <div class="col-md-4">
                <?php showProfile($user); ?>
                <h2>Имя: <?= $row1['user_name'] ?></h2>
                <h2>Фамилия: <?= $row['user_secondName'] ?></h2>
            </div>
            <div class="col-md-4">
                <?php

                echo "<a class='button' href='edit_profile.php'>" .
                    "Редактирование профиля</a><br><br>";
                ?>
            </div>



        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<?php
require_once 'footer.php';
die();

?>