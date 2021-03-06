<!DOCTYPE html>
<html lang="en">

<head>

    <?= $this->include('layouts\partials\header') ?>
    <?= $this->renderSection('header') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- call sidebar -->
        <?= $this->include('layouts\partials\sidebar') ?>
        <!-- end of sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- call topbar -->
                <?= $this->include('layouts\partials\topbar') ?>
                <!-- end of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- call footer -->
            <?= $this->include('layouts\partials\footer') ?>
            <!-- end of footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- call modals pages -->
    <?= $this->include('layouts\partials\modals') ?>


    <!-- call scripts pages -->
    <?= $this->include('layouts\partials\scripts') ?>
    <?= $this->renderSection('scripts') ?>
</body>

</html>