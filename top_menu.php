
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title> <?php echo $setting_statement_results['site_title']; ?> </title>
    
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.css" rel="stylesheet">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/slick-theme.css" rel="stylesheet">
    <link href="assets/css/swiper.min.css" rel="stylesheet">
    <link href="assets/css/owl.transitions.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="admin/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="admin/js/font-awesome/all.min.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 



</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <!-- <div class="preloader">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div> -->        
        </div>
        <!-- end preloader -->

        <!-- Start header -->
        <!-- Start header -->
        <header id="header" class="site-header header-style-2">
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col col-sm-3">
                            <div class="social">
                                <ul>
                                    <!-- <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li> -->
                                    <li><a href="https://www.linkedin.com/in/aqib-ansari-054906211"><i class="ti-linkedin"></i></a></li>
                                    <!-- <li><a href="#"><i class="ti-pinterest"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col col-sm-9">
                            <div class="text">
                                <p>Do you want any home service, then call us: <span>+92324 0027 033</span></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div> <!-- end topbar -->

            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="index-2.html"><img src="assets/images/logo.png" alt></a> -->
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navbar-right navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                             <li><a href="index.php">Home</a></li>
                             <li><a href="Team.php">Team</a></li>
                             <li><a href="service-list-all.php">Services</a></li>
                             <li><a href="about.php">About</a></li>
                           
                            <li class="menu-item-has-children">
                                <a href="#">Company</a>
                                <ul class="sub-menu">
                                    <li><a href="faqs.php">Faq</a></li>
                                    <li><a href="services-s2.html">Terms & Condition</a></li>
                                    <li><a href="service-single.html">Privacy Policy</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                
                            </li>
                            <li class="menu-item-has-children">
                                
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->

                    <div class="search-contact">
                        <!-- <div class="header-search-area">
                            <div class="header-search-form">
                                <form class="form">
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search here">
                                    </div>
                                    <button type="submit" class="btn"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <div>
                                <button class="btn open-btn"><i class="ti-search"></i></button>
                            </div>
                        </div> -->
                        <div class="contact">
                            <div class="dropdown">
                                <?php if (isset($_SESSION['user'])) { ?>
                                <button class="theme-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                               </button>
                               <div class="dropdown-menu">
                                    <li class="nav-item dropdown">
                                        <a href="my_profile.php">My Profile</a>
                                        <a href="my_profile.php">My Bookings</a>
                                        <a href="logout.php">Logout</a>
                                    </li>
                                </div>
                            <?php } else { ?>
                              <button class="theme-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Signin / Join
                              </button>
                              <div class="dropdown-menu">
                                    <li class="nav-item dropdown">
                                        <a href="login.php">Login</a>
                                        <a href="signup.php">Signup</a>
                                    </li>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->

       
        <!-- end of header -->