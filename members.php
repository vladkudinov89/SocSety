<?php
require_once 'header.php';

if (!$loggedin) die();

if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);

    require_once 'header.php';

    if ($view == $user) $name = "Ваш";
    else                $name = "$view's";
    ?>


    <?php
    $page = "members";
    require_once 'left-menu.php';
    $result = queryMysql("SELECT * FROM profiles WHERE user='$view'");

    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <h3><span class="text-bold">Профиль</span>
                    <span class="text-blue"><?= $row['user_name'] ?> <?= $row['user_secondName'] ?></span>
                </h3>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
      -------------------------->
            <div class="col-md-3">

                <div class="form-group clearfix">
                    <img src="<?= $row['user_image'] ?>" class="message-img-left img-width" alt="User Image">
                </div>
                <div class="form-group">
                    <a class="btn-block btn btn-primary"
                       href="messages.php?view=<?= $view ?>">Сообщения
                        с <?= $row['user_name'] ?> <?= $row['user_secondName'] ?>
                    </a>
                </div>

            </div>
            <div class="col-md-4">
                <h3 class="text-bold">Имя:</h3>
                <p class="profile-p">
                    <?= $row['user_name'] ?>
                </p>

                <h3 class="text-bold">Фамилия:</h3>
                <p class="profile-p">
                    <?= $row['user_secondName'] ?>
                </p>
                <h3 class="text-bold">О себе:</h3>
                <p class="profile-p">
                    <?= $row['text'] ?>
                </p>

            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <?php
    require_once 'footer.php';
} else {

    $page = "members";
    require_once 'left-menu.php' ?>
    <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Все друзья
            </h1>
        </section>

        <!-- Main content -->
        <section class="content col-md-6">
            <?php
            if (isset($_GET['add'])) {

                $add = sanitizeString($_GET['add']);

                $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");

                if (!$result->num_rows)
                    queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
            }//if

            elseif (isset($_GET['remove'])) {
                $remove = sanitizeString($_GET['remove']);
                queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
            }//elseif

            $result = queryMysql("SELECT user FROM members ORDER BY user");
            $num = $result->num_rows;
            ?>

            <ul>
                <?php for ($j = 0; $j < $num; ++$j) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    if ($row['user'] == $user) {
                        continue;
                    }
                    ?>
                    <li class="form-group bg-gray-light clearfix">
                        <?php $filename = "dist/img/image_users/" . $row['user'] . ".jpg";
                        /*echo $filename;*/
                        if (file_exists($filename)) { ?>
                            <img src="dist/img/image_users/<?= $row['user'] ?>.jpg" class="member-img img-circle"
                                 alt="User Image">
                        <?php } else { ?>
                            <img src="dist/img/image_users/no_image.jpg" class="member-img img-circle"
                                 alt="User Image">
                        <?php } ?>


                        <h3 class="">Логин:
                            <a href="members.php?view=<?= $row['user'] ?>">
                                <?= $row['user'] ?>
                            </a>
                        </h3>


                            <h3 class="members-h3">Статус: </h3>
                            <div>
                                <?php
                                $follow = "подписаться";

                                $result1 = queryMysql("SELECT * FROM friends WHERE user='" . $row['user'] . "' AND friend='$user'");
                                $t1 = $result1->num_rows;

                                $result1 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='" . $row['user'] . "'");
                                $t2 = $result1->num_rows;

                                if (($t1 + $t2) > 1){ ?>
                                    <h3 class="members-friend">Ваш друг</h3>
                                <?php }
                                elseif ($t1) { ?>
                                    <h3 class="members-friend">Вы подписаны</h3>
                                <?php }
                                elseif ($t2) { ?>
                                    <h3 class="members-friend">подписан на вас</h3>
                                    <?php $follow = "добавить в друзья";
                                }

                                if (!$t1) { ?>
                                    <div class="members-a">
                                        <a class="btn btn-success" href="members.php?add=<?= $row['user'] ?>"><?= $follow ?></a>
                                    </div>
                                <?php } else { ?>
                                   <div class="members-a">
                                       <a class="btn btn-danger" href="members.php?remove=<?= $row['user'] ?> ">удалить из
                                           друзей</a>
                                   </div>
                                <?php } ?>
                            </div>

                    </li>
                <?php }//for ?>
                <!--------------------------
                  | Your Page Content Here |
                  -------------------------->


            </ul>
        </section>
        <div class="clearfix"></div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php }

require_once 'footer.php';