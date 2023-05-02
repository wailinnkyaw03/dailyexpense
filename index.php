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
        $expmonths = $query->getAll("expenses", "DISTINCT DATE_FORMAT(expdate, '%m') as month, DATE_FORMAT(expdate, '%Y') as year, DATE_FORMAT(expdate, '%M-%Y') as exp", null, "created_by = $id", "expdate DESC");
        if(isset($_GET['month'])){
            $month = $_GET['month'];
            $year = $_GET['year'];
            $expenses = $query->getAll("expenses", "*", null, "created_by = $id AND MONTH(expdate)=$month AND YEAR(expdate)=$year", "created_at DESC");
            $exptotal = $query->getAll("expenses", "sum(total) as exptotal", null, "created_by=$id AND MONTH(expdate)=$month AND YEAR(expdate)=$year", null);
        }else{
            $expenses = $query->getAll("expenses", "*", null, "created_by = $id", "created_at DESC");
            $exptotal = $query->getAll("expenses", "sum(total) as exptotal", null, "created_by=$id", null);
        }
        
        // $expmonths = $query->getAllMonth($id);
        include("./views/frontend/expense.php");
    }elseif($page == "incomelist"){
        $id = $_SESSION['auth']['id'];
        $inmonths = $query->getAll("incomes", "DISTINCT DATE_FORMAT(indate, '%m') as month, DATE_FORMAT(indate, '%Y') as year, DATE_FORMAT(indate, '%M-%Y') as income", null, "created_by = $id", "indate DESC");
        if(isset($_GET['month'])){
            $month = $_GET['month'];
            $year = $_GET['year'];
            $incomes = $query->getAll("incomes", "*", null, "created_by = $id AND MONTH(indate)=$month AND YEAR(indate)=$year", "created_at DESC");
            $intotal = $query->getAll("incomes", "sum(total) as intotal", null, "created_by=$id AND MONTH(indate)=$month AND YEAR(indate)=$year", null);
        }else{
            $incomes = $query->getAll("incomes", "*", null, "created_by = $id", "created_at DESC");
            $intotal = $query->getAll("incomes", "sum(total) as intotal", null, "created_by=$id", null);
        }
        // $incomes = $query->getAll("incomes", "*", null, "created_by = $id", "created_at DESC");
        include("./views/frontend/income.php");
    }
}else{
    include("./views/frontend/dashboard.php");
}


include("./views/frontend/layouts/footer.php");
include("./views/frontend/layouts/script.php");



?>