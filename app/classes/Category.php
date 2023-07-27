<?php


namespace App\classes;
use App\classes\Database;

class Category
{
    public function addCategory($data){
        $category_name=$data['category_name'];
        $status=$data['status'];
        $sql="INSERT INTO `category` (`category_name`, `status`) VALUES ('$category_name','$status');";
        $x= mysqli_query(Database::dbCon(),$sql);
        if ($x){
            $insertMsg="Category Save Success";
            return $insertMsg;
        }else{
            $insertMsg="Category Not Saved";
            return $insertMsg;
        }

    }
    public function updateCategory($data){
        $category_name=$data['category_name'];
        $status=$data['status'];
        $id=$data['id'];
        $sql="UPDATE `category` SET `category_name`='$category_name', `status`='$status' WHERE `id`='$id';";
        $x= mysqli_query(Database::dbCon(),$sql);
        if ($x){
            header('location:edit-category.php?msg=Category Updated Succsessfully&id='.$id);

        }else{
            header('location:edit-category.php?msg=Category Update Failed&id='.$id);
        }

    }
    public function allCategory(){
        $x=mysqli_query(Database::dbCon(),"SELECT * FROM `category`");
        return $x;
    }
    public function allActiveCategory(){
        $x=mysqli_query(Database::dbCon(),"SELECT * FROM `category` WHERE `status`=1");
        return $x;
    }
    public function allActivePost(){
        $x=mysqli_query(Database::dbCon(),"SELECT * FROM `blog` WHERE `status`=1 ORDER BY `id` DESC ");
        return $x;
    }
    public function catPost($cat_id){
        $x=mysqli_query(Database::dbCon(),"SELECT * FROM `blog` WHERE `status`=1 AND `cat_id`='$cat_id' ORDER BY `id` DESC");
        return $x;
    }
    public function selectCategory($id){
        return mysqli_query(Database::dbCon(),"SELECT * FROM `category` WHERE `id`='$id'");
    }
    public function searchBLog($text){
        return mysqli_query(Database::dbCon(),"SELECT * FROM `blog` WHERE `content` LIKE '%$text%' AND `status`=1 ORDER BY `id` DESC ");
    }
    public function statusActive($id){
        mysqli_query(Database::dbCon(),"UPDATE `category` SET `status`='1' WHERE `id`='$id'");
        header('location:manage-category.php?msg=Category Activated');
    }
    public function statusInctive($id){
        mysqli_query(Database::dbCon(),"UPDATE `category` SET `status`='0' WHERE `id`='$id'");
        header('location:manage-category.php?msg=Category is Inactive now');
    }
    public function deleteCategory($id){
        mysqli_query(Database::dbCon(),"DELETE FROM `category` WHERE `id`='$id'");
        header('location:manage-category.php');
    }
    public function singlePost($id){
        return mysqli_query(Database::dbCon(),"SELECT * FROM `blog` WHERE `id`='$id'");
    }
}