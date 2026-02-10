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



$select = "SELECT * FROM `temples` WHERE index_id='$id'";



$SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);







// Check if the query returns a result



if (mysqli_num_rows($SQL_STATEMENT) > 0) {



    $Row = mysqli_fetch_object($SQL_STATEMENT);



    $photo = $Row->upload_image;



    $country = $Row->country;



    $state = $Row->state;



    $city = $Row->city;



    $address = $Row->address;



} else {



    echo "<p>Temple not found.</p>";



    exit;



}





// Create the full address



$fullAddress = urlencode("$address, $city, $state, $country");


$liveStreams = [
  [
    "temple_name" => "Sri Venkateswara Temple, Tirupati",
    "youtube_url" => "https://www.youtube.com/embed/6x5xtNhOts0?rel=0&modestbranding=1&showinfo=0&autohide=1&fs=1",
    "start_time" => "01:30",
    "end_time" => "02:30",
    "timezone" => "Asia/Kolkata"
  ]
];



?>



<style>

    .stream {
      display: flex;
      flex-direction: column;
      background: #fcfcff;
      border-radius: 12px;
      margin-bottom: 30px;
      margin-top:10px;
      border: 1px solid #e3eaff;
      transition: 0.3s ease;
      padding: 10px;
    }

    .stream:hover {
      box-shadow: 0 5px 20px rgba(34, 69, 160, 0.1);
    }

    .stream.live {
      border: 2px solid #d49c00;
      background: #fff9e6;
    }

    .stream h2 {
      font-size: 16px;
      margin: 10px 0;
      color: #19378a;
    }

    .live-badge {
      background: #e63946;
      color: white;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-left: 10px;
      vertical-align: middle;
      box-shadow: 0 2px 6px rgba(230,57,70,0.3);
    }

    iframe {
      width: 100%;
      height: 320px;
      border-radius: 10px;
      border: none;
      margin-top: 10px;
    }

    .schedule {
      color: #555;
      font-size: 0.95rem;
      margin-top: 8px;
    }

    footer {
      text-align: center;
      font-size: 14px;
      margin-top: 40px;
      color: #777;
    }

    footer p {
      border-top: 1px solid #eee;
      padding-top: 15px;
      margin-top: 30px;
    }

    @media (max-width: 600px) {
      .stream iframe {
        height: 220px;
      }
    }

    h2.underline {



        display: inline-block; /* Makes the border width adapt to the text */



        border-bottom: 2px solid #000; /* Creates a bottom border */



        padding-bottom: 4px; /* Optional: Adds some spacing between text and border */



        margin-bottom: 10px; /* Adjusts spacing below the h2 if needed */



    }



    .custom-btn {



        font-size: 18px;



        font-weight: 600;



        border: 3px solid #ff8776;



        /* Primary border color */



        color: black;



        /* Primary text color */



        background-color: transparent;



        transition: all 0.3s ease;



    }







    .custom-btn:hover {



        border: 3px solid black;



        background-color: #ff8776 !important;



        /* Primary background on hover */



        color: black;



        /* White text on hover */



    }







    /* Sticky tab-container */



    .tab-container {



        position: sticky;



        top: 0;



   



        z-index: 56;



        /* Ensures the tab container stays above other content */



        padding: 10px 0;



        text-align: center;



     



        /* Optional: smooth transition effect */



    }

.theiaStickySidebar .btn-cus {
    padding: 8px 10px;
}

    @media (max-width: 576px) {



    .custom-btn {



        width: 100%; /* Full-width buttons on small screens */



        margin-bottom: 0.5rem;



    }



}







@media (max-width: 767px) {



    .custom-btn {



        font-size: 1rem; /* Optional: Adjust button text size */



        padding: 0.5rem 1rem;



    }



}



/* Custom button style */



.custom-btn {



    line-height: 1.5; /* Adjust line height for better text alignment */



    padding: 10px 20px; /* Adjust padding for better spacing */



    font-size: 1rem; /* Control font size for better readability */



    margin-bottom: 1rem; /* Space between buttons when stacked */



}







/* Adjust button spacing on mobile */



@media (max-width: 767px) {



    .custom-btn {



        font-size: 1.1rem; /* Slightly larger font on mobile */



        padding: 12px 24px; /* Increase button padding on mobile */



    }



}







/* Adjust button spacing on tablet screens */



@media (min-width: 768px) and (max-width: 991px) {



    .custom-btn {



        font-size: 1.2rem; /* Larger font on tablets */



    }



}







/* Adjust button spacing on desktop */



@media (min-width: 992px) {



    .custom-btn {



        font-size: 1.3rem; /* Larger font on desktops */



    }



}


.timing-section {
  background: #f8faff;
  border-radius: 16px;
  padding: 25px;
  box-shadow: 0 3px 10px rgba(35, 95, 200, 0.1);
  border-left: 4px solid #2c4da5;
  font-family: 'Poppins', sans-serif;
  color: #1f2c47;
  max-width: 420px;
  margin: 20px auto;
}

.timing-section h4 {
  color: #19378a;
  font-weight: 600;
  margin-bottom: 15px;
  text-align: center;
}

.timing-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.timing-list li {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #e4ebff;
  font-size: 15px;
}

.timing-list li:last-child {
  border-bottom: none;
}

.day-name {
  font-weight: 600;
  color: #000000ff;
  width:120px;
}

.time-range {
  font-weight: 500;
  color: #333;
}




</style>





<style>

@media print {

  /* Reduce padding and margins globally */

  body, html {

    margin: 0;

    padding: 0;

  }



  * {

    margin: 0 !important;

    padding: 0 !important;

    line-height: 1.2 !important;

  }



  /* Optional: Adjust specific elements */

  table {

    border-spacing: 0;

    border-collapse: collapse;

  }



  td, th {

    padding: 2px 4px !important;

  }



  .print-section {

    margin: 0 !important;

    padding: 0 !important;

  }

}

</style>

<!-- Start gallery with print icon -->

<?php

    $year = $Row->temple_age; // No year found

?>

<div class="container-fluid m-0 p-0 text-center bg-gradient text-center">



    <div class="overflow-hidden position-relative  banner-over-container">



        <img class="w-100 banner-h-420" src="app/uploads/temple/banner/<?php echo $Row->banner; ?>" style="" class="img-fluid" alt="Temple Image" >



        <h1 class="banner-over-title fs-1 font-caveat page-header-title fw-semibold m-2 pb-3  text-primary"><?php echo $Row->title;?></h1>



    </div>



</div>



<!-- End gallery -->



<!-- Video player container -->
<div class="modal fade" id="videoModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Video Story</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-0">
        <div id="videoContainer" style="width:100%; height:400px;">
            <!-- Video iframe will appear here -->
        </div>
      </div>

    </div>
  </div>
</div>
<style>
    .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background: rgb(255 135 118);
    color: #fff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    transition: 0.3s;
    }

    .owl-carousel .owl-nav button.owl-prev {
    left: 10px;   /* adjust as needed */
}

.owl-carousel .owl-nav button.owl-next {
    right: 10px;  /* adjust as needed */
}
    .stories-wrapper {
    width: 100%;
    overflow-x: auto;
    white-space: nowrap;
    padding: 10px 0;
}

.stories-carousel {
    display: flex;
    gap: 15px;
}

.story-item {
    position: relative;
    width: 100%;
    height: 390px;
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
}

.story-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.play-btn {
      position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 35px;
    color: white;
    text-shadow: 0 0 10px black;
    border: 2px solid #fff;
    border-radius: 100%;
    width: 60px;
    height: 60px;
    text-align: center;
    padding: 0px;
    padding-left: 5px;
    background: rgba(0, 0, 0, .4);
}
#story-player {
    margin-top: 20px;
    width: 100%;
    max-width: 400px;
}
#story-player iframe {
    width: 100%;
    height: 300px;
    border-radius: 15px;
}

</style>

<div id="printable-content" class="bg-gradient">







    <!-- Start printable-area -->



    <div id="printable-area">



        <div class="py-5">



            <div class="container">



                <div class="col-12">



                    <?php if (!empty($Row->speciality_title)) : ?>



                        <div id="Sthalam" class="card shadow mb-5 bg-body rounded text-dark p-4 mb-4 sth-text">



                            <h2 class="text-dark " align="center"><?php echo $Row->speciality_title; ?></h2>



                            <p class="text-dark sth-text"><?php echo $Row->speciality; ?></p>



                        </div>



                    <?php endif; ?>







                </div>



                <div class="row">







                    <!-- Main Content Section -->



                    <div class="col-lg-8 ps-xxl-5 content">



                        <!-- Tab Navigation -->



                      <div class="tab-container text-center mb-4 hidePrint custom-sticky">



                          <div class="card rounded-4 border-0 bg-gradient">



    <div class="row m-3">



        <?php if (!empty($Row->sthalam)) : ?>



            <div class="col-6 col-sm-4 col-md-auto">



                <button onclick="scrollToCard('Sthalam')" class="btn btn-primary btn-cus">Temple Overview</button>



            </div>



        <?php endif; ?>



        <?php if (!empty($Row->puranam)) : ?>



            <div class="col-6 col-sm-4 col-md-auto">



                <button onclick="scrollToCard('Puranam')" class="btn btn-primary btn-cus">Origin Story</button>



            </div>



        <?php endif; ?>



        <?php if (!empty($Row->varnam)) : ?>



            <div class="col-6 col-sm-4 col-md-auto">



                <button onclick="scrollToCard('Varnam')" class="btn btn-primary btn-cus">Architecture</button>



            </div>



        <?php endif; ?>



        <?php if (!empty($Row->highlights)) : ?>



            <div class="col-6 col-sm-4 col-md-auto">



                <button onclick="scrollToCard('Highlights')" class="btn btn-primary btn-cus">Mystical Beliefs</button>



            </div>



        <?php endif; ?>



        <?php if (!empty($Row->sevas)) : ?>



            <div class="col-6 col-sm-4 col-md-auto">



                <button onclick="scrollToCard('Sevas')" class="btn btn-primary btn-cus">Festivals & Daily Rituals</button>



            </div>



        <?php endif; ?>



    </div>



</div>



</div>



<div id="bannerTitle">



    <!-- Content Cards -->



    <?php if (!empty($Row->sthalam)) : ?>



        <div id="Sthalam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <div class="">



            <h2 class="text-dark font-caveat" >Temple Overview</h2>



            </div>



        



            <p><?php echo $Row->sthalam; ?></p>



        </div>



    <?php endif; ?>

     <?php if (!empty($Row->sthalam)) : ?>



        <div id="Templeage" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <div class="">



            <h2 class="text-dark font-caveat" >Era</h2>



            </div>



        



            <p><?php echo $Row->temple_age; ?></p>



        </div>



    <?php endif; ?>







    <?php if (!empty($Row->puranam)) : ?>



        <div id="Puranam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <h2 class="text-dark font-caveat" >Origin Story</h2>



            <p><?php echo $Row->puranam; ?></p>



        </div>



    <?php endif; ?>







    <?php if (!empty($Row->varnam)) : ?>



        <div id="Varnam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <h2 class="text-dark font-caveat" >Architecture</h2>



            <p><?php echo $Row->varnam; ?></p>



        </div>



    <?php endif; ?>







    <?php if (!empty($Row->highlights)) : ?>



        <div id="Highlights" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <h2 class="text-dark font-caveat" >Mystical Beliefs</h2>



            <p><?php echo $Row->highlights; ?></p>



        </div>



    <?php endif; ?>







    <?php if (!empty($Row->sevas)) : ?>



        <div id="Sevas" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">



            <h2 class="text-dark font-caveat" >Festivals & Daily Rituals</h2>



            <p><?php echo $Row->sevas; ?></p>



        </div>



    <?php endif; ?>



</div>



 

    </div>










                    <!-- Sidebar Section -->



                    <div class="col-lg-4 sidebar">



                        <div class="social-media hidePrint">



                            <!-- Print Icon -->



                            <a class="btn btn-primary d-inline-block" href="" data-lang="<?php echo $_GET['lang'] ?? 'en'; ?>" id="printBtn">



                                <i class="fas fa-print"></i>



                            </a>







                            <!-- WhatsApp Icon -->



                            <a class="btn btn-primary d-inline-block" href="#" onclick="shareToWhatsApp()">



                                <i class="fab fa-whatsapp"></i>



                            </a>



                            <!-- PDF Download Icon -->



                            <!--<a class="btn btn-primary d-inline-block" href="#" onclick="downloadPDF()">-->



                            <!--    <i class="fas fa-file-pdf"></i>-->



                            <!--</a>-->



                            <!-- Copy Link Icon



                            <a class="btn btn-primary d-inline-block" href="#" onclick="copyContent()">



                                <i class="fas fa-copy"></i>



                            </a> -->



                            <button id="toggleIcon" class="btn btn-primary d-inline-block">



            <i class="fa  fa-play"></i> Play



        </button>







                        </div>







                        <?php if (!empty($Row->time)): ?>



                            <div class="border p-4 rounded-4 shadow-sm" style="margin-top: 30px;">

                            <?php if($liveStreams){ ?>
                            <div class="align-items-center justify-content-between mb-3">



                                    <h4 class="mb-0">Live Darshan / <span class="text-primary">Aarti Schedule</span></h4>



                                    <?php foreach ($liveStreams as $stream): ?>
                                        <?php
                                        date_default_timezone_set($stream['timezone']);
                                        $now = date("H:i");
                                        $isLive = ($now >= $stream['start_time'] && $now <= $stream['end_time']);
                                        ?>

                                        <div class="stream <?= $isLive ? 'live' : '' ?>">
                                        <h2><?= htmlspecialchars($stream['temple_name']) ?>
                                            <?php if ($isLive): ?>
                                            <span class="live-badge">🔴 Live Now</span>
                                            <?php endif; ?>
                                        </h2>

                                        <?php if ($isLive): ?>
                                            <iframe src="<?= htmlspecialchars($stream['youtube_url']) ?>" allowfullscreen></iframe>
                                        <?php else: ?>
                                            <div class="schedule">
                                            Next Live Darshan: <strong><?= $stream['start_time'] ?> - <?= $stream['end_time'] ?> (IST)</strong>
                                            </div>
                                        <?php endif; ?>
                                        </div>

                                    <?php endforeach; ?>



                                </div>

                            <?php } ?>
                                <div class="d-flex align-items-center justify-content-between mb-3">



                                    <h4 class="mb-0">Temple  <span class="text-primary">Timings</span></h4>



                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">



                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />



                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />



                                    </svg>



                                </div>



                                <div class="d-flex justify-content-between timing-list">



                                   <?php echo $Row->time;?>


                                </div>



                            </div>



                        <?php endif; ?>



                        <?php if (!empty($Row->gallery_image)): ?>



                            <div class="border p-4 rounded-4 shadow-sm mt-5">



                                <div class="col-12">



                                    <h4 class="mb-0  text-primary">Gallery</h4>



                                    <div class="row mt-3 g-2 review-image zoom-gallery">







                                        <?php



                                        $existingImages = array_filter(explode(',', $Row->gallery_image)); // Remove empty entries



                                        foreach ($existingImages as $image) {



                                            $imagePath = "app/uploads/Temple_gallery/" . htmlspecialchars($image);



                                            // Check if the image file exists



                                            if (trim($image) !== "" && file_exists($imagePath)) {



                                        ?>



                                                <div class="col-auto">



                                                    <a href="<?= $imagePath; ?>" id="image-<?= htmlspecialchars($image); ?>" class="gallery-overlay-hover dark-overlay position-relative d-block overflow-hidden rounded-3">



                                                        <img src="<?= $imagePath; ?>" alt="Gallery Image" class="img-fluid rounded-3 object-fit-cover" height="70" width="112">



                                                        



                                                    </a>



                                                </div>



                                        <?php



                                            }



                                        }



                                        ?>



                                    </div>



                                </div>



                            </div>



                        <?php endif; 



                        //if($address !=''){?>



                        <div class="border p-4 rounded-4 shadow-sm mt-5 print-disable">



                            <div class="container">



                                <h5 class="mb-3">Temple <span class="text-primary">Location</span> with Nearby Temples</h5>



                                <div id="location-info" class="d-none"></div>



                                <!-- <p><?php echo htmlspecialchars("$address, $city, $state, $country"); ?></p> -->



                                <div id="map" style="width: 100%; height: 400px;"></div>



                            </div>



                        </div>



                        <?php //}?>



                    </div>



                </div>



            </div>



            <!-- <div id="location-info">Fetching your location...</div> -->







        </div>



    </div>



</div>



<!-- <div id="map" style="width: 100%; height: 400px;"></div> -->



</div>




<?php include('include/priest-reviews.php');?>


<!-- <div class="container">



    <h2>Temple Location</h2>



    <p><?php echo htmlspecialchars("$address, $city, $state, $country"); ?></p>



    <div id="map" style="width: 100%; height: 400px;"></div>



</div> -->



<?php



$select = "SELECT * FROM `temples` WHERE index_id='$id'";



$SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);







// Check if the query returns a result



if (mysqli_num_rows($SQL_STATEMENT) > 0) {



    $Row = mysqli_fetch_object($SQL_STATEMENT);



    $photo = $Row->upload_image;



    $country = $Row->country;



    $temple_name = $Row->title;



    $state = $Row->state;



    $city = $Row->city;



    $address = $Row->address;



} else {



    echo "<p>Temple not found.</p>";



    exit;



}



?>







<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-RZCzEuy7JMyMu4ykftt5ooRcCeqhKY&libraries=places&callback=initMap"></script>



<script>



    function scrollToCard(cardId) {



        const card = document.getElementById(cardId);







        // Scroll to the card



        card.scrollIntoView({



            behavior: 'smooth'



        });







        // Add the highlight animation



        card.classList.add('highlight');







        // Remove the highlight animation after 1 second



        setTimeout(() => {



            card.classList.remove('highlight');



        }, 1000);



    }



    



    function initMap() {



    const locationInfoDiv = document.getElementById('location-info');



    const mapElement = document.getElementById('map');



    const [fromAddress, templeName] = <?php echo json_encode([$address, $temple_name]); ?>;







    const geocoder = new google.maps.Geocoder();







    // Show a loading spinner or message while waiting for the map to load



    locationInfoDiv.textContent = 'Loading map...';







    // Geocode the address to get the user's location



    geocoder.geocode({



        address: fromAddress



    }, (results, status) => {



        if (status === google.maps.GeocoderStatus.OK && results[0]) {



            const userLocation = results[0].geometry.location;



            console.log("Coordinates fetched: ", userLocation.lat(), userLocation.lng());







            // Initialize the map centered on the user's location



            const map = new google.maps.Map(mapElement, {



                center: userLocation,



                zoom: 11,



            });







            // Add a marker for the user's location with the highest z-index



            const userMarker = new google.maps.Marker({



                position: userLocation,



                map: map,



                title: results[0].formatted_address,



                zIndex: 9999, // Highest z-index for userMarker



                icon: {



                    url: "https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png",



                    scaledSize: new google.maps.Size(40, 40),



                },



            });







            // Create an info window for the user's location



            let currentInfoWindow = null; // Track the currently open info window







            // Function to set the content of the InfoWindow



            function setInfoWindowContent(marker, data) {



                const name = data.Name ? data.Name : 'Name not available';



                const content = `



                    <div style="text-align: center;">



                        <h4 class="fs-5 fw-semibold restaurant-text-truncate overflow-hidden mb-0">



                            <span style="padding:50px;">${templeName}</span>



                        </h4>



                        <br>



                        <span style="color: #555;">${data.address}</span>



                        <br>



                        <br>



                        <a href="https://www.google.com/maps/place/?q=place_id:${results[0].place_id}" target="_blank" style="color: #007bff; text-decoration: none;">



                            Click to get Direction



                        </a>



                    </div>



                `;



                return content;



            }







            // Attach the info window to the user marker



            userMarker.addListener('click', function() {



                if (currentInfoWindow) {



                    currentInfoWindow.close(); // Close the previous info window



                }







                currentInfoWindow = new google.maps.InfoWindow({



                    content: setInfoWindowContent(userMarker, {



                        address: results[0].formatted_address, // Example data



                        placeId: results[0].place_id, // Example data



                    }),



                });







                currentInfoWindow.open(map, userMarker); // Open the new info window



            });







            // Extract city and area/place from the geocoded results



            const components = results[0].address_components;



            let city = "",



                area = "";



            components.forEach((component) => {



                if (component.types.includes("locality")) {



                    city = component.long_name;



                }



                if (component.types.includes("sublocality") || component.types.includes("neighborhood")) {



                    area = component.long_name;



                }



            });







            const formattedLocation = `${area ? area + ", " : ""}${city}`;







            // Search for nearby temples



            const service = new google.maps.places.PlacesService(map);



            const request = {



                location: userLocation,



                radius: 50000, // 50 km radius



                type: ['hindu_temple'], // Specify "Hindu temples"



            };







            service.nearbySearch(request, (results, status) => {



                if (status === google.maps.places.PlacesServiceStatus.OK) {



                    results.forEach((place) => {



                        // Create a custom marker for temples



                        const placeMarker = new google.maps.Marker({



                            position: place.geometry.location,



                            map: map,



                            title: place.name,



                            icon: {



                                url: './assets/images/temple-icon.png', // Red Om symbol



                                scaledSize: new google.maps.Size(40, 40),



                            },



                        });







                        // Variable to track the currently displayed card



                        let customCardElement = null;







                        placeMarker.addListener('click', () => {



                            // Close the previously opened info window (if any)



                            if (currentInfoWindow) {



                                currentInfoWindow.close();



                            }







                            // Create custom content for the InfoWindow when a temple marker is clicked



                            const content = `



                                <div style="



                                    font-family: Arial, sans-serif; 



                                    font-size: 12px; 



                                    line-height: 1.4; 



                                    width: 100%; 



                                    max-width: 100%; /* Ensure it doesn't overflow */



                                    text-align: center; 



                                    padding: 10px; 



                                    border: 1px solid #ddd; 



                                    border-radius: 8px; 



                                    background-color: #fff; 



                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 



                                    position: relative; 



                                    overflow: hidden;



                                ">



                                    <!-- Close button -->



                                    <button class="close-button" style="



                                        position: absolute; 



                                        top: 10px; 



                                        right: 10px; 



                                        background: none; 



                                        border: none; 



                                        font-size: 16px; 



                                        cursor: pointer; 



                                        color: #d9534f;



                                    ">



                                        ×



                                    </button>



                                    <strong style="color: #d9534f; text-transform: capitalize;">



                                        ${place.name}



                                    </strong>



                                    <br><br>



                                    <span style="color: #555; font-size: 11px;">${place.vicinity}</span>



                                    <br><br>



                                    <a href="https://www.google.com/maps/place/?q=place_id:${place.place_id}" 



                                       target="_blank" 



                                       style="color: #007bff; text-decoration: none; font-size: 12px;">



                                        View on Google Maps



                                    </a>



                                </div>



                            `;







                            // Create a new InfoWindow for the temple



                            currentInfoWindow = new google.maps.InfoWindow({



                                content: content,



                            });







                            // Open the InfoWindow for the clicked marker



                            currentInfoWindow.open(map, placeMarker);







                            // Wait for the InfoWindow to open, then attach the close button event listener



                            google.maps.event.addListener(currentInfoWindow, 'domready', () => {



                                const closeButton = document.querySelector('.close-button');



                                closeButton.addEventListener('click', () => {



                                    currentInfoWindow.close();



                                });



                            });



                        });



                    });



                } else {



                    locationInfoDiv.textContent += "No nearby temples found.";



                }



            });



        } else {



            locationInfoDiv.textContent = "Unable to fetch your location. Please check the address.";



        }



    });



}







    window.onload = initMap;



</script>



<script>



    // JavaScript function to scroll to specific content section



    function scrollToCard(cardId) {



        var element = document.getElementById(cardId);



        if (element) {



            element.scrollIntoView({



                behavior: "smooth"



            });



        }



    }



</script>



<script>

const toggleButton = document.getElementById('toggleIcon');

const sthalam = document.getElementById('Sthalam').textContent;

const bannerTitle = sthalam +' '+document.getElementById('bannerTitle').textContent;



const synth = window.speechSynthesis;

let utterance;

let isPlaying = false;

let selectedVoice = null;



// Load voices and select best match

function setupVoice() {

  const voices = synth.getVoices();



  selectedVoice = voices.find(voice =>

    voice.lang === 'hi-IN' ||

    voice.name.toLowerCase().includes('hindi') ||

    voice.lang === 'en-IN'

  );



  if (selectedVoice) {

    console.log('Using voice:', selectedVoice.name);

  } else {

    console.warn('Preferred voice not found. Using default.');

  }

}



// Create and speak the utterance

function playSpeech() {

  if (synth.speaking) {

    synth.cancel();

  }



  utterance = new SpeechSynthesisUtterance(bannerTitle);

  if (selectedVoice) {

    utterance.voice = selectedVoice;

  }



  // Optional: adjust rate, pitch, and volume

  utterance.rate = 1;

  utterance.pitch = 1;

  utterance.volume = 1;



  utterance.onend = function () {

    isPlaying = false;

    toggleButton.innerHTML = '<i class="fas fa-volume-up"></i> Play';

  };



  synth.speak(utterance);

  isPlaying = true;

  toggleButton.innerHTML = '<i class="fa fa-stop"></i> Stop';

}



// Handle voice load

synth.onvoiceschanged = setupVoice;



// Button toggle

toggleButton.addEventListener('click', function () {

  if (isPlaying) {

    synth.cancel();

    isPlaying = false;

    toggleButton.innerHTML = '<i class="fa fa-play"></i> Play';

  } else {

    playSpeech();

  }

});



// Cancel on unload

window.addEventListener('beforeunload', function () {

  if (synth.speaking) {

    synth.cancel();

  }

});



const voiceSelect = document.getElementById('voiceSelect');



function populateVoiceList() {

  const voices = synth.getVoices();

  voiceSelect.innerHTML = '';

  voices.forEach((voice, index) => {

    const option = document.createElement('option');

    option.textContent = `${voice.name} (${voice.lang})`;

    option.value = index;

    voiceSelect.appendChild(option);

  });

}



synth.onvoiceschanged = populateVoiceList;

</script>

<?php
function getTemplePrintContent($Row) {

    // Handle empty fields
    $safe = function($data) {
        return !empty($data) ? $data : "Information not available.";
    };

    // Prepare gallery
    $galleryHTML = "";
    if (!empty($Row->gallery_image)) {
        $imgs = array_filter(explode(",", $Row->gallery_image));
        $galleryHTML .= "<h2 class='sec-head font-caveat' style='border-bottom:3px solid #ff8776; width:fit-content;'>Gallery</h2>
            <div>";
        foreach ($imgs as $img) {
            $path = "app/uploads/Temple_gallery/" . trim($img);
            if (file_exists($path)) {
                $galleryHTML .= "<img src='$path' style='width:200px; margin:10px; border-radius:8px; height:220px;'/>";
            }
        }
        $galleryHTML .= "</div>";
    }
    
    // Build full printable HTML
    $html = "
    <link href='assets/css/css.css' rel='stylesheet'>
    <style>
    /* Google fonts --------------------------- */
@import url('https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap');
    .para{
      font-family: 'georgia';
    font-size: 18px !important;
    text-align: justify;
    word-spacing: -0.5px;
}
    .sec-head{
        font-family: 'georgia';
    }
     .caveat-text {
        font-family: 'Caveat', cursive !important;
    }

.timing-section {
  background: #f8faff;
  border-radius: 16px;
  padding: 25px;
  box-shadow: 0 3px 10px rgba(35, 95, 200, 0.1);
  border-left: 4px solid #2c4da5;
  font-family: 'Poppins', sans-serif;
  color: #1f2c47;
  max-width: 420px;
  margin: 20px auto;
}

.timing-section h4 {
  color: #19378a;
  font-weight: 600;
  margin-bottom: 15px;
  text-align: center;
}

.timing-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.timing-list li {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #e4ebff;
  font-size: 15px;
}

.timing-list li:last-child {
  border-bottom: none;
}

.day-name {
  font-weight: 600;
  color: #000000ff;
  width:120px;
}

.time-range {
  font-weight: 500;
  color: #333;
}
    </style>
    
        <div style='padding:20px; font-family:Arial;'>

            <h1 class='caveat-text font-caveat' style='font-weight: 600 !important;'>{$safe($Row->title)}</h1>

            <img src='app/uploads/temple/banner/{$Row->banner}'
                 style='width:100%; max-height:300px; object-fit:cover; border-radius:8px; margin-bottom:20px;' />

            <h2 class='sec-head font-caveat' style=' width:fit-content;'>Speciality</h2>
            <p class='para'>{$safe($Row->speciality)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Temple Overview</h2>
            <p class='para'>{$safe($Row->sthalam)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Era</h2>
            <p class='para'>{$safe($Row->temple_age)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Origin Story</h2>
            <p class='para'>{$safe($Row->puranam)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Architecture</h2>
            <p class='para'>{$safe($Row->varnam)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Mystical Beliefs</h2>
            <p class='para'>{$safe($Row->highlights)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Festivals & Daily Rituals</h2>
            <p class='para'>{$safe($Row->sevas)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Timings</h2>
            <p class='para'>{$safe($Row->time)}</p>

            <h2 class='sec-head caveat-text' style=' width:fit-content;'>Address</h2>
            <p class='para'>{$safe($Row->address)}, {$safe($Row->city)}, {$safe($Row->state)}, {$safe($Row->country)}</p>

            $galleryHTML

        </div>
    ";

    return $html;
}

$printContent = getTemplePrintContent($Row);
?>
<div id="printArea" style="display:none;">
    <?php echo $printContent; ?>
</div>

<script>
   document.getElementById("printBtn").addEventListener("click", function () {
    var printContents = document.getElementById("printArea").innerHTML;
    var printWindow = window.open('', '', 'width=900,height=650');

    printWindow.document.write('<html><head><title>Print Temple</title>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
});


</script>



<?php include('./include/footer.php'); ?>

<script>
$(document).ready(function() {

    // Initialize Owl Carousel
    $('.stories-carousel').owlCarousel({
          loop:true,
        margin:25,
        nav:true,
        dots:false,
        autoplay:false,
        smartSpeed:600,
        responsive:{
          0:{ items:2 },
          768:{ items:4 },
          1200:{ items:6 }
        }
    });

   // Extract YouTube ID from URL
    function getYouTubeID(url) {
        const match = url.match(/(?:v=|youtu\.be\/)([^&]+)/);
        return match ? match[1] : null;
    }

    // When a story is clicked → open modal with video
    $(".story-item").click(function () {
        let videoURL = $(this).data("video");
        let videoID = getYouTubeID(videoURL);

        if (!videoID) return alert("Invalid YouTube link");

        let iframeHTML = `
            <iframe width="100%" height="400" 
                src="https://www.youtube.com/embed/${videoID}?autoplay=1" 
                frameborder="0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
            </iframe>
        `;

        $("#videoContainer").html(iframeHTML);

        let modal = new bootstrap.Modal(document.getElementById('videoModal'));
        modal.show();
    });

    // Stop video when modal is closed
    $('#videoModal').on('hidden.bs.modal', function () {
        $("#videoContainer").html(""); // removes the iframe
    });
});
</script>