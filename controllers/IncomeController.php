<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

if(isset($_POST['indate'])){
    $indate = $_POST['indate'];
    $description = $_POST["description"];
    $qty = $_POST['qty'];
    $unitprice = $_POST['unitprice'];
    if($indate == "" | $description == "" | $qty == "" | $unitprice == ""){
        $_SESSION['error'] = "Data is Missing";
        $_SESSION['expire']= time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        $datas = [
            'indate' => $indate,
            'description' => $description,
            'qty' => $qty,
            'unitprice' => $unitprice,
            'total' => $qty*$unitprice,
            'created_by' => $_POST['created_by']
        ];
        if($_POST['action']=="add"){
            $expadd = $query->create("incomes", $datas);
            if($expadd){
                $_SESSION['msg']="Income Data Added Successfully";
                $_SESSION['expire']=time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
        }elseif($_POST['action']=="edit"){
            $id = $_POST['id'];
            $expedit = $query->update("incomes", $datas, $id);
            if($expedit){
                $_SESSION['msg']="Income Data Edited Successfully";
                $_SESSION['expire']=time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
        }
    }
}

if($_POST['action']=="delete"){
    $id = $_POST['id'];
    $expdelete = $query->delete("incomes", $id);
    if($expdelete){
        $_SESSION['msg']="Income Data Deleted Successfully";
        $_SESSION['expire']=time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

?>