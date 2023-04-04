<?php 
session_start();
include("./app/DB.php");
include("./app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

if(!isset($_SESSION['auth'])){
    header("location: login.php");
}

include("./views/frontend/layouts/head.php");
include("./views/frontend/layouts/sidebar.php");
include("./views/frontend/layouts/nav.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "dashboard"){
        include("./views/frontend/dashboard.php");
    }elseif($page == "admindashboard"){
        $users = $query->getAll("users", "*", null, null, null);
        include("./views/frontend/admindashboard.php");
    }elseif($page=="profile"){
        include("./views/frontend/profile.php");
    }elseif($page == "expenselist"){
        $id = $_SESSION['auth']['id'];
        $expmonths = $query->getAll("expenses", "DATE_FORMAT(expdate, '%M-%Y') as month", null, "created_by = $id", "expdate DESC");
        if(isset($_GET['month'])){
            $month = $_GET['month'];
            $expenses = $query->getAll("expenses", "*", null, "created_by = $id AND MONTH(expdate)='$month'", "created_at DESC");
        }else{
            $expenses = $query->getAll("expenses", "*", null, "created_by = $id", "created_at DESC");
        }
        
        // $expmonths = $query->getAllMonth($id);
        include("./views/frontend/expense.php");
    }elseif($page == "incomelist"){
        $id = $_SESSION['auth']['id'];
        $incomes = $query->getAll("incomes", "*", null, "created_by = $id", "created_at DESC");
        include("./views/frontend/income.php");
    }
}else{
    include("./views/frontend/dashboard.php");
}


include("./views/frontend/layouts/footer.php");
include("./views/frontend/layouts/script.php");



?>