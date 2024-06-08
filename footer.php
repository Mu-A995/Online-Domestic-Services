        <!-- start site-footer -->
        <footer class="site-footer">
            <div class="upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <!-- <img src="admin/assets/logo/logo.png" alt> -->
                                </div>
                                <p><?php echo $setting_statement_results['site_title']; ?> is the name of trust. We deal with honest and hardworking.</p>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Usefull Links</h3>
                                </div>
                                <ul>
                                    <li><a href="about.php">About us</a></li>
                                    <li><a href="contact.php">Contact us</a></li>
                                    <li><a href="service-list-all.php">Our Services</a></li>
                                    <li><a href="provider/login.php">Login as Provider</a></li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget contact-widget service-link-widget">
                                <div class="widget-title">
                                    <h3>Address Location</h3>
                                </div>
                                <ul>
                                    <li><?php echo $setting_statement_results['web_address_location']; ?></li>
                                    <li><span>Phone:</span> <?php echo $setting_statement_results['web_phone']; ?></li>
                                    <li><span>Email:</span> <?php echo $setting_statement_results['web_email']; ?></li>
                                    <!-- <li><span>Office Time:</span> 10AM- 5PM</li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget newsletter-widget">
                                <div class="widget-title">
                                    <h3>Newsletter</h3>
                                </div>
                                <p>You will be notified when somthing new will be appear.</p>
                                <form method="post" action="">
                                    <div class="input-1">
                                        <input type="email" name="inputEmailAddress" class="form-control" placeholder="Email Address *" required>
                                    </div>
                                    <div class="submit clearfix">
                                        <button type="submit"  name="form_subscriber"><i class="ti-email"></i></button>
                                        <!-- <input class="theme-btn-s2" type="submit" value="Subscribe" name="form_subscriber"> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div>
            <div class="lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="separator"></div>
                        <div class="col col-xs-12">
                            <p class="copyright"><?php echo $setting_statement_results['site_footer']; ?></p>
                            <div class="extra-link">
                                <ul>
                                    <li><a href="#">Privace & Policy</a></li>
                                    <li><a href="#">Terms</a></li>
                                    <li><a href="about.php">About us</a></li>
                                    <li><a href="faqs.php">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end site-footer -->

    </div>
    <!-- end of page-wrapper -->



    <!-- All JavaScript files
    ================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins for this template -->
    <script src="assets/js/jquery-plugin-collection.js"></script>

    <!-- Custom script for this template -->
    <script src="assets/js/script.js"></script>
    <script src="admin/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="admin/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="admin/assets/demo/datatables-demo.js"></script>

    <!-- Custom Script -->
    

</body>

</html>
