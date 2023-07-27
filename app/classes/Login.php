<?php


namespace App\classes;
use App\classes\Database;

class Login
{
    public function loginCheck($data){
        $username=$data['username'];
        $password=md5($data['password']);
        $reasult =mysqli_query(Database::dbCon(),"SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password';");
        if ($reasult){
            if (mysqli_num_rows($reasult)==1){
                $row=mysqli_fetch_assoc($reasult);
                session_start();
                $_SESSION['user_id']= $row['id'];
                $_SESSION['username']=$row['username'];
                $_SESSION['name']=$row['name'];
                header('location:index.php');
            }else{
                $loginError="Username or Password invalid";
                return $loginError;
            }
        }else{
            die();
        }

    }
}