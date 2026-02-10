<?php
error_reporting(1);
include('./include/header.php');

// Include required classes
include_once './app/class/XssClean.php';
include_once './app/class/databaseConn.php';
include_once './app/lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$xssClean = new xssClean();
$id = $xssClean->clean_input($_REQUEST['id']);

// Fetch temple details for the provided id
$select = "SELECT * FROM `mystery` WHERE index_id='$id'";
$SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);

// Check if the query returns a result
if (mysqli_num_rows($SQL_STATEMENT) > 0) {
    $Row = mysqli_fetch_object($SQL_STATEMENT);
} else {
    echo "<p>Temple not found.</p>";
    exit;
}
?>
<style>
    /* Highlight animation */
    .card.highlight {
        background-color: #f0f8ff;
    }

    .tab-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .tab-container button {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        background-color: #ddd;
        border-radius: 5px;
    }

    .tab-container button:hover {
        background-color: #ccc;
    }

    .align {
        margin-left: 5%;
    }

    .next-gods-container {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .next-gods-container .card {
        max-width: 345px;
        margin-bottom: 5%;
    }
</style>
<div class="container text-center">
    <h1 class="fs-1 font-caveat page-header-title fw-semibold m-2 pb-3  text-primary"><?php echo $Row->title; ?></h1>

    <div class="rounded-4 overflow-hidden position-relative">
        <div class="row">
            <div class="col-md-12">
                <a class="d-block position-relative" href="#">
                    <img class="w-100" src="app/uploads/mystery/banner/<?php echo $Row->banner; ?>" style="" class="img-fluid" alt="Temple Image" height="500px">
                </a>
            </div>
        </div>
        <!-- Print Icon -->
    </div>

</div>

<div>
    <?php
    // Fetch the next three records after the current ID
    $nextThreeQuery = "
                SELECT * FROM `mystery` 
                WHERE index_id > '$id' 
                ORDER BY index_id ASC 
                LIMIT 3";
    $nextThreeResult = mysqli_query($DatabaseCo->dbLink, $nextThreeQuery);

    // Check if there are any records to display
    if (mysqli_num_rows($nextThreeResult) > 0) {
        echo '<div class="next-gods-container mt-5">';
        while ($nextRow = mysqli_fetch_assoc($nextThreeResult)) {
            // Display each card
            echo '
            <div class="card rounded-3 w-100 flex-fill overflow-hidden border-0 dark-overlay card-hover">
            <!-- start card link -->
            <a href="mystery-details.php?id=' . $nextRow['index_id'] . '" class="stretched-link z-2"></a>
            <!-- end /. card link -->
            <!-- start card image wrap -->
            <div class="card-img-wrap card-image-hover overflow-hidden">
                <img src="app/uploads/mystery/' . htmlspecialchars($nextRow['photos']) . '" alt="" class="img-fluid">
            </div>
            <!-- end /. card image wrap -->
            <div class="bottom-0 d-flex flex-column p-4 position-absolute position-relative text-white w-100 z-1">
                <!-- start card title -->
                <h4 class="fs-18  mb-0">
                    ' . htmlspecialchars($nextRow['title']) . '
                </h4>
                <!-- end /. card title -->
            </div>
        </div>';
        }
        echo '</div>';
    } else {
        echo "<p>No additional gods to display.</p>";
    }
    ?>
</div>
<!-- Main content area to print, copy, or share -->
<div id="printable-content">
    <div style="position: relative;">
        <div class="title">
            <!-- <h2 class="text-center mt-5"><?php echo htmlspecialchars($Row->title); ?></h2> -->
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content Section -->
                <div class="col-lg-8">
                    <!-- Content Cards -->
                    <div id="Sthalam" class="card shadow mb-5 bg-body rounded p-4 mb-4">
                        <p><?php echo $Row->small_description; ?></p>
                    </div>
                    <div id="Puranam" class="card shadow mb-5 bg-body rounded p-4 mb-4">
                        <p><?php echo $Row->description; ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Social Media Icons -->
                    <div class="social-media hidePrint" style="margin-top: -46px; margin-bottom:10px;">
                        <!-- Print Icon -->
                        <a class="btn btn-primary d-inline-block" href="#" onclick="window.print();">
                            <i class="fas fa-print"></i>
                        </a>
                        <!-- WhatsApp Icon -->
                        <a class="btn btn-primary d-inline-block" href="#" onclick="shareToWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <!-- PDF Download Icon -->
                        <a class="btn btn-primary d-inline-block" href="#" onclick="downloadPDF()">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        <!-- Copy Link Icon -->
                        <a class="btn btn-primary d-inline-block" href="#" onclick="copyContent()">
                            <i class="fas fa-copy"></i>
                        </a>
                    </div>
                    <div class="border p-4 rounded-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="mb-0">Opening <span class="text-primary">Hours</span></h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                            </svg>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Monday - Sunday</span>
                            <span><?php echo htmlspecialchars($Row->open_time); ?> - <?php echo htmlspecialchars($Row->close_time); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    // Print only the specific content without social icons and other sections
    function printContent() {
        const printContents = document.getElementById("printable-content").innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    // Copy content to WhatsApp
    function shareToWhatsApp() {
        const content = document.getElementById("printable-content").innerText;
        const url = `https://wa.me/?text=${encodeURIComponent(content)}`;
        window.open(url, '_blank');
    }

    // Download content as PDF
    function downloadPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();
        const content = document.getElementById("printable-content").innerText;

        pdf.text(content, 10, 10);
        pdf.save("temple-details.pdf");
    }

    // Copy content to clipboard
    function copyContent() {
        const content = document.getElementById("printable-content").innerText;
        navigator.clipboard.writeText(content).then(() => {
            alert("Content copied to clipboard!");
        }).catch(err => {
            console.error("Failed to copy: ", err);
        });
    }
</script>
<?php include('./include/footer.php'); ?>