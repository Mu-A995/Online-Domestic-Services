<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item ">Categories</li>
    </ol>
    
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list mr-1"></i>Manage Categories
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Username</th> -->
                            <th>Category</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Created at</th>
                            
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare('SELECT * FROM tbl_categories ORDER BY cat_id DESC');
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $i = 0;
                            foreach ($result as $key) { 
                            $i++;
                        ?>
                                                        <tr>
                            <td><?php echo $i;?></td>
                            
                            <td><?php echo $key['cat_name'];?></td>
                            <td><i class="<?php echo $key['cat_icon'];?> fa-2x"></i></td>
                            <td><?php echo $key['cat_status'];?></td>
                            <td><?php echo $key['created_at'];?></td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            
            </div>
        </div>
    </div>

    
</div>

<?php include 'footer.php' ?>