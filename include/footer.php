<?php
$select = "SELECT * FROM `private_ads` WHERE is_active = 1 ORDER BY sort_order ASC";
$SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<section class="ad-section">
    <div class="container">
        <!-- Slider Container -->
        <div class="owl-carousel ad-slider">
           <?php if (mysqli_num_rows($SQL_STATEMENT) > 0) {
                    while ($Row = mysqli_fetch_assoc($SQL_STATEMENT)) {
                        $id       = $Row['id'];
                        $title    = $Row['title'];
                        $image    = !empty($Row['image_path']) ? $Row['image_path'] : "";
                        $url      = !empty($Row['external_url']) ? $Row['external_url'] : "#";
                        if($image){
                        ?>
                        
                        <div class="item" >
                            <a href="<?php echo htmlspecialchars($url); ?>" data-id="<?php echo $id; ?>" target="_blank" class="ad-click">
                                <img src="app/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>">
                            </a>
                        </div>

                        <?php
                        }
                    }
                } ?>
        </div>
    </div>
</section>

<style>
    .ad-section{
        padding:40px 0;
    }
     /* Center dots */
    .ad-slider .owl-dots {
      text-align: center;
      margin-top: 10px;
    }

    .ad-slider .owl-dot {
      display: inline-block;
      margin: 0 5px;
    }

    .ad-slider .owl-dot span {
      width: 12px;
      height: 12px;
      background: #bbb;
      display: block;
      border-radius: 50%;
      transition: background 0.3s ease;
    }

    .ad-slider .owl-dot.active span {
      background: #333;
    }
    .ad-slider .item{
    padding: 10px;
    background: #ccc;
    display: block;
    width: 100%;
    border-radius: 8px;
}
</style>
<div class="correction-box">
    <div class="container">

    
    <p class="btn-show-correction-form">Please send your corrections</p>

    <form id="correctionForm" style="display:none;">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <input type="hidden" name="page_url" id="page_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

    <div class="row">
        <div class="col-md-4">
            <label>Your Name</label>
            <input type="text" name="user_name" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label>Email</label>
            <input type="email" name="user_email" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label>Phone</label>
            <input type="text" name="user_phone" class="form-control" required>
        </div>
    </div>

    <br>

    <label>Correction Details</label>
    <textarea name="correction_details" class="form-control" rows="4" required></textarea>

    <br>

    <button type="submit" class="btn btn-primary">Submit Correction</button>
</form>

<div id="correctionResponse" class="mt-3 fw-bold"></div>


    <div id="correctionResponse" style="margin-top:15px; font-weight:bold;"></div>
    </div>
</div>

<style>
.correction-box{
    padding:20px;
    border:1px solid #ccc;

    margin-top:20px;
    background:#f9f9f9;
    border-radius:8px;
}
.correction-box input, 
.correction-box textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:5px;
}
.correction-box button{
    background:#0066ff;
    color:#fff;
    border:none;
    padding:12px 20px;
    border-radius:6px;
    cursor:pointer;
}
</style>




<footer class="footer-dark main-footer overflow-hidden position-relative pt-5">

    <div class="container pt-4">

        <div class="bg-primary rounded-4 p-4">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center">

                        <img class="img-fluid img-responsive" src="assets/images/foo-temple.png" alt="Bhaktikalpa">

                    </div>

                    <div class="col-md-4 text-white text-center text-md-start mt-3 mt-md-0">

                        <h4>Subscribe Now</h4>

                        <p class="mb-0">

                            Stay connected with Bhaktikalpa – subscribe now for inspiring insights, events, and spiritual updates delivered right to you!

                        </p>

                    </div>

                    <div class="col-md-6">

                        <div class="row">

                            <!-- Email Input -->

                            <div class="col-12 col-md-4">

                                <div class="newsletter position-relative mt-3">

                                    <input type="email" id="emailInput" class="form-control" placeholder="Your Email..." required>

                                </div>

                            </div>



                            <!-- Phone Input -->

                            <div class="col-12 col-md-4">

                                <div class="newsletter position-relative mt-3">

                                    <input type="tel" id="phoneInput" class="form-control" placeholder="Your Number..." required maxlength="10" pattern="[0-9]{10}">

                                    <div id="merrmsg"></div>

                                </div>

                            </div>



                            <!-- Submit Button -->

                            <div class="col-12 col-md-4">

                                <div class="newsletter position-relative mt-3">

                                    <button type="button" id="submitForm" class="form-control" style="color: white;">

                                        Submit

                                        <i class="fa-solid fa-angle-right ms-5"></i>

                                    </button>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>



        <div class="border-top py-5">

            <div class="footer-row row gy-5 g-sm-5 gx-xxl-6">

                <div class="border-end col-lg-3 col-md-4 col-6">

                    <h5 class="fw-bold mb-4"> <a target="_blank" href="iconic-category-details.php?id=13">Ashta Vinayaka Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=14"> Ashta Veeratta Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=26">Abodes Of Murugan</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=25">Athara Sthalams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="abroad.php">Abroad Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=10">Alwars</a></h5>

                    <h5 class="fw-bold mb-4"> <a target="_blank" href="iconic-category-details.php?id=54">Aditya Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=35">Char Dham</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=36">Divya Desams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=57">Durga Aalayams by Sage Parasurma</a></h5>

                    <!-- <h5 class="fw-bold mb-4">Durga Aalayams by Sage Parasurma</h5> -->

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=6">Hindu Ashrams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=1"> Jyorthirlinga Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="mystery.php">Mystery Temples</a></h5>

                </div>

                <div class="border-end col-lg-3 col-md-4 col-6">

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=50">Muktishetras</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="mantras.php">Mantras & Slokas</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=38">Nava Tirupati Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=19">Nava Puliyur Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=18">Nakshatra Temples & Trees</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=17">Navagraha Parihara Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=4">Narasimha Skhetras</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=15">Naga Devatas Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=41"></a>Nava Dwaraka Temples</h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=3">Pancha Rama Kshetras</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=33"></a>Pancha Kedar Temples</h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=32">Pancha Sabhai Thalangal</a></h5>

                </div>



                <div class="border-end col-lg-3 col-md-4 col-6">

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=31">Pancha Pandava Skhetras</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=2">Pancha Bootha Sthalams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=29">Pancha Ranga Kshetras</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=30">Pancha Kannan Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=28">Paadal Petra Sthalams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=11">River Goddess</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="https://saikalpa.com/"></a>Shiridi Sai Temples</h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=49">Swayambhu Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=43">Shaktipeetams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=42">Saptha Vidangam</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=44">Saptha Mangai Stalangal</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=45">Saptha Stana Temples</a></h5>

                </div>



                <div class="border-end col-lg-3 col-md-4 col-6">

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=46">Sapthavigraha Moorthis</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=47">Sastha Aalayams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=48">Shivalayams</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=5">Saints & Poets</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=7">Sacred Trees</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=8">Sacred Mountains</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="temple.php">Temples in India</a></h5>

                    <!-- <h5 class="fw-bold mb-4"><a target="_blank" href="">Tevaram Vaippu Sthalams</a></h5> -->

                    <h5 class="fw-bold mb-4"><a target="_blank" href="saints.php?id=9">Vahana Gods</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=51">Village Dieties</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="iconic-category-details.php?id=52">Vishnumaya Temples</a></h5>

                    <h5 class="fw-bold mb-4"><a target="_blank" href="#">Abhimana Kshetras</a></h5>

                </div>

            </div>

        </div>

    </div>

    <div class="container border-top">

        <div class="align-items-center g-3 py-4 row">

            <div class="col-lg-auto">

                <div>

                    <ul class="d-flex flex-wrap gap-2 list-unstyled mb-0 social-icon">

                        <li>

                            <a target="_blank" href="#" class="rounded-circle align-items-center d-flex fs-19 icon-wrap justify-content-center rounded-2 text-white fb">

                                <i class="fab fa-facebook-f"></i>

                            </a>

                        </li>

                        <li>

                            <a target="_blank" href="#" class="rounded-circle align-items-center d-flex fs-19 icon-wrap justify-content-center rounded-2 text-white inst">

                                <i class="fab fa-instagram"></i>

                            </a>

                        </li>

                        <li>

                            <a target="_blank" href="#" class="rounded-circle align-items-center d-flex fs-19 icon-wrap justify-content-center rounded-2 text-white whatsapp">

                                <i class="fa-brands fa-whatsapp"></i>

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

            <div class="col-lg order-md-first">

                <div class="align-items-center row">

                    <!-- start footer logo -->

                    <a href="index.php" class="col-sm-auto footer-logo mb-2 mb-sm-0">

                        <img src="assets/images/logo/bakthi-logo.png" alt="">

                    </a>

                    <!-- end /. footer logo -->

                    <!-- start text -->

                    <div class="col-sm-auto copy">&copy; <?php echo date("Y"); ?> Bhaktikalpa - All Rights Reserved.</div>

                    <!-- end /. text -->

                </div>

            </div>

        </div>

    </div>

</footer>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <img id="modalImage" src="" alt="Gallery Image" class="img-fluid rounded">

            </div>

        </div>

    </div>

</div>


<div id="ContentPlaceHolder1_soc" class="social-buttons">
   <a href="#" class="social-button social-button--facebook" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
   <a href="#" class="social-button social-button--linkedin" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
   <a href="#" class="social-button social-button--twitter" aria-label="twitter"><i class="fa fa-twitter"></i></a>
   <a href="#" class="social-button social-button--instagram" aria-label="instagram"><i class="fa fa-instagram"></i></a>
</div>

<style>
    .social-buttons {
       display: list;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    position: fixed;
    margin-left: 50px;
    margin-top: 30px;
    top: 50%;
    z-index: 99999;
    top: 50%;
    transform: translateY(-50%);
}
    .social-button {
    position: relative;
    display: flex
;
    justify-content: center;
    align-items: center;
    outline: none;
    width: 36px;
    height: 36px;
    text-decoration: none;
    border-radius: 100%;
    background: #fff;
    text-align: center;
    background-color: #000;
    margin-bottom: 10px;
    color:#fff;
}
.social-button::after {
    content: "";
    position: absolute;
    top: -1px;
    left: 50%;
    display: block;
    width: 0;
    height: 0;
    border-radius: 100%;
    transition: 0.3s;
}

.social-button--linkedin::after {
    background: #0077b5;
}
.social-button--facebook::after {
    background: #3b5999;
}
.social-button--twitter::after {
    background: #55acee;
}
.social-button--instagram::after {
    background: #e4405f;
}
.social-button:focus::after, .social-button:hover::after {
    width: calc(100% + 2px);
    height: calc(100% + 2px);
    margin-left: calc(-50% - 1px);
}
.social-button i, .social-button svg {
    position: relative;
    z-index: 1;
    transition: 0.3s;
}
@media(max-width:768px){
    .social-buttons{
        display:none;
    }
}
.btn-show-correction-form{
    cursor: pointer;
}
.btn-show-correction-form:hover{
    text-decoration:underline;
}
.sticky-download-btn {
    position: fixed;
    right: -62px;
    top: 50%;
    transform: translateY(-50%) rotate(90deg);
    background: #fb523a;
    color: #fff;
    padding: 10px 16px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 0px 0px 8px 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    z-index: 9999;
    transition: all 0.3s 
ease;
    
}

.sticky-download-btn:hover {
    background: #e55d00;
    padding-top: 20px;
}
</style>

<a href="mantra-book-creation-v2.php" class="sticky-download-btn">
    Download Mantras
</a>

<!-- end /. footer -->

<!-- Optional JavaScript -->

<script src="assets/plugins/jQuery/jquery.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/aos/aos.min.js"></script>

<script src="assets/plugins/macy/macy.js"></script>

<script src="assets/plugins/simple-parallax/simpleParallax.min.js"></script>

<script src="assets/plugins/OwlCarousel2/owl.carousel.min.js"></script>

<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.min.js"></script>

<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.min.js"></script>

<script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>

<script src="assets/plugins/counter-up/jquery.counterup.min.js"></script>

<script src="assets/plugins/jquery-fancyfileuploader/fancy-file-uploader/jquery.ui.widget.js"></script>

<script src="assets/plugins/jquery-fancyfileuploader/fancy-file-uploader/jquery.fileupload.js"></script>

<script src="assets/plugins/jquery-fancyfileuploader/fancy-file-uploader/jquery.iframe-transport.js"></script>

<script src="assets/plugins/jquery-fancyfileuploader/fancy-file-uploader/jquery.fancy-fileupload.js"></script>

<script src="assets/plugins/ion.rangeSlider/ion.rangeSlider.min.js"></script>

<script src="assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="assets/plugins/select2/select2.min.js"></script>

<script src="assets/js/script.js"></script>

<script src="assets/js/listing-map.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    $(document).ready(function() {

        $('#submitForm').click(function() {

            const email = $('#emailInput').val().trim();

            const phone = $('#phoneInput').val().trim();



            // Validate inputs

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            const phonePattern = /^[0-9]{10}$/;



            if (!email || !phone) {

                toastr.error('Please fill in both email and phone number.');

                return;

            }



            if (!emailPattern.test(email)) {

                toastr.error('Please enter a valid email address.');

                return;

            }



            if (!phonePattern.test(phone)) {

                toastr.error('Please enter a valid 10-digit phone number.');

                return;

            }



            // AJAX Request

            $.ajax({

                url: 'submit_email.php',

                type: 'POST',

                data: {

                    email,

                    phone

                },

                success: function(response) {

                    $('#emailInput').val('');

                    $('#phoneInput').val('');

                    toastr.success(response);

                },

                error: function() {

                    toastr.error('Subscription failed. Please try again.');

                }

            });

        });

    });

</script>

<script>

    function openNav() {

        document.getElementById("mySidenav").style.width = "250px";

    }



    function closeNav() {

        document.getElementById("mySidenav").style.width = "0";

    }

</script>



<script>

    // Function to filter gallery based on category

    function filterGallery(category) {

        let items = document.getElementsByClassName('gallery-item');

        for (let i = 0; i < items.length; i++) {

            items[i].style.display = category === 'all' || items[i].classList.contains(category) ? 'block' : 'none';

        }

    }

</script>

<script>

    function togglePlayPause() {

        const audio = document.getElementById("audioPlayer");

        const icon = document.getElementById("playPauseIcon");



        if (audio.paused) {

            audio.play();

            icon.classList.remove("fa-play");

            icon.classList.add("fa-pause");

        } else {

            audio.pause();

            icon.classList.remove("fa-pause");

            icon.classList.add("fa-play");

        }

    }



    // Reset icon when audio ends

    document.getElementById("audioPlayer").addEventListener("ended", () => {

        const icon = document.getElementById("playPauseIcon");

        icon.classList.remove("fa-pause");

        icon.classList.add("fa-play");

    });

</script>



<script>

    // Function to copy the current page link

    // function copyLink() {

    //     navigator.clipboard.writeText(window.location.href).then(() => {

    //         alert("Link copied to clipboard!");

    //     }).catch(err => {

    //         console.error('Failed to copy: ', err);

    //     });

    // }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>

    // Copy content to WhatsApp

    function shareToWhatsApp() {

        //const content = document.getElementById("printable-content").innerText;

        const url = `https://wa.me/?text=` + document.URL;

        window.open(url, '_blank');

    }



    // Download content as PDF

    function downloadPDF() {

        const {

            jsPDF

        } = window.jspdf;

        const pdf = new jsPDF({

            orientation: 'p', // Portrait mode

            unit: 'mm', // Units in millimeters

            format: 'a4' // A4 paper size

        });



        const content = document.getElementById("printable-content").innerText;



        // Define page margins and line height

        const marginLeft = 20;

        const marginTop = 20;

        const pageWidth = pdf.internal.pageSize.getWidth() - marginLeft * 2; // Width excluding margins

        const lineHeight = 10; // Space between lines

        const textHeight = pdf.splitTextToSize(content, pageWidth); // Automatically split long text into multiple lines



        // Print text and handle multi-page content

        let cursorY = marginTop;



        textHeight.forEach((line) => {

            if (cursorY + lineHeight > pdf.internal.pageSize.getHeight() - marginTop) {

                pdf.addPage(); // Add a new page if the content exceeds the current page height

                cursorY = marginTop;

            }

            pdf.text(line, marginLeft, cursorY);

            cursorY += lineHeight;

        });



        // Save the generated PDF

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

<script type="text/javascript">

    // function googleTranslateElementInit() {

    //     new google.translate.TranslateElement({
    //         pageLanguage: 'en',
    //         includedLanguages: 'en,hi,kn,ml,bn,ta,te'
    //     }, 'google_translate_element');

    // }



    // function toggleTranslate() {

    //     const translateElement = document.getElementById('google_translate_element');

    //     translateElement.style.display = (translateElement.style.display === 'none' || translateElement.style.display === '') ? 'block' : 'none';

    // }


function setLanguage(langCode) {
    const select = document.querySelector(".goog-te-combo");
    if (!select) return;

    select.value = langCode;
    select.dispatchEvent(new Event("change"));
}

// Listen for ?lang= parameter
(function () {
    const params = new URLSearchParams(window.location.search);
    const lang = params.get("lang");
    if (lang) {
        setTimeout(() => setLanguage(lang), 1000);
    }
})();

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,hi,kn,ml,bn,ta,te'
    }, 'google_translate_element');
}

function toggleTranslate() {
    const translateElement = document.getElementById('google_translate_element');
    translateElement.style.display =
        (translateElement.style.display === 'none' || translateElement.style.display === '') 
        ? 'block' : 'none';
}
(function () {
    const params = new URLSearchParams(window.location.search);
    const currentLang = params.get("lang") || "en";

    document
      .querySelectorAll(".sn_language_links a")
      .forEach(a => {
          if (a.dataset.lang === currentLang) {
              a.classList.add("active");
          }
      });
})();

</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>

    // Print only the specific content without social icons and other sections

    function printContent() {

        const printContents = document.getElementById("printable-content").innerHTML;

        const originalContents = document.body.innerHTML;



        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }

   <?php if(isset($id)){?>  

    $('#submit-comment').submit(function(event){

        event.preventDefault(); 

        var name = $('#name').val();

        var comment = $('#comment').val();

        var type = $('#type').val();

        var id = <?php echo $id;?>;

        $.ajax({

            url: 'ajax.php',

            type: 'POST',

            data: { name: name, comment: comment, ty: type, id: id },

            success: function(response) {

                console.log(response);

                $('#success-message').removeClass('d-none');

                $('#name').val('');

                $('#comment').val('');

            }

        });

    });

    <?php }?>

$("#phoneInput").keypress(function (event) {

if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {

  $("#merrmsg").html("Enter numbers only").show().fadeOut("slow");

  return false;

}

});

 $(".ad-slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoHeight:true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive:{
          0:{ items:1 },
          600:{ items:2 },
          1000:{ items:4 }
        }
      });

</script>

<script>
$(document).ready(function(){

    // Capture Views (when ads are displayed)
    $(".ad-card").each(function(e){
       
        e.preventDefault();
        let adId = $(this).data("id");

        $.post("ajax_private_ads.php", { id: adId,action:'UpdateViews' }, function(response){
            console.log("View updated for Ad ID:", adId, response);
        });
    });

    // Capture Clicks (when ad is clicked)
    $("body").on("click", '.ad-click', function(e) {
        e.preventDefault();

        let adId = $(this).closest(".ad-card").data("id");  // get ad ID
        let targetUrl = $(this).attr("href");               // get the ad URL

        $.post("ajax_private_ads.php", { id: adId, action: 'UpdateClicks' }, function(response) {
            console.log("Click updated for Ad ID:", adId, response);

            // Open in new tab/window after updating clicks
            window.open(targetUrl, "_blank");
        });
    });

});
</script>

<script>
$("#correctionForm").on("submit", function(e){
    e.preventDefault();

    $.ajax({
        url: "correction_submit.php",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(res){
            if(res.status === "success"){
                $("#correctionResponse").html("<span style='color:green;'>" + res.message + "</span>");
                $("#correctionForm")[0].reset();
            } else {
                $("#correctionResponse").html("<span style='color:red;'>" + res.message + "</span>");
            }
        }
    });
});
$("body").on("click", '.btn-show-correction-form',function(e){
    $("#correctionForm").slideToggle();
})



</script>

</body>



</html>