
<?php
require_once 'header.php';

if (!$loggedin) die();
?>
<div class="wrapper">


    <?php
    $page = "profile";
    require_once 'left-menu.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактирование профиля
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Content |
      -------------------------->
            <?php

            $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

            if ($result->num_rows) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
            }
            ?>
            <form method='post' action='save_profile.php' enctype='multipart/form-data'>
                <div class="form-group">
                    <img src="<?php  echo $row['user_image'] ?>" class="img-bordered" alt="User Image">

                </div>
                <div class="form-group">
                    <div class="text-bold">Выбрать изображение:</div>
                    <input class="btn btn-primary" type='file' id="image-profile" name='image' size='14'>
                </div>
                <div class="form-group">
                    <div class="text-bold">Ваше Имя:</div>
                    <input type="text" required name="user_name" id="user_name" value="<?php
                    if (isset($row['user_name'])) {
                        echo $row['user_name'];
                    } else {
                        echo "";
                    }
                    ?> ">
                </div>
                <div class="form-group">
                    <div class="text-bold">Ваша Фамилия:</div>
                    <input type="text" required name="user_secondName" id="user_secondName" value="<?php
                    if (isset($row['user_secondName'])) {
                        echo $row['user_secondName'];

                    } else {
                        echo "";
                    }
                    ?> ">
                </div>
                <div class="form-group">
                    <div class="text-bold">О себе:</div>
                    <textarea class="about-me" name='text' id="text" cols='50' rows='3'><?php if (isset($row['text'])) echo $row['text']; else { echo "";} ?>
                    </textarea>
                </div>


                <div class="form-group">
                    <input class="btn btn-success" id="edit-profile" type='submit' value='Сохранить'>
                </div>
            </form>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php require_once 'footer.php'; ?>
