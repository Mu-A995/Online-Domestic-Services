<?php include 'header.php'; ?>


<?php

if (isset($_REQUEST['u_id'])) {
    $u_r_id = $_REQUEST['u_id'];

    $u_r_statement = $pdo->prepare('SELECT * FROM tbl_users WHERE id =?');
    $u_r_statement->execute(array($u_r_id));
    $u_r_statement_result = $u_r_statement->fetch();
}

?>

<div class="container-fluid">
    <!-- <h1 class="mt-4">My Profile</h1> -->
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item">View User</li>
    </ol>

    <div class="row ">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">User Account Info</h5>
                </div>
                <div class="card-body">

                   
                        <div class="form-group">
                            <label class="small mb-1" for="inputFullname">Full Name</label>
                            <input class="form-control py-4" id="inputFullname" name="u_fullname" value="<?php echo $u_r_statement_result['fullname']; ?>" type="text" placeholder="Enter Full Name" />
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control py-4" id="inputEmailAddress" value="<?php echo $u_r_statement_result['email']; ?>" name="u_email" type="email" placeholder="Enter email address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputMobileNo">Mobile No.</label>
                                    <input class="form-control py-4" value="<?php echo $u_r_statement_result['mobile_no']; ?>" name="u_mobile_no" id="inputMobileNo" type="text" placeholder="Mobile No." />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="small mb-1" for="inputGender">Gender</label>
                          <select class="form-control" name="u_gender" id="inputGender">
                           

                            <option value="male" ><?php echo ucfirst($u_r_statement_result['gender']);?></option>
                            
                          </select>
                        </div>

                        
                    
                </div>
                
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h5 class="font-weight-light">User's Profile Photo</h5>
                </div>
                <div class="card-body">
                    
                        <div class="form-group">
                            <!-- <label >Existing Photo</label> -->
                            <div style="padding-top:6px;">
                                <img src="assets/uploads/<?php echo $u_r_statement_result['photo']; ?>" class="existing-photo" width="140">
                            </div>
                        </div>
                          
                </div>
                
            </div>
        </div>

        <div class="col-lg-12">

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-users mr-1"></i>User's Bookings</div>
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

    </div>
</div>
<?php include 'footer.php' ?>