<?php
include_once './includes/header.php';
include_once './class/databaseConn.php';
include_once 'lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
// TEMPLE IN INDIA
$Qcount1 = $DatabaseCo->dbLink->query("SELECT index_id FROM temples");
$count1 = mysqli_num_rows($Qcount1);
// TEMPLE IN ABROAD total
$Qcount2 = $DatabaseCo->dbLink->query("SELECT index_id FROM  abroad");
$count2 = mysqli_num_rows($Qcount2);
// ICONIC TEMPLES total
$Qcount3 = $DatabaseCo->dbLink->query("SELECT index_id FROM iconic");
$count3 = mysqli_num_rows($Qcount3);
// MANTRAS & STOTRAS  total
$Qcount4 = $DatabaseCo->dbLink->query("SELECT index_id FROM mantras_stotras");
$count4 = mysqli_num_rows($Qcount4);
// MYSTERY TEMPLES total
$Qcount5 = $DatabaseCo->dbLink->query("SELECT index_id FROM  mystery");
$count5 = mysqli_num_rows($Qcount5);
// others page  total
$Qcount6 = $DatabaseCo->dbLink->query("SELECT index_id FROM  other_page WHERE page_id = 5");
$count6 = mysqli_num_rows($Qcount6);
// NARASIMHA KSHETRAS
$Qcount7 = $DatabaseCo->dbLink->query("SELECT index_id FROM iconic WHERE god_id= 7");
$count7 = mysqli_num_rows($Qcount7);
?>
   <?php if ($user_role === 'Staff'): ?>
<style>
    .header-banner{
margin-top: -500px !important;
    }
</style>
<?php endif; ?>
<div class="body-content">
    <div class="decoration blur-2"></div>
    <div class="decoration blur-3"></div>
    <div class="container-xxl">
        <!-- Start header banner -->
        <div class="header-banner align-items-center d-flex justify-content-between mb-3 p-4 rounded-4 w-100">
            <div class="header-banner-context">
            <?php if ($user_role === 'Admin'): ?>
                <h3 class="align-items-center d-flex fs-5 gap-2 text-white mb-3">
                    <img src="assets/dist/img/logo.png" alt="" width="35">
                    Dashboard
                </h3>
                <div class="content-text fs-14 opacity-75 text-white">
                    Bhaktikalpa is an informative sacred Kalpavriksha with all temples and slokas in Hinduism that represents devotion and spirituality.
                </div>
                <?php endif; ?>
                <?php if ($user_role === 'Staff'): ?>
                <h2 class="align-items-center d-flex fs-5 gap-2 text-white mb-3">
                <img src="./uploads/staff/<?php echo ucfirst($user_photos); ?>" alt="" width="45px" height="45px"  class="img-fluid rounded-circle">Welcome, <?php echo ucfirst($user_name); ?>!</h2>
        <p class="content-text fs-14 opacity-75 text-white">
            Bhaktikalpa serves as a sacred Kalpavriksha, providing comprehensive information about Hindu temples and slokas, fostering devotion and spirituality.
        </p>
        <?php endif; ?>
            </div>
            <img class="img-responsive" src="assets/dist/img/glass.png" alt="" width="490">
        </div>

        <!-- End /. header banner -->
        <div class="row g-3 mb-3">
        <?php if ($user_role === 'Admin'): ?>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">TEMPLES IN INDIA</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count1; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/temple-india.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($user_role === 'Admin'): ?>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">TEMPLES IN ABROAD</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count2; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Temples.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($user_role === 'Admin'): ?>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">ICONIC TEMPLES</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count3; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Iconic.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
            <?php if ($user_role === 'Admin'): ?>
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">MANTRAS & STOTRAS</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count4; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Mantras.png" alt="">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">TEMPLES</div>
                            <h3 class="fw-semi-bold mb-0">45</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Temples.png" alt="">
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
            <?php if ($user_role === 'Admin'): ?>
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">MYSTERY TEMPLES</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count5; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Mystery.png" alt="">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
            <?php if ($user_role === 'Admin'): ?>
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted">NARASIMHA KSHETRAS</div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count7; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/Narasimha.png" alt="">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php
                                $select = "SELECT * FROM `category` WHERE index_id != '0' ORDER BY index_id DESC";
                                $SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);
                                $num_rows = mysqli_num_rows($SQL_STATEMENT);
                                if ($num_rows != 0) {
                                    while ($Row = mysqli_fetch_object($SQL_STATEMENT)) {
                                        $Qcount6 = $DatabaseCo->dbLink->query("SELECT index_id FROM  other_page WHERE page_id = '$Row->index_id'");
                                        $count6 = mysqli_num_rows($Qcount6);
                                ?>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex">
            <?php if ($user_role === 'Admin'): ?>
                <div class="card flex-column flex-fill p-4 position-relative shadow w-100 widget-card">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-14 text-muted text-uppercase"><?php echo $Row->name;?></div>
                            <h3 class="fw-semi-bold mb-0"><?php echo $count6; ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="assets/dist/img/others.png" alt="">
                        </div>
                    </div>
                </div>
                     <?php endif; ?>
            </div><?php } }?>
        </div>
        <!-- <div class="card mb-3 p-4 total-box">
            <div class="g-4 gx-xxl-5 row">
                <div class="col-sm-4 total-box-left">
                    <div class="align-items-center d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Total </h6>
                        <div class="align-items-center d-flex justify-content-center rounded arrow-btn percentage-increase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-up-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="price"><span class="counter">58</span><span class="fs-13 ms-1 text-muted"></span></h1>
                    <p class="mb-0 fw-semibold fs-14">
                        <span class="percentage-increase">20</span>&nbsp;&nbsp; this week
                    </p>
                </div>
                <div class="col-sm-4 total-box-left">
                    <div class="align-items-center d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Visitors</h6>
                        <div class="align-items-center d-flex justify-content-center rounded arrow-btn percentage-increase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-up-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="price counter">78</h1>
                    <p class="mb-0 fw-semibold fs-14">
                        <span class="percentage-increase">20</span>&nbsp;&nbsp;this week
                    </p>
                </div>
                <div class="col-sm-4 total-box__right">
                    <div class="align-items-center d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Total </h6>
                        <div class="align-items-center d-flex justify-content-center rounded text-primary arrow-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-down-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 13.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h4.793L2.146 2.854a.5.5 0 1 1 .708-.708L13 12.293V7.5a.5.5 0 0 1 1 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="price counter">76</h1>
                    <p class="mb-0 fw-semibold fs-14">
                        <span class="text-primary">9</span>&nbsp;&nbsp; decrease compared to last week
                    </p>
                </div>
            </div>
        </div> -->

    </div>
</div>
<!--/.body content-->


<?php
include_once './includes/footer.php';

?>