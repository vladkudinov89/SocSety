<?php // Example 26-11: messages.php
require_once 'header.php';

if (!$loggedin) die(); ?>

    <div class="wrapper">


        <!--Left side column . contains the logo and sidebar-->
        <aside class="main-sidebar">

            <!--sidebar: style can be found in sidebar . less-->
            <section class="sidebar">

                <!--Sidebar user panel(optional)-->
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
                    <li><a href="profile.php"><i class="fa  fa-address-card-o"></i> <span>Профиль</span></a></li>
                    <li class="active"><a href="messages.php?view=<?php echo $user; ?>"><i class="fa fa-envelope"></i>
                            <span>Сообщения</span></a></li>
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
                <?php if (isset($_GET['view'])) {
                    $view = sanitizeString($_GET['view']);
                }//if
                else {
                    $view = $user;
                }//else

                if (isset($_POST['text'])) {
                    $text = sanitizeString($_POST['text']);

                    if ($text != "") {
                        $pm = substr(sanitizeString($_POST['pm']), 0, 1);
                        $time = time();
                        queryMysql("INSERT INTO messages VALUES(NULL, '$user', '$view', '$pm', $time, '$text')");
                    }
                }//if

                if ($view != "") {

                    if ($view == $user) {
                       /* echo "view: $view<br>";
                        echo "user: $user"; */?>

                        <h3>Мои сообщения</h3>
                       <div>
                           <a class="btn btn-default" href="messages.php?view=<?= $view ?>">Обновить сообщения</a>
                       </div>
                        <br>
                        <?php

                        if (isset($_GET['erase'])) {
                            $erase = sanitizeString($_GET['erase']);
                            queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
                        }

                        $query = "SELECT * FROM messages WHERE recip='$user' ORDER BY time DESC";
                        $result = queryMysql($query);
                        $num = $result->num_rows;

                        for ($j = 0; $j < $num; ++$j) {
                            $row = $result->fetch_array(MYSQLI_ASSOC); ?>

                            <div class="form-group bg-gray col-md-9">

                                <div class="">
                                    <div class="user-panel ">
                                        <div class="pull-left image">
                                            <img src="<?= $row['auth'] ?>.jpg" class="img-circle" alt="User Image">
                                        </div>
                                        <div class="pull-left info">
                                            <p class="color"><?= $row['auth'] ?></p>
                                            <!-- Status -->
                                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user) { ?>

                                <div>
                                    <?php
                                    echo date('M jS \'y g:ia:', $row['time']);
                                    if ($row['pm'] == 0)
                                    echo "написал : &quot;" . $row['message'] . "&quot; ";
                                    else ?>
                                    <div>
                                        <span class="text-bold">Сообщение:</span> <span> <?= $row['message'] ?> </span>
                                    </div>

                                    <a class="btn btn-success btn-margin" href='messages.php?view=<?= $row['auth'] ?>'>Читать</a>
                                    <?php if ($row['recip'] !== $row['auth'] || $row['recip'] == $user || $user == $row['auth']) { ?>
                                        <a class="btn btn-danger"
                                           href="messages.php?view=<?php echo $view ?>&erase=<?= $row['id'] ?>">
                                            Удалить
                                        </a>
                                    <?php }//if

                                    } ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <?php
                        } ?>

                    <?php }//if

                    else {
                        echo "view: $view<br>";
                        echo "user: $user";

                        $name1 = "<a href='members.php?view=$view'>$view</a>";
                        $name2 = "$view's"; ?>

                        <h3>Чат с : <?= $name1; ?></h3>

                        <form method='post' action='messages.php?view=<?= $view; ?>'>
                            Оставьте свое сообщение:<br>
                            <textarea name='text' cols='40' rows='3'></textarea><br>
                            <input type='radio' name='pm' value='1' checked='checked' hidden>
                            <input type='submit' value='Отправить' class="btn btn-success">
                        </form>

                        <?php if (isset($_GET['erase'])) {
                            $erase = sanitizeString($_GET['erase']);
                            queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
                        }

                        $query = "SELECT * FROM messages WHERE pm=1 
                            AND 
                             ((recip='$user' AND auth='$view') 
                            OR
                              (recip='$view' AND auth='$user'))
                             ORDER BY time DESC";
                        $result = queryMysql($query);
                        $num = $result->num_rows;

                        for ($j = 0; $j < $num; ++$j) {
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            /*print_r($row) ;*/
                            ?>
                            <div class="form-group bg-gray-light"> <?php
                                ?>
                                <div>Автор
                                    <?php echo $row['auth']; ?>
                                </div>
                                <?php
                                /*echo $row['recip'];
                                echo $user;*/

                                if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user) {
                                    echo date('M jS \'y g:ia:', $row['time']);
                                    ?>
                                    <div class="user-panel">
                                        <div class="pull-left image">
                                            <img src="<?= $row['auth'] ?>.jpg" class="img-circle" alt="User Image">
                                        </div>
                                        <div class="pull-left info">
                                            <p><?php echo $user; ?></p>
                                            <!-- Status -->
                                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                        </div>
                                    </div>
                                    <a  href='messages.php?view=<?= $row['auth'] ?>'><?= $row['auth'] ?>

                                    </a>
                                    <?php

                                    if ($row['pm'] == 0)
                                        echo "написал : &quot;" . $row['message'] . "&quot; ";
                                    else
                                        echo "приватное сообщени: <span class='whisper'>&quot;" .
                                            $row['message'] . "&quot;</span> ";

                                    if ($row['recip'] !== $row['auth'] || $row['recip'] == $user || $user == $row['auth'])
                                        echo "[<a href='messages.php?view=$view" .
                                            "&erase=" . $row['id'] . "'>удалить</a>]";

                                }
                                ?> </div> <?php
                        } ?>
                    <?php }//else ?>


                    <br>


                <?php }

                if (!$num) echo "<br><span class='info'>No messages yet</span><br><br>";




                ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

<?php require_once 'footer.php'; ?>