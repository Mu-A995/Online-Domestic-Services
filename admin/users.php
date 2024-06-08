<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item ">Users</li>
    </ol>
    
    
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users mr-1"></i>Manage Users</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Username</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>User Type</th>
                            <th>Account Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare('SELECT * FROM tbl_users ORDER BY id DESC');
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $i = 0;
                            foreach ($result as $key) { 
                            $i++;
                        ?>
                                                        <tr>
                            <td><?php echo $i;?></td>
                            <!-- <td><?php echo $key['username'];?></td> -->
                            <td><?php echo $key['fullname'];?></td>
                            <td><?php echo $key['email'];?></td>
                            <td><?php echo $key['mobile_no'];?></td>
                            <td><?php echo $key['role'];?></td>
                            <td><?php echo $key['status'];?></td>

                            <td>
                                <!-- Default dropleft button -->
                                <div class="btn-group dropup">
                                  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="user_view.php?u_id=<?php echo $key['id'];?>">View</a>
                                    <a class="dropdown-item" href="user_edit.php?u_id=<?php echo $key['id'];?>">Edit</a>
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