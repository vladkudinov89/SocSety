<?php // Example 26-10: friends.php
require_once 'header.php';

if (!$loggedin) die(); ?>

    <div class="wrapper">


<?php
$page = "friends";
require_once 'left-menu.php';
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Content |
      -------------------------->

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#friends" data-toggle="tab">Друзья</a></li>
                <li><a href="#subscribers" data-toggle="tab">Ваши подписчики</a></li>
                <li><a href="#your_subscribers" data-toggle="tab">Вы подписаны</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">


                <?php
                if (isset($_GET['view'])) {
                    $view = sanitizeString($_GET['view']);
                } else {
                    $view = $user;
                }

                if ($view == $user) {
                    $name1 = $name2 = "Ваши";
                    $name3 = "Вы";
                } else {
                    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
                    $name2 = "$view's";
                    $name3 = "$view is";
                }


                // Uncomment this line if you wish the user’s profile to show here
                // showProfile($view);

                $followers = array();
                $following = array();

                $result = queryMysql("SELECT * FROM friends WHERE user='$view'");
                $num = $result->num_rows;

                for ($j = 0; $j < $num; ++$j) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $followers[$j] = $row['friend'];
                    /* echo $followers[$j];*/
                }

                $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
                $num = $result->num_rows;

                for ($j = 0; $j < $num; ++$j) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $following[$j] = $row['user'];
                    /* echo $row['user'];*/
                }//for

                $mutual = array_intersect($followers, $following);
                $followers = array_diff($followers, $mutual);
                $following = array_diff($following, $mutual);
                $friends = FALSE;
                ?>

                <div class="tab-pane fade in active" id="friends">
                    <?php if (sizeof($mutual)) { ?>
                        <h3><?= $name2 ?> друзья</h3>
                        <ul>
                            <?php foreach ($mutual as $friend) { ?>
                                <li class="form-group bg-gray col-md-9">
                                    <!--<a href='members.php?view=<? /*= $friend */ ?>'>
                                        <? /*= $friend */ ?>
                                    </a>-->
                                    <?php
                                    $result = queryMysql("SELECT * FROM profiles WHERE user='$friend'");

                                    if ($result->num_rows) {
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                    } ?>

                                    <?php $filename = "dist/img/image_users/$friend.jpg";
                                    /*echo $filename;*/
                                    if (file_exists($filename)) { ?>
                                        <img src="dist/img/image_users/<?= $friend ?>.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } else { ?>
                                        <img src="dist/img/image_users/no_image.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } ?>

                                    <a href="members.php?view=<?= $friend ?>">
                                        <?php if ($row['user_name'] !== '' || $row['user_secondName'] !== '') { ?>
                                            <?= $row['user_name'] ?> <?= $row['user_secondName'] ?>
                                        <?php } else { ?>
                                            <?php echo $friend; ?>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php }//foreach ?>
                        </ul>
                        <?php $friends = TRUE; ?>

                    <?php }//if ?>
                </div>
                <div class="tab-pane fade" id="subscribers">
                    <?php if (sizeof($followers)) { ?>
                        <h3><?= $name2 ?> подписчики</h3>
                        <ul>
                            <?php foreach ($followers as $friend) { ?>
                                <li class="form-group bg-gray col-md-9">
                                    <!--<a href='members.php?view=<? /*= $friend */ ?>'>
                                        <? /*= $friend */ ?>
                                    </a>-->
                                    <?php
                                    $result = queryMysql("SELECT * FROM profiles WHERE user='$friend'");

                                    if ($result->num_rows) {
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                    } ?>

                                    <?php $filename = "dist/img/image_users/$friend.jpg";
                                    /*echo $filename;*/
                                    if (file_exists($filename)) { ?>
                                        <img src="dist/img/image_users/<?= $friend ?>.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } else { ?>
                                        <img src="dist/img/image_users/no_image.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } ?>

                                    <a href="members.php?view=<?= $friend ?>">
                                        <?php if ($row['user_name'] !== '' || $row['user_secondName'] !== '') { ?>
                                            <?= $row['user_name'] ?> <?= $row['user_secondName'] ?>
                                        <?php } else { ?>
                                            <?php echo $friend; ?>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php }//foreach ?>
                        </ul>
                        <?php $friends = TRUE; ?>

                    <?php }//if ?>
                </div>
                <div class="tab-pane fade" id="your_subscribers">
                    <?php if (sizeof($following)) { ?>
                        <h3><?= $name2 ?> подписчики</h3>
                        <ul>
                            <?php foreach ($following as $friend) { ?>
                                <li class="form-group bg-gray col-md-9">
                                    <!--<a href='members.php?view=<? /*= $friend */ ?>'>
                                        <? /*= $friend */ ?>
                                    </a>-->
                                    <?php
                                    $result = queryMysql("SELECT * FROM profiles WHERE user='$friend'");

                                    if ($result->num_rows) {
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                    } ?>

                                    <?php $filename = "dist/img/image_users/$friend.jpg";
                                    /*echo $filename;*/
                                    if (file_exists($filename)) { ?>
                                        <img src="dist/img/image_users/<?= $friend ?>.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } else { ?>
                                        <img src="dist/img/image_users/no_image.jpg" class="member-img img-circle"
                                             alt="User Image">
                                    <?php } ?>

                                    <a href="members.php?view=<?= $friend ?>">
                                        <?php if ($row['user_name'] !== '' || $row['user_secondName'] !== '') { ?>
                                            <?= $row['user_name'] ?> <?= $row['user_secondName'] ?>
                                        <?php } else { ?>
                                            <?php echo $friend; ?>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php }//foreach ?>
                        </ul>
                        <?php $friends = TRUE; ?>

                    <?php }//if ?>
                </div>

                <?php if (!$friends) { ?>
                    <div>У вас пока нет знакомых</div>
                <?php }//if ?>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php require_once 'footer.php';