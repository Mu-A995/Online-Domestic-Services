<?php include 'header.php';?>



<!-- start of hero -->
        <section class="hero-slider hero-style-2">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="assets/images/slider/slide-1.jpg">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-offer">
                                    <!-- <span>25% off for new client</span> -->
                                </div>
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>We Love the Job You Hate !</h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                     <p>Book a service provider today and experience the convenience, we make it easy for you to find the right service provider for your home with our user-friendly environment and secure payment system.</p>
                                </div>
                                <div class="clearfix"></div>
                                <div data-swiper-parallax="500" class="slide-btns">
                                    <a href="become_provider.php" class="theme-btn-s2">Become Provider</a> 
                            <a href="service-list-all.php" class="theme-btn-s3">Get A Service</a>
                                </div>
                            </div>
                        </div> <!-- end slide-inner --> 
                    </div> <!-- end swiper-slide -->

                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="assets/images/slider/slide-2.jpg">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-offer">
                                    <!-- <span>25% off for new client</span> -->
                                </div>
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>We love the job you hate</h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                   <p>Book a service provider today and experience the convenience, we make it easy for you to find the right service provider for your home with our user-friendly environment and secure payment system.</p>
                                </div>
                                <div class="clearfix"></div>
                                <div data-swiper-parallax="500" class="slide-btns">
                                    <a href="#" class="theme-btn-s2">More About Us</a> 
                                    <a href="#" class="theme-btn-s3">Get A Service</a> 
                                </div>
                            </div>
                        </div> <!-- end slide-inner --> 
                    </div> <!-- end swiper-slide -->
                </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <!-- end of hero slider -->
        

        <!-- start services-section -->
        <section class="services-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="section-title">
                            <span>What we do</span>
                            <h2>Browse Categories</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="service-grids services-slider">
                            <?php

                            $statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_status=?');
                            $statement->execute(array('active'));
                            $count = $statement->rowCount();
                            $result = $statement->fetchAll();

                            foreach ($result  as $key) { ?>
                               
                               <div class="grid text-center">
                                    <div class="icon text-primary">
                                        <i class="<?php echo $key['cat_icon'];?> fa-3x"></i>
                                    </div>
                                    <h3><a href="service-list.php?category=<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></a></h3>
                                    <p>

                                        <?php
                                            $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE svrc_category=?');
                                            $statement->execute(array($key['cat_id']));
                                            echo $statement->rowCount()."+ Services";
                                        ?>

                                    </p>
                                    <!-- <a href="#" class="more">Read More</a> -->
                                </div>
                            
                            <?php }

                            ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end services-section -->


        <!-- start about-section -->
        <section class="about-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-md-6">
                        <div class="section-title-s2">
                           
                           <span>Welcome to Domestic Service Provider!</span><br>
                    <h2>About Our History</h2>
                </div>
                <div class="details">
                    <p>We are a team of dedicated professionals who are committed to providing high-quality domestic services to our clients. Our company was founded on the principle of delivering exceptional customer service and provide an easy way to find trusted helpers. We understand the demands of modern life, which is why we strive to take care of your domestic needs so you can focus on the things that matter most to you. </p>
                    <ul>
                        <li><i class="ti-check-box"></i>House & Office Cleaning</li>
                        <li><i class="ti-check-box"></i>Electrician Services</li>
                        <li><i class="ti-check-box"></i>Furniture Assembly</li>
                        <li><i class="ti-check-box"></i>Cooking & Driver Services</li>
                    </ul><br><br>
                    <p style="color:#072F5F;"><b>Our platform is designed to provide service providers with a safe & reliable space to showcase their skills and expertise, and to find potential customers who require their services.</b></p>
                    
                </div>
            </div>
            <div class="col col-md-6">
                <div class="img-video-holder">
                    <img src="assets/images/about.png" alt>
                    <!-- <div class="video-holder">
                        <a href="https://www.youtube.com/embed/7e90gBu4pas?autoplay=1" class="video-btn" data-type="iframe" tabindex="0">
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end about-section -->


        <!-- start why-choose-us-section -->
<section class="why-choose-us-section">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="why-choose-grids">
                    <div class="grid">
                        <div class="icon">
                            <i class="fi flaticon-waiter"></i>
                        </div>
                        <h4>Expert Team</h4>
                        <p>Our team is committed to providing you with a seamless experience, from finding the right service provider to ensuring that your needs are met.</p>
                    </div>
                    <div class="grid">
                        <div class="icon">
                            <i class="fi flaticon-like-1"></i>
                        </div>
                        <h4>100% Satisfaction</h4>
                        <p>We prioritize our clients' satisfaction above all else, ensuring that every aspect of our domestic service meets their expectations.</p>
                    </div>
                    <div class="grid">
                        <div class="icon">
                            <i class="fi flaticon-growth"></i>
                        </div>
                        <h4>Eco-Friendly</h4>
                        <p>Our commitment to using environmentally friendly products and techniques ensures that our services are not only effective, but also safe.</p>
                    </div>
                    <div class="grid">
                        <div class="icon">
                            <i class="fi flaticon-coin"></i>
                        </div>
                        <h4>Competitive Prices</h4>
                        <p>Choose us as your domestic service provider and enjoy top-notch service at an affordable price.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end why-choose-us-section -->

        <!-- start work-process-section -->
        <section class="work-process-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="section-title">
                            <span>Work Process</span>
                            <h2>How It Works</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="work-process-grids clearfix">
                            <div class="grid">
                                <div class="count">
                                    <span>1</span>
                                </div>
                                <h4>Easy Online Booking</h4>
                                <p>Hassle-free booking for all your domestic needs, right from your computer or phone.</p>
                            </div>
                            <div class="grid">
                                <div class="count">
                                    <span>2</span>
                                </div>
                                <h4>Get a Service Provider</h4>
                                <p>Find reliable and skilled service providers for all your household needs - book now!</p>
                            </div>
                            <div class="grid">
                                <div class="count">
                                    <span>3</span>
                                </div>
                                <h4>Enjoy Service</h4>
                                <p>Sit back, relax, and enjoy our top-notch services for all your domestic needs.</p>
                            </div>
                            <div class="separator"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
        <!-- end work-process-section -->


        <!-- start recent-project-section -->
        <section class="recent-project-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="section-title">
                            <span>We are offering</span>
                            <h2>Most Recent Services</h2>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->

            <div class="content-area">
                <div class="case-grids projects-slider">
                    <?php
                    $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE srvc_status=?');
                    $statement->execute(array('active'));
                    // $count = $statement->rowCount();
                    $result = $statement->fetchAll();
                    
                    foreach ($result  as $key) { ?>
                    <div class="grid">
                        <div class="inner">
                            <div class="img-holder">
                                <img src="admin/assets/services/<?php echo $key['srvc_photo'];?>" alt>
                            </div>
                            <div class="details">
                                <div class="info">
                                    <h3><a href="service-single.php?single_service=<?php echo $key['srvs_id'];?>"><?php echo $key['srvc_title'];?></a></h3>
                                    <p class="cat"><?php
                                        // Get Category Name
                                        $cat_statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_id=?');
                                        $cat_statement->execute(array($key['svrc_category']));
                                        // $count = $statement->rowCount();
                                        $cat_statement_result = $cat_statement->fetch();
                                         echo $cat_statement_result['cat_name'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    ?>
                </div>
            </div>
        </section>
        <!-- end recent-project-section -->


        <!-- start testimonials-section -->
        <!-- <section class="testimonials-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-md-4">
                        <div class="section-title-s2">
                            <span>Testimonials</span>
                            <h2>What Client Says About us</h2>
                        </div>
                    </div>
                    <div class="col col-md-8">
                        <div class="testimonial-grids testimonials-slider">
                            <div class="grid">
                                <div class="quote">
                                    <p>A collection of textile samples lay spread out on the table Samsa was a salesman and above it there hung a picture that he had recently cut out of an illustrated magazine and in a nice, gilded frame t there hung a picture that he llustrated </p>
                                </div>
                                <div class="details">
                                    <div class="img-holder">
                                        <img src="assets/images/testimonials/img-1.jpg" alt>
                                    </div>
                                    <h5>Jhon dow Play</h5>
                                    <span>Happy Client</span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="quote">
                                    <p>A collection of textile samples lay spread out on the table Samsa was a salesman and above it there hung a picture that he had recently cut out of an illustrated magazine and in a nice, gilded frame t there hung a picture that he llustrated </p>
                                </div>
                                <div class="details">
                                    <div class="img-holder">
                                        <img src="assets/images/testimonials/img-1.jpg" alt>
                                    </div>
                                    <h5>Jhon dow Play</h5>
                                    <span>Happy Client</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section> -->
        <!-- end testimonials-section -->


        <!-- start cta-section -->
        <section class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-offset-3 col-lg-6">
                        <div class="cta-text">
                            <h2>Subscribe Us !</h2>
                            
                            <form method="post" action="">
                                <div class="form-group">
                                    
                                    <input class="form-control input-lg py-4" id="inputEmailAddress" type="email" name="inputEmailAddress" placeholder="Enter email address" />
                                </div>
                                        
                                <!-- <a href="#" class="theme-btn-s2">Subscribe Now</a> -->
                                <input class="theme-btn-s2" type="submit" value="Subscribe" name="form_subscriber">
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end cta-section -->


        <!-- start blog-section -->
        <!-- <section class="blog-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="section-title">
                            <span>Recent News</span>
                            <h2>Our Company News</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="blog-grids clearfix">
                            <div class="grid">
                                <div class="entry-meta">
                                    <div class="author">
                                        <img src="assets/images/blog/img-1.jpg" alt>
                                    </div>
                                    <h4>Jhone Miche</h4>
                                    <p class="date">12 Sep 2019</p>
                                </div>
                                <div class="entry-details">
                                    <h3><a href="#">Our expert service provider make your home pest</a></h3>
                                    <p>Raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to</p>
                                </div>
                                <div class="overlay">
                                    <div class="middle">
                                        <a href="#" class="theme-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="entry-meta">
                                    <div class="author">
                                        <img src="assets/images/blog/img-2.jpg" alt>
                                    </div>
                                    <h4>Drain ship</h4>
                                    <p class="date">12 Sep 2019</p>
                                </div>
                                <div class="entry-details">
                                    <h3><a href="#">There are tens of cleaning companies listed</a></h3>
                                    <p>Raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to</p>
                                </div>
                                <div class="overlay">
                                    <div class="middle">
                                        <a href="#" class="theme-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="entry-meta">
                                    <div class="author">
                                        <img src="assets/images/blog/img-3.jpg" alt>
                                    </div>
                                    <h4>Michel niew</h4>
                                    <p class="date">12 Sep 2019</p>
                                </div>
                                <div class="entry-details">
                                    <h3><a href="#">Reputation of the company is an aspect one should </a></h3>
                                    <p>Raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to</p>
                                </div>
                                <div class="overlay">
                                    <div class="middle">
                                        <a href="#" class="theme-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section> -->
        <!-- end blog-section -->

<?php include 'footer.php'; ?>