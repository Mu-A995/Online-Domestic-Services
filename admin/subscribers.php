<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item ">Subscribers</li>
    </ol>
    
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-envelope mr-1"></i>Manage Subscribers
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare('SELECT * FROM tbl_subscribers ORDER BY id DESC');
                            $statement->execute(array());
                            $result = $statement->fetchAll();
                            $i = 0;
                            foreach ($result as $key) { 
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $key['email'];?></td>
                            <td><?php echo $key['created_at'];?></td>
                            
                            <td>
                                <!-- Default dropleft button -->
                                <div class="btn-group dropup">
                                  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                  </button>
                                  <div class="dropdown-menu">
                                    
                                    <a class="dropdown-item" href="subscriber-delete.php?sub_id=<?php echo $key['id'];?>">Delete</a>
                                  </div>
                                </div>
                            </td>

                            
                            
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            
            </div>
        </div>
    </div>

    
</div>

<?php include 'footer.php' ?>