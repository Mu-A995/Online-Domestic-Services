<?php include 'header.php';?>

        <!-- start page-title -->
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <h2>All Services</h2>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>        
        <!-- end page-title -->


        <!-- start recent-project-section -->
        <section class="recent-project-section section-padding">
           

            <div class="container">
                <div class="case-grids projects-slider-s2">
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
                                        <p class="cat">

                                        <?php
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


<?php include 'footer.php'; ?>