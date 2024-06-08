<?php include 'header.php' ?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">Dashboard</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item ">Bookings</li>
    </ol>
    
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-shopping-cart mr-1"></i>Manage Bookings
        </div>
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
                            $statement = $pdo->prepare('SELECT * FROM tbl_payment WHERE provider_id=? ORDER BY id DESC');
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
                                    <a class="dropdown-item" href="client_view.php?u_id=<?php echo $key['user_id'];?>">View</a>
                                    
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