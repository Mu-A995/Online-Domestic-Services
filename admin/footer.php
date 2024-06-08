                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Password</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <form method="post" action="">
                          <div class="modal-body">
                            <!-- <p>Some text in the modal.</p> -->
                            
                                <?php
                                    if (!empty($alert_msg_pass)) {
                                        echo '<div class="alert alert-danger">'.$alert_msg_pass.'</div>'; 
                                    }
                                ?>

                                <div class="form-group">
                                    <label class="small mb-1" for="inputOldPassword">Old Password</label>
                                    <input class="form-control py-4" id="inputOldPassword" name="inputOldPassword" type="password" aria-describedby="emailHelp" placeholder="Enter Old Password" />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Enter password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                            <input class="form-control py-4" id="inputConfirmPassword" name="inputConfirmPassword" type="password" placeholder="Confirm password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="alert alert-dark">
                                        <small>After successfuly changed passwsord you will have need to login again.</small>
                                    </p>
                                </div>
                          </div>
                        
                          <div class="modal-footer">
                            <input class="btn btn-primary" type="submit" name="form_password_update" value="Update Password"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                    </form>
                    </div>

                  </div>
                </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> <?php echo $setting_statement_results['site_footer']; ?></div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        
    </body>
</html>
