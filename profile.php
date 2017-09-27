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
                <li class="active"><a href="#"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a></li>
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
                Page Header
                <small>Optional description</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->
            <?php
            echo "<h3>Your Profile</h3>";

            $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

            if (isset($_POST['text'])) {
                $text = sanitizeString($_POST['text']);
                $text = preg_replace('/\s\s+/', ' ', $text);

                if ($result->num_rows)
                    queryMysql("UPDATE profiles SET text='$text' where user='$user'");
                else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
            } else {
                if ($result->num_rows) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $text = stripslashes($row['text']);
                } else $text = "";
            }

            $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

            if (isset($_FILES['image']['name'])) {
                $saveto = "$user.jpg";
                move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
                $typeok = TRUE;

                switch ($_FILES['image']['type']) {
                    case "image/gif":
                        $src = imagecreatefromgif($saveto);
                        break;
                    case "image/jpeg":  // Both regular and progressive jpegs
                    case "image/pjpeg":
                        $src = imagecreatefromjpeg($saveto);
                        break;
                    case "image/png":
                        $src = imagecreatefrompng($saveto);
                        break;
                    default:
                        $typeok = FALSE;
                        break;
                }

                if ($typeok) {
                    list($w, $h) = getimagesize($saveto);

                    $max = 100;
                    $tw = $w;
                    $th = $h;

                    if ($w > $h && $max < $w) {
                        $th = $max / $w * $h;
                        $tw = $max;
                    } elseif ($h > $w && $max < $h) {
                        $tw = $max / $h * $w;
                        $th = $max;
                    } elseif ($max < $w) {
                        $tw = $th = $max;
                    }

                    $tmp = imagecreatetruecolor($tw, $th);
                    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                    imageconvolution($tmp, array(array(-1, -1, -1),
                        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                    imagejpeg($tmp, $saveto);
                    imagedestroy($tmp);
                    imagedestroy($src);
                }
            }

            showProfile($user);

           ?>
    <form method='post' action='profile.php' enctype='multipart/form-data'>
    <h3>Enter or edit your details and/or upload an image</h3>
    <textarea name='text' cols='50' rows='3'><?= $text ?></textarea><br>


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
