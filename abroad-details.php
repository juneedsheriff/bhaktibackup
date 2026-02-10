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
$select = "SELECT * FROM `abroad` WHERE index_id='$id'";
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
?>
<style>
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

    .custom-sticky {
        position: sticky;
        top: 0;
        /* Stick to the top of the viewport */
        z-index: 1030;
        /* Ensure it stays above other elements */
       
        /* Background to avoid transparency issues */
        padding: 10px 0;
        /* Add padding for spacing */

    }
</style>
<div class="container-fluid m-0 p-0 text-center bg-gradient text-center">
    <div class="overflow-hidden position-relative  banner-over-container">
                    <img class="w-100 banner-h-420" src="app/uploads/abroad/banner/<?php echo $Row->banner; ?>" class="img-fluid" alt="Temple Image">
        <h1 class="banner-over-title fs-1 font-caveat page-header-title fw-semibold m-2 pb-3  text-primary"><?php echo $Row->title; ?></h1>
    </div>
</div>

<!-- End gallery -->
<div id="printable-content" class="bg-gradient">

    <!-- Start printable-area -->
    <div id="printable-area">
        <div class="py-5">
            <div class="container">
            <div class="col-12">
                        <?php if (!empty($Row->speciality_title)) : ?>
                            <div id="Sthalam" class="card shadow mb-5 bg-body rounded p-4 mb-4">
                                <h2 class="text-dark" align="center"><?php echo $Row->speciality_title; ?></h2>
                                <p class="text-dark "><?php echo $Row->speciality; ?></p>
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
                <button onclick="scrollToCard('Sthalam')" class="btn btn-primary">Sthalam</button>
            </div>
        <?php endif; ?>
        <?php if (!empty($Row->puranam)) : ?>
            <div class="col-6 col-sm-4 col-md-auto">
                <button onclick="scrollToCard('Puranam')" class="btn btn-primary ">Puranam</button>
            </div>
        <?php endif; ?>
        <?php if (!empty($Row->varnam)) : ?>
            <div class="col-6 col-sm-4 col-md-auto">
                <button onclick="scrollToCard('Varnam')" class="btn btn-primary">Varnam</button>
            </div>
        <?php endif; ?>
        <?php if (!empty($Row->highlights)) : ?>
            <div class="col-6 col-sm-4 col-md-auto">
                <button onclick="scrollToCard('Highlights')" class="btn btn-primary">Highlights</button>
            </div>
        <?php endif; ?>
        <?php if (!empty($Row->sevas)) : ?>
            <div class="col-6 col-sm-4 col-md-auto">
                <button onclick="scrollToCard('Sevas')" class="btn btn-primary">Sevas</button>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

                        <!-- Content Cards -->
                        <?php if (!empty($Row->sthalam)) : ?>
                            <div id="Sthalam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">
                                <h2 class="text-dark" style="border-bottom:3px solid #ff8776; width:fit-content;">Sthalam</h2>
                                <p><?php echo $Row->sthalam; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($Row->puranam)) : ?>
                            <div id="Puranam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">
                                <h2 class="text-dark" style="border-bottom:3px solid #ff8776; width:fit-content;">Puranam</h2>
                                <p><?php echo $Row->puranam; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($Row->varnam)) : ?>
                            <div id="Varnam" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">
                                <h2 class="text-dark" style="border-bottom:3px solid #ff8776; width:fit-content;">Varnam</h2>
                                <p><?php echo $Row->varnam; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($Row->highlights)) : ?>
                            <div id="Highlights" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">
                                <h2 class="text-dark" style="border-bottom:3px solid #ff8776; width:fit-content;">Highlights</h2>
                                <p><?php echo $Row->highlights; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($Row->sevas)) : ?>
                            <div id="Sevas" class="card shadow mb-5 bg-body rounded p-4 mb-4 sth-text text-dark">
                                <h2 class="text-dark" style="border-bottom:3px solid #ff8776; width:fit-content;">Sevas</h2>
                                <p><?php echo $Row->sevas; ?></p>
                            </div>
                        <?php endif; ?>
                         <!-- Comment Form -->
 <div class="row">
    <div class="comment-box mt-3 ">
        <h4>Leave a Comment</h4>
        <div class="alert alert-success mt-3 d-none" id="success-message">
            Comment successfully submitted and is pending approval!
        </div>
        <form action="" method="post" id="submit-comment">
        <div class="form-group mb-3">
            <p>Name</p>
            <input type="text" class="form-control" id="name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <p>Comment</p>
            <textarea class="form-control " id="comment" rows="4" placeholder="Your Comment" required></textarea>
        </div>
        <input type="hidden" name="type" id="type" value="abroad" />
        <button class="btn btn-primary" type="submit">Post Comment</button>
        </form>
    </div>
    <?php $query = "SELECT * FROM `comments` WHERE type='abroad' AND is_approved=1";
    $result = mysqli_query($DatabaseCo->dbLink,$query);
    if(mysqli_num_rows($result) > 0){?>
    <h3 class="mt-5">Comments</h3>
    <div id="comments-section" class="comment-section">
    <?php while ($Rowc = mysqli_fetch_object($result)) {?>
        <p><strong><?php echo $Rowc->name;?></strong> says,<br><?php echo $Rowc->comment;?></p>
        <hr>
    <?php }?>
    </div>
    <?php }?>
</div>
                    </div>


                    <!-- Sidebar Section -->
                    <div class="col-lg-4 sidebar ">
                        <div class="social-media hidePrint">
                            <!-- Print Icon -->
                            <a class="btn btn-primary d-inline-block" href="#" onclick="window.print();">
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
                            </a>-->
                            <button id="toggleIcon" class="btn btn-primary d-inline-block">
            <i class="fa  fa-play"></i> Play
        </button>
                        </div>

                        <?php if (!empty($Row->time)): ?>
                            <div class="border p-4 rounded-4 shadow-sm" style="margin-top: 30px;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="mb-0">Opening <span class="text-primary">Hours</span></h4>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                    </svg>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><?php echo $Row->time; ?></span>
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
                                        $imagePath = "app/uploads/abroad/gallery/" . htmlspecialchars($image);
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
                        <?php endif; ?>
                        <div class="border p-2 rounded-4 shadow-sm mt-5 print-disable">
                            <div class="container">
                                <!-- <h4 class="mb-3">Temple <span class="text-primary">Location</span></h4> -->
                                <div id="location-info" class="d-none"></div>
                                <!-- <p><?php echo htmlspecialchars("$address, $city, $state, $country"); ?></p> -->
                                <div id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div id="location-info">Fetching your location...</div> -->

        </div>
    </div>
</div>
<!-- <div id="map" style="width: 100%; height: 400px;"></div> -->
</div>

<!-- <div class="container">
    <h2>Temple Location</h2>
    <p><?php echo htmlspecialchars("$address, $city, $state, $country"); ?></p>
    <div id="map" style="width: 100%; height: 400px;"></div>
</div> -->
<?php
// Ensure proper SQL queries are working

// Calculate total pages


$select = "SELECT * FROM `abroad` WHERE index_id='$id'";
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
</script>
<!-- <script>
    // Google Maps initialization function
    function initAutocomplete() {
        // Combine the address details into one full address
        var address = "<?php echo "$address, $city, $state, $country"; ?>";

        // Initialize the Geocoder and map
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -33.8688,
                lng: 151.2195
            }, // Default center, updated upon geocode
            zoom: 13,
            mapTypeId: "roadmap"
        });

        const geocoder = new google.maps.Geocoder();

        // Geocode the address to get coordinates
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script> -->
<script>
    function initMap() {
        const locationInfoDiv = document.getElementById('location-info');
        const mapElement = document.getElementById('map');
        const [fromAddress, templeName] = <?php echo json_encode([$address, $temple_name]); ?>;

        const geocoder = new google.maps.Geocoder();

        // Show a loading spinner or message while waiting for the map to load
        locationInfoDiv.textContent = 'Loading map...';

        // Geocode the address to get the user's location
        geocoder.geocode({ address: fromAddress }, (results, status) => {
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
    // Ensure the data object contains a valid name before rendering
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
                View on Google Maps
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
    google.maps.event.addListener(currentInfoWindow, 'domready', function() {
                const closeButton = currentInfoWindow.getContent().querySelector('.info-window-close');
                closeButton.style.display = 'none';

                currentInfoWindow.getDiv().addEventListener('mouseover', function() {
                    closeButton.style.display = 'inline-block';
                });

                currentInfoWindow.getDiv().addEventListener('mouseout', function() {
                    closeButton.style.display = 'none';
                });
            });
    currentInfoWindow.open(map, userMarker); // Open the new info window
});


                // Extract city and area/place from the geocoded results
                const components = results[0].address_components;
                let city = "", area = "";
                components.forEach((component) => {
                    if (component.types.includes("locality")) {
                        city = component.long_name;
                    }
                    if (component.types.includes("sublocality") || component.types.includes("neighborhood")) {
                        area = component.long_name;
                    }
                });

                const formattedLocation = `${area ? area + ", " : ""}${city}`;
                //document.title = `Nearby Temples - ${formattedLocation}`;

                // Search for nearby temples
                const service = new google.maps.places.PlacesService(map);
                const request = {
                    location: userLocation,
                    radius: 50000, // 50 km radius
                    type: ['hindu_temple'], // Specify "Hindu temples"
                };

                service.nearbySearch(request, (results, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        const infoWindows = []; // To hold open info windows

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

                            placeMarker.addListener('mouseover', () => {
                                // Remove any existing custom card
                                if (customCardElement) {
                                    customCardElement.remove();
                                }

                                // Create the custom card container
                                customCardElement = document.createElement('div');
                                customCardElement.innerHTML = `
                                    <div style="
                                        font-family: Arial, sans-serif; 
                                        font-size: 10px; 
                                        line-height: 1.4; 
                                        width: 250px; /* Set a smaller card width */
                                        display: flex; 
                                        flex-direction: column; 
                                        align-items: center; 
                                        text-align: center; 
                                        box-sizing: border-box; 
                                        padding: 10px; 
                                        margin: 10px auto; 
                                        border: 1px solid #ddd; 
                                        border-radius: 8px; 
                                        background-color: #fff; 
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                                        position: absolute; 
                                        z-index: 1000;">
                                        
                                        <!-- Card Header -->
                                        <strong style="font-size: 12px; color: #d9534f; text-transform: capitalize;">
                                            ${place.name}
                                        </strong>
                                        <br>
                                        
                                        <!-- Vicinity -->
                                        <span style="color: #555; font-size: 11px;">
                                            ${place.vicinity}
                                        </span>
                                        <br>
                                        
                                        <!-- Link -->
                                        <a href="https://www.google.com/maps/place/?q=place_id:${place.place_id}" 
                                           target="_blank" 
                                           style="color: #007bff; text-decoration: none; font-size: 12px; margin-top: 5px;">
                                           View on Google Maps
                                        </a>
                                        
                                        <!-- Close Button -->
                                        <button onclick="this.parentElement.remove(); customCardElement = null;" 
                                                style="
                                                position: absolute; 
                                                top: 5px; 
                                                right: 5px; 
                                                width: 20px; 
                                                height: 20px; 
                                                background: none; 
                                                border: none; 
                                                color: #000; 
                                                font-size: 25px; 
                                                font-weight: 600;
                                                cursor: pointer; 
                                                line-height: 1;">
                                            &times;
                                        </button>
                                    </div>`;

                                // Position the card near the marker
                                const markerPosition = placeMarker.getPosition();
                                const projection = map.getProjection();
                                const markerPoint = projection.fromLatLngToPoint(markerPosition);
                                const container = document.querySelector('#map'); // Ensure your map container has an ID
                                const containerOffset = container.getBoundingClientRect();

                                // Convert map position to pixel position
                                const x = markerPoint.x * Math.pow(2, map.getZoom()) - containerOffset.left;
                                const y = markerPoint.y * Math.pow(2, map.getZoom()) - containerOffset.top;

                                // Set position
                                customCardElement.style.left = `${x}px`;
                                customCardElement.style.top = `${y}px`;

                                // Add to the map container
                                container.appendChild(customCardElement);
                            });

                            // Consistent hover effect for marker icons
                            placeMarker.addListener('mouseover', () => {
                                placeMarker.setIcon({
                                    url: 'https://example.com/images/hover_red_om_symbol.png', // Larger red Om symbol for hover
                                    scaledSize: new google.maps.Size(50, 50), // Larger size for hover
                                });
                            });

                            placeMarker.addListener('mouseout', () => {
                                placeMarker.setIcon({
                                    url: './assets/images/temple-icon.png', // Reset to default red Om symbol
                                    scaledSize: new google.maps.Size(40, 40),
                                });
                            });
                        });
                    } else {
                        locationInfoDiv.textContent += "No nearby temples found.";
                    }
                });
            } else {
                locationInfoDiv.textContent = "Unable to fetch your location. Please check the address.";
                //document.title = "Nearby Temples";
            }
        });
    }

    // Initialize the map on window load
    window.onload = initMap;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-RZCzEuy7JMyMu4ykftt5ooRcCeqhKY&libraries=places&callback=initMap"></script>
<?php include('./include/footer.php'); ?>