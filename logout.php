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
                   You have been logged out. Please <a href='index.php'>click here</a> to refresh the screen.
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
                    You cannot log out because you are not logged in <a href='index.php'>click here</a>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
<?php }

require_once 'footer.php' ?>
