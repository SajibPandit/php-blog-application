<?php


namespace App\classes;


class Blog
{
    public function addBlog($data)
    {
        $files_name=$_FILES['photo']['name'];
        $photoEx=explode('.',$files_name);
        $photoEx=end($photoEx);
        $photoName=date('ymdhis.').$photoEx;
        $title=mysqli_real_escape_string(Database::dbCon(),$data['title']);
        $content=mysqli_real_escape_string(Database::dbCon(),$data['content']);
        $status=$data['status'];
        $catId=$data['cat_id'];
        $name=$_SESSION['name'];
        $sql = "INSERT INTO `blog`(`cat_id`, `title`, `content`, `photo`, `name`, `status`) VALUES ('$catId','$title','$content','$photoName','$name','$status')";
        $x = mysqli_query(Database::dbCon(), $sql);
        if ($x) {
            move_uploaded_file($_FILES['photo']['tmp_name'],'../uploads/'.$photoName);
            $insertMsg = "Blog Save Success";
            return $insertMsg;
        } else {
            $insertMsg = "Blog Not Saved";
            return $insertMsg;
        }

    }
    public function allBlog(){
        $x=mysqli_query(Database::dbCon(),"SELECT `blog`. * ,`category`.`category_name` FROM `blog` INNER JOIN `category` ON `blog`.`cat_id`=`category`.`id` ORDER BY `id` DESC");
        return $x;
    }
    public function blogActive($id){
        mysqli_query(Database::dbCon(),"UPDATE `blog` SET `status`='1' WHERE `id`='$id'");
        header('location:manage-blog.php');
    }
    public function blogInctive($id){
        mysqli_query(Database::dbCon(),"UPDATE `blog` SET `status`='0' WHERE `id`='$id'");
        header('location:manage-blog.php');
    }
    public function deleteBlog($id){
        mysqli_query(Database::dbCon(),"DELETE FROM `blog` WHERE `id`='$id'");
        header('location:manage-blog.php');
    }
    public function selectBlog($id){
        return mysqli_query(Database::dbCon(),"SELECT * FROM `blog` WHERE `id`='$id'");
    }
    public function updateBlog($data){

        $name=$_SESSION['name'];
        $title=mysqli_real_escape_string(Database::dbCon(),$data['title']);
        $content=mysqli_real_escape_string(Database::dbCon(),$data['content']);
        $status=$data['status'];
        $catId=$data['cat_id'];
        $id=$_POST['id'];
        if($_FILES['photo']['name']==NULL){
            $sql="UPDATE `blog` SET `cat_id`='$catId',`title`='$title',`content`='$content',`name`='$name',`status`='$status' WHERE `id`='$id'";
        }else{
            $files_name=$_FILES['photo']['name'];
            $photoEx=explode('.',$files_name);
            $photoEx=end($photoEx);
            $photoName=date('ymdhis.').$photoEx;

            $sql="UPDATE `blog` SET `cat_id`='$catId',`title`='$title',`content`='$content',`photo`='$photoName',`name`='$name',`status`='$status' WHERE `id`='$id'";
            move_uploaded_file($_FILES['photo']['tmp_name'],'../uploads/'.$photoName);
        }
        $x= mysqli_query(Database::dbCon(),$sql);
        if ($x){
            header('location:edit-blog.php?msg=Blog Updated Succsessfully&id='.$id);

        }else{
            header('location:edit-blog.php?msg=Blog Update Failed&id='.$id);
        }

    }
}