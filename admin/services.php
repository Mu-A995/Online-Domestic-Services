<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item ">Services</li>
    </ol>
    
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-tasks mr-1"></i>Manage Services
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created at</th>
                            
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare('SELECT * FROM tbl_services ORDER BY srvs_id DESC');
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $i = 0;
                            foreach ($result as $key) { 
                            $i++;
                        ?>
                                                        <tr>
                            <td><?php echo $i;?></td>
                            <td><img width="60" src="assets/services/<?php echo $key['srvc_photo'];?>"></td>
                            
                            <td><?php echo $key['srvc_title'];?></td>
                            <td><?php 

                            $statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_id=?');
                            $statement->execute(array($key['svrc_category']));
                            // $count = $statement->rowCount();
                            $result = $statement->fetch();

                            echo $result['cat_name'];?></td>

                            <td><?php echo $key['srvc_price'].' '.$setting_statement_results['web_currency'];?></td>
                            <td><?php echo $key['srvc_status'];?></td>
                            <td><?php echo $key['created_at'];?></td>
                            
                            <td>
                                <!-- Default dropleft button -->
                                <div class="btn-group dropup">
                                  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="service-edit.php?srvs_id=<?php echo $key['srvs_id'];?>">Edit</a>
                                    <a class="dropdown-item" href="service-delete.php?srvs_id=<?php echo $key['srvs_id'];?>">Delete</a>
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