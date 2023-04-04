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

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email == "" | $password == ""){
        if($email == ""){
            $_SESSION['v-email'] = "*Email Must Not Be Empty";
        }
        if($password == ""){
            $_SESSION['v-password'] = "*Password Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-email']);
        unset($_SESSION['v-password']);

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($_POST['action'] == "login"){
            $userlogin = $user->login($email, $password);
            // echo "<pre>";
            // print_r($userlogin);
            // echo "</pre>";
            // die;
            if(password_verify($password, $userlogin['password'])){
                $_SESSION['auth'] = $userlogin;
                $_SESSION['msg'] = "Login Success!";
                $_SESSION['expire'] = time();
                header("location: ../index.php");
            }else{
                $_SESSION['error'] = "Invalid Access!";
                $_SESSION['expire'] = time();
                header("location: ../login.php");
            }
        }

    }
}

if($_POST['action']=='profileUpload'){
    $profile_arr = $_FILES['profile']['name'];
    $tmp_name = $_FILES['profile']['tmp_name'];
    $folder = "../assets/profiles/";
    $profile = uniqid().$profile_arr;
    move_uploaded_file($tmp_name,$folder.$profile);

    $id = $_POST['id'];
    $datas = [
        'profile' => $profile
    ];

    $profileUpload = $user->update('users', $datas, $id);
    if($profileUpload){
        $_SESSION['msg'] = "Profile Image Uploaded Successfully.";
        $_SESSION['expire'] = time();
        header("location: ../index.php?page=profile");
    }
}

if($_GET['action']=='logout'){
    unset($_SESSION['auth']);
    header("location: ../index.php");
}

?>