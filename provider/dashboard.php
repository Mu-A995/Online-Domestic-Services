<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item "><?php echo ucfirst($user_result['role']); ?> Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Customers: 
                            <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE user_id=?");
                                 $statement->execute(array($user_result['id']));
                                 echo $count = $statement->rowCount();
                                 ?>

                                  <!-- <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE user_id=? && payment_status='paid'");
                                 $statement->execute(array($user_result['id']));
                                 echo $count = $statement->rowCount();
                                 ?> -->


                    

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="my_clients.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body">Active Services:
                               

                    <?php
                                $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE user_id=?');
                                 $statement->execute(array($user_result['id']));
                                 echo $count = $statement->rowCount();
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
                                $statement = $pdo->prepare('SELECT * FROM tbl_payment WHERE user_id=?');
                                 $statement->execute(array($user_result['id']));
                                 echo $count = $statement->rowCount();
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
    </div>
    
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users mr-1"></i>Most Recent 5 Pending Bookings</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>item_number</th> -->
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Service Id</th>
                            <th>Customer ID</th>
                             <th>Customer Address</th>
                              <th>Time</th>
                               <th>Date</th>
                                <th>Payment Method</th>
                            <th>Status</th>
                            <th>User Email</th>
                            <th>Created at</th>
                            <th>By</th>
                            
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE user_id=? && payment_status='pending' ORDER BY id DESC");
                            $statement->execute(array($user_result['id']));
                            $result = $statement->fetchAll();
                            $i = 0;
                            foreach ($result as $key) { 
                            $i++;
                        ?>
 
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $key['item_name'];?></td>
                            <!-- <td><?php echo $key['payment_amount'];?></td> -->
                            <td>
                                <?php 

                                $basicpricedollar = $key['payment_amount'];
                                $dollar_rate = $setting_statement_results['dollar_exchange_rate']; // Your price in USD

                               
                                $pkr_price = round(($basicpricedollar * $dollar_rate), 2);
                                echo $pkr_price;
                                 ?> PKR 

                                    <br>(<?php echo $key['payment_amount'];?> USD)
                            </td>
                            <td><?php echo $key['item_number'];?></td>
                          
                            <td>

                                <?php
                                $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id = ?');
                                $statement->execute(array($key['user_id']));
                                $result = $statement->fetch();
                                echo $result['id'];
                               
                               ?>
                            </td>
                            <td><?php echo $key['address'];?></td>
                              <td><?php echo $key['inputTime'];?></td>
                                <td><?php echo $key['inputDate'];?></td>
                                  <td><?php echo $key['inputPaymentMethod'];?></td>
                            <td><?php echo $key['payment_status'];?></td>
                            <td>

                                <?php
                                $statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id = ?');
                                $statement->execute(array($key['user_id']));
                                $result = $statement->fetch();
                                echo $result['email'];
                                ?>
                            </td>

                            <td><?php echo $key['created_at'];?></td>
                            <td>
                                
                                <div class="btn-group dropup">
                                  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="user_view.php?u_id=<?php echo $key['user_id'];?>">View</a>
                                    
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