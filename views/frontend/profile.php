<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 my-3">
                <h4 class="mb-3">User Profile</h4>
                <?php if(isset($_SESSION['expire'])){
                $diff = time() - $_SESSION['expire'];
                if($diff > 2){
                    unset($_SESSION['msg']);
                    unset($_SESSION['expire']);
                }
                }
                ?>
                <?php if(isset($_SESSION['msg'])){ ?>   
                    <div class="alert alert-success alert-dismissible fade show pb-3" role="alert">

                    <?php echo $_SESSION['msg'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }?>
                <?php 
                $id = $_SESSION['auth']['id'];
                $user = $query->get("users", "*", null, "id = $id");

                ?>
                <img src="./assets/profiles/<?= $user['profile'] ?>" width="100px" height="100px" alt="" class=" my-3 rounded-circle">
                <form class="d-inline text-end" action="./controllers/UserController.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $_SESSION['auth']['id'] ?>">
                    <input type="file" style="width:100px" name="profile" id="">
                    <input type="hidden" name="action" value="profileUpload">
                    <button class="btn btn-sm btn-primary" type="submit">Upload</button>
                </form>
                <p>Name: <?= $user['name'] ?></p>
                <p>Email: <?= $user['email'] ?></p>
                <p>Created At: <?= date("F d, Y - H:iA", strtotime($user['created_at'])) ?></p>
                <p>Updated At: <?= date("F d, Y - H:iA", strtotime($user['updated_at']))  ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 my-3">
                <h3>My Balance is : <?php 
                        $id = $_SESSION['auth']['id'];
                        $balances = $query->balance($id);
                        echo $balances." MMK";
                        ?></h3>
                <!-- <p>Total Expense : </p>
                <p>Total Income : </p> -->
                <p>Date: <?php date_default_timezone_set('Asia/Yangon'); echo date('F/d/Y'); ?></p>
            </div>
        </div>
    </div>
</div>