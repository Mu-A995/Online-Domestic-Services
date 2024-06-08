<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item "><?php echo ucfirst($user_result['role']); ?> Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Users: 

                    <?php
                        // $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');

                        $statement = $pdo->prepare('SELECT * FROM tbl_users');
                        $statement->execute();
                        $count = $statement->rowCount();
                        // $result = $statement->fetchALl();

                        echo $count;
                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="users.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body">Active Services:

                    <?php

                    $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE srvc_status=?');

                    // $statement = $pdo->prepare('SELECT * FROM tbl_users');
                    $statement->execute(array('active'));
                    $count = $statement->rowCount();
                    // $result = $statement->fetchALl();

                    echo $count;

                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="services.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Bookings:

                    <?php

                    $statement = $pdo->prepare('SELECT * FROM tbl_payment');

                    // $statement = $pdo->prepare('SELECT * FROM tbl_users');
                    $statement->execute();
                    $count = $statement->rowCount();
                    // $result = $statement->fetchALl();

                    echo $count;

                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="bookings.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
               <div class="card-body">Categories:

                    <?php

                    $statement = $pdo->prepare('SELECT * FROM tbl_categories');

                    // $statement = $pdo->prepare('SELECT * FROM tbl_users');
                    $statement->execute();
                    $count = $statement->rowCount();
                    // $result = $statement->fetchALl();

                    echo $count;

                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="categories.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Provider: 

                    <?php
                        // $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE email=? && password=?');

                        $statement = $pdo->prepare("SELECT * FROM tbl_users WHERE role='provider' && status='active'");
                        $statement->execute();
                        $count = $statement->rowCount();
                        // $result = $statement->fetchALl();

                        echo $count;
                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="providers.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users mr-1"></i>Most Recent 5 Active Users</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Username</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE status = ? ORDER BY id DESC LIMIT 5');
                            $statement->execute(array('active'));
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
                                                        
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>