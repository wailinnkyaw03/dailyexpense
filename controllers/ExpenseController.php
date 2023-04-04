<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

if(isset($_POST['expdate'])){
    $expdate = $_POST['expdate'];
    $description = $_POST["description"];
    $qty = $_POST['qty'];
    $unitprice = $_POST['unitprice'];
    if($expdate == "" | $description == "" | $qty == "" | $unitprice == ""){
        $_SESSION['error'] = "Data is Missing";
        $_SESSION['expire']= time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        $datas = [
            'expdate' => $expdate,
            'description' => $description,
            'qty' => $qty,
            'unitprice' => $unitprice,
            'total' => $qty*$unitprice,
            'created_by' => $_POST['created_by']
        ];
        if($_POST['action']=="add"){
            $expadd = $query->create("expenses", $datas);
            if($expadd){
                $_SESSION['msg']="Expense Data Added Successfully";
                $_SESSION['expire']=time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
        }elseif($_POST['action']=="edit"){
            $id = $_POST['id'];
            $expedit = $query->update("expenses", $datas, $id);
            if($expedit){
                $_SESSION['msg']="Expense Data Edited Successfully";
                $_SESSION['expire']=time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
        }
    }
}

if($_POST['action']=="delete"){
    $id = $_POST['id'];
    $expdelete = $query->delete("expenses", $id);
    if($expdelete){
        $_SESSION['msg']="Expense Data Deleted Successfully";
        $_SESSION['expire']=time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

?>