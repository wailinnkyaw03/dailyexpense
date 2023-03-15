<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$user = new QueryBuilder($connection);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($name == "" | $email == "" | $password == ""){
        if($name == ""){
            $_SESSION['v-name'] = "*Username Must Not Be Empty";
        }
        if($email == ""){
            $_SESSION['v-email'] = "*Email Must Not Be Empty";
        }
        if($password == ""){
            $_SESSION['v-password'] = "*Password Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-name']);
        unset($_SESSION['v-email']);
        unset($_SESSION['v-password']);

        $datas = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        if($_POST['action'] == "add"){
            $usercreate = $user->create("users", $datas);
            if($usercreate){
                $_SESSION['msg'] = "Register Success!";
                $_SESSION['expire'] = time();
                header("location: ../login.php");
            }
        }

    }
}

?>