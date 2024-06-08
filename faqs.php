<?php include 'header.php';?>


<!-- start page-title -->
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <h2>FAQ</h2>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>        
<!-- end page-title -->


<!-- start faq-pg-section -->
<section class="faq-pg-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="section-title">
                    <span>FAQ</span>
                    <h2>Frequently asked question</h2>
                </div>
            </div>
        </div> 
                       
        <div class="row">
            <div class="col col-xs-12">
                <div class="panel-group faq-accordion theme-accordion-s1" id="accordion">
                    <?php
                        $statement = $pdo->prepare('SELECT * FROM tbl_faqs WHERE faq_status=? ORDER BY faq_id DESC');
                        $statement->execute(array('active'));
                        $faq_result = $statement->fetchAll();
                        $i = 0;
                        foreach ($faq_result as $key) { 
                        $i++;
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i;?>" aria-expanded="true">
                                <?php echo $key['faq_question'];?></a>
                        </div>
                        <div id="collapse-<?php echo $i;?>" class="panel-collapse collapse <?php if ($i==1) {echo "in";} ?>">
                            <div class="panel-body">
                                <p><?php echo $key['faq_answer'];?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-2">How to write the changelog for theme updates?</a>
                        </div>
                        <div id="collapse-2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-3">What happens when my license expires?</a>
                        </div>
                        <div id="collapse-3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-4">Do you recommend using a download manager software?</a>
                        </div>
                        <div id="collapse-4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>    
    </div> <!-- end container -->
</section> 
<!-- end faq-pg-section -->       


<?php include 'footer.php'; ?>