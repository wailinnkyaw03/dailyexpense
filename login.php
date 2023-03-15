<?php 
session_start();

include "./views/backend/layouts/head.php";

include "./views/backend/layouts/nav.php";

include "./views/backend/layouts/footer.php";

?>
            <?php if(isset($_SESSION['expire'])){
                $diff = time() - $_SESSION['expire'];
                if($diff > 2){
                    unset($_SESSION['msg']);
                    unset($_SESSION['expire']);
                }
            }
            ?>
            <?php if(isset($_SESSION['msg'])){ ?>   
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php echo $_SESSION['msg'] ?>
            <?php } ?>