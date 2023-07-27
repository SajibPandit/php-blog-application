<?php
require_once 'header.php';
require_once 'vendor/autoload.php';
$cat= new \App\classes\Category();
$category= $cat->allActiveCategory();
$getId=$_GET['id'];
$singlePost=$cat->singlePost($getId);
$row1=mysqli_fetch_assoc($singlePost);
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Post -->
                <div class="card mb-4">
                    <img style="width:100%;height: auto;" class="card-img-top" src="uploads/<?= $row1['photo'] ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?= $row1['title'] ?></h2>
                        <p class="card-text"><?= $row1['content']; ?>...</p>
                        </div>
                    <div class="card-footer text-muted">
                        Posted on <?= date('d M Y',strtotime($row1['createtime'])) ?> by
                        <a href="#"><?= $row1['name'] ?></a>
                    </div>
                </div>
            </div>
            <?php require_once 'widget.php'?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once 'footer.php'?>