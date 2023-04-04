<?php 
session_start();
include "./views/frontend/layouts/head.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card p-5 shadow" style="margin-top:10%">
                <h4 class="mb-4"><i class="fas fa-user me-2"></i>Register Now</h4>
                <form action="./controllers/UserController.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="name" placeholder="Username">
                        <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                        <?php 
                        if(isset($_SESSION['v-name'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-name'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                        <?php 
                        if(isset($_SESSION['v-email'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-email'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password"><i class="fas fa-key me-2"></i>Password</label>
                        <?php 
                        if(isset($_SESSION['v-password'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-password'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="text-end">
                        <input type="hidden" name="action" value="add">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-user me-2"></i>Register</button>
                        <button class="btn btn-dark" type="reset"><i class="fas fa-rotate me-2"></i>Reset</button>
                    </div>
                    <p class="mt-4">Already have an account? <a href="login.php" class="text-dark">Login Now</a></p>
                </form>
            </div>
            
        </div>
    </div>
</div>



<?php 
include "./views/frontend/layouts/script.php";
?>