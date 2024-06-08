<?php include 'header.php';?>

<?php

if(!isset($_REQUEST['category'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not

    $statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE cat_id=?");
    $statement->execute(array($_REQUEST['category']));
    $total = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
        header('location: index.php');
        exit;
    }
}

if (isset($_REQUEST['category'])) {
    $category_id = $_REQUEST['category'];

    // Get Category Name
    $cat_statement = $pdo->prepare('SELECT * FROM tbl_categories WHERE cat_id=?');
    $cat_statement->execute(array($category_id));
    // $count = $statement->rowCount();
    $cat_statement_result = $cat_statement->fetch();

    
}

?>


        <!-- start page-title -->
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <h2>Category: <u><?php echo $cat_statement_result['cat_name'];?></u></h2>
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
                        $statement = $pdo->prepare('SELECT * FROM tbl_services WHERE svrc_category=? AND srvc_status=?');
                        $statement->execute(array($category_id,'active'));
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
                                        <p class="cat"><?php echo $cat_statement_result['cat_name'];?></p>
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