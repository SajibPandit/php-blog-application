<?php
    require_once '../vendor/autoload.php';
    $cat =new \App\classes\Category();
    $blog=new \App\classes\Blog();
    if (isset($_GET['cat'])){
        $id=$_GET['id'];
        $cat->deleteCategory($id);
}
if (isset($_GET['blog'])){
    $id=$_GET['id'];
    $blog->deleteBlog($id);
}