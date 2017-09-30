<?php

require_once 'header.php';

$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if ($result->num_rows)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
}
?>

    <div class="wrapper">

<?php
$page = "profile";
require_once 'left-menu.php' ?>

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
?>