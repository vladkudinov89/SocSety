<?php // Example 26-12: logout.php
require_once 'header.php'; ?>

<?php if (isset($_SESSION['user'])) {
    /*destroySession();*/
    session_destroy(); ?>

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   Спасибо за использование нашей сети
                </h1>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                <!--------------------------
                  | Your Page Content Here |
    -------------------------->

                <div>
                   Для выхода <a href='index.php'> нажмите сюда</a>.
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
<?php } else { ?>
    <div class="wrapper">
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

                <div>
                    Вы не залогированны. <a href='index.php'>Залогируйтесь</a>,пожалуйста
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
<?php }

require_once 'footer.php' ?>
