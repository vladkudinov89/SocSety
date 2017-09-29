<?php // Example 26-8: profile.php
require_once 'header.php';

if (!$loggedin) die();
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
                Редактирование профиля
                <small>Optional description</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->
            <?php


            showProfile($user);
            $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

            if ($result->num_rows) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
            }
            ?>
            <form method='post' action='save_profile.php' enctype='multipart/form-data'>
                <h3>Enter or edit your details and/or upload an image</h3>
                <div>
                    Ваше Имя: <input type="text" name="user_name" id="" value="<?php
                    if (isset($row['user_name'])) {
                        echo $row['user_name'];
                    } else {
                        echo "";
                    }
                    ?> ">
                </div>
                <div>
                    Ваша Фамилия: <input type="text" name="user_secondName" id="" value="<?php
                                         if (isset($row['user_secondName'])) { echo $row['user_secondName'];

                                         } else {
                                             echo "";
                                         }
                                         ?> ">
                </div>
                <div>
                    <textarea name='text' cols='50' rows='3'><?php
                        if (isset($row['text'])) {
                            echo $row['text'];
                        } else {
                            echo "";
                        }
                        ?>
                    </textarea><br>
                </div>


                Image: <input type='file' name='image' size='14'>
                <div>
                    <input class="btn btn-success" type='submit' value='Save Profile'>
                </div>
            </form>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<?php require_once 'footer.php'; ?>
