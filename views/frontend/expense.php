<?php 
// date_default_timezone_set('UTC');
// $now = new DateTime();
// $now->setTimezone(new DateTimeZone('Asia/Yangon'));
// echo "<pre>";
// print_r($expmonths);
// echo "</pre>";
// die;

?>
<div class="container my-5">
    <div class="row">
        <h3 class="mb-4">Expense Lists 
          <button class="btn btn-sm btn-primary float-end" data-bs-target="#expenseModal" data-bs-toggle="modal">Add</button>
        </h3>
        <div class="dropdown mb-4">
          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Filter
          </button>
          <ul class="dropdown-menu">
            <?php foreach($expmonths as $expmonth): ?>
            <li><a class="dropdown-item" href="index.php?page=expenselist&month=<?= $expmonth['month'] ?>"><?= $expmonth['month']  ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
        
        <?php if(isset($_SESSION['expire'])){
                $diff = time() - $_SESSION['expire'];
                if($diff > 2){
                    unset($_SESSION['msg']);
                    unset($_SESSION['error']);
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
        <?php if(isset($_SESSION['error'])){ ?>   
            <div class="alert alert-danger alert-dismissible fade show pb-3" role="alert">
                <?php echo $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }?>
        <div class=" table-responsive">
            <table class="table table-hovered">
                 <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <!-- <th>Remark</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($expenses as $expense): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date("d M, Y", strtotime($expense['expdate']))  ?></td>
                        <td><?= $expense['description'] ?></td>
                        <td><?= $expense['qty'] ?></td>
                        <td><?= $expense['unitprice'] ?></td>
                        <td><?= $expense['total'] ?></td>
                        
                        <td>
                            <button class="btn btn-sm btn-success edit"
                            data-id="<?= $expense['id'] ?>" 
                            data-expdate="<?= $expense['expdate'] ?>" 
                            data-description="<?= $expense['description'] ?>" 
                            data-qty="<?= $expense['qty'] ?>" 
                            data-unitprice="<?= $expense['unitprice'] ?>" data-bs-target="#editModal" data-bs-toggle="modal">Edit</button>
                        
                            <button class="btn btn-sm btn-danger delete_id" data-id="<?= $expense['id'] ?>" data-bs-target="#deleteModal" data-bs-toggle="modal">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?php 
                    $id = $_SESSION['auth']['id'];
                    $exptotal = $query->getAll("expenses", "sum(total) as exptotal", null, "created_by=$id", null);
                    
                    ?>
                    <tr>
                        <th colspan="5" class="text-center">Expense Total</th>
                        <?php foreach($exptotal as $exp): ?>
                        <th><?= $exp['exptotal'] ?></th>
                        <?php endforeach ?>
                        <th>MMK</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="expenseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Expense Data Insert</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="./controllers/ExpenseController.php" method="post">
            <div class="mb-3">
                <label for="expdate" class="form-label">Date</label>
                <input class="form-control" type="date" name="expdate" id="expdate">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input class="form-control" type="text" name="description" id="description" placeholder="Enter Description">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input class="form-control" type="number" name="qty" id="qty" placeholder="Enter Qty">
            </div>
            <div class="mb-3">
                <label for="unitprice" class="form-label">Unit Price</label>
                <input class="form-control" type="number" name="unitprice" id="unitprice" placeholder="Enter Unit Price">
            </div>
        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="created_by" value="<?= $_SESSION['auth']['id'] ?>">
        <input type="hidden" name="action" value="add">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Expense Data Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="./controllers/ExpenseController.php" method="post">
            <div class="mb-3">
                <label for="expdate" class="form-label">Date</label>
                <input class="form-control" type="date" name="expdate" id="date" value="">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input class="form-control" type="text" name="description" id="des">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input class="form-control" type="number" name="qty" id="count">
            </div>
            <div class="mb-3">
                <label for="unitprice" class="form-label">Unit Price</label>
                <input class="form-control" type="number" name="unitprice" id="price" value="">
            </div>
        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="created_by" value="<?= $_SESSION['auth']['id'] ?>">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" id="id" value="">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-warning text-danger fa-2x mb-3"></i>
        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure "Delete"?</h1>
      </div>
      <div class="modal-footer m-auto">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Cancle</button>
        <form action="./controllers/ExpenseController.php" method="POST">
            <input type="hidden" name="id" id="delete_id" value="">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-success" type="submit"><i class="fas fa-check me-2"></i>Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>