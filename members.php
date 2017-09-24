<?php // Example 26-9: members.php
require_once 'header.php';

if (!$loggedin) die();?>

<div class='wrapper'>
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
                    <p>Alexander Pierce</p>
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
                <li><a href="profile.php"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a></li>
                <li class="active"><a href="#"><i class="fa fa-envelope"></i> <span>Сообщения</span></a></li>

                <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                <li><a href="friends.php"><i class="fa fa-user-o"></i> <span>Друзья</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
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
        Page Header
        <small>Optional description</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<?php
if (isset($_GET['add']))
{

    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");

    if (!$result->num_rows)
        queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
}
elseif (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}

$result = queryMysql("SELECT user FROM members ORDER BY user");
$num    = $result->num_rows;

?>
<h3>Other Members</h3>
<ul>

<?php for ($j = 0 ; $j < $num ; ++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) {
        continue;
    }

    echo "<li><a href='members.php?view=" .
        $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE user='" . $row['user'] . "' AND friend='$user'");

    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='" . $row['user'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
        $follow = "recip"; }

    if (!$t1) echo " [<a href='members.php?add="   .$row['user'] . "'>$follow</a>]" ;
    else      echo " [<a href='members.php?remove=".$row['user'] . "'>drop</a>]";
} ?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        </li>
</ul>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php

require_once 'footer.php';