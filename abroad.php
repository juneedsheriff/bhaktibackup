<?php
include('./include/header.php');
error_reporting(0);
?>
<style>
    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<!-- end /. header -->
<div class="col-lg-3 col-md-4 col-mg-3 d-xl-none gap-3 gap-md-2 hstack justify-content-center">
    <a href="#" class="sidebarCollapse align-items-center d-flex justify-content-center filters-text fw-semibold gap-2">
        <i class="fa-solid fa-arrow-up-short-wide fs-18"></i>
        <span>All filters</span>
    </a>
</div>
<div class="py-3 py-xl-5 bg-gradient">
    <div class="container">
        <div class="row"> <!-- start sidebar filters -->
        <aside class="col-xl-3 filters-col content pe-lg-4 pe-xl-5 shadow-end ">
                <div class="sidebar-filters js-sidebar-filters-mobile">
                    <!-- filter header -->
                    <div class="border-bottom d-flex justify-content-between align-items-center p-3 sidebar-filters-header d-xl-none">
                        <div class="align-items-center btn-icon d-flex filter-close justify-content-center rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewbox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"></path>
                            </svg>
                        </div>
                        <!-- <span class="fs-3 fw-semibold">Filters</span> -->
                        <span class="text-primary fw-medium" onclick="clearPage()">Clear</span>
                    </div>
                    <!-- end /. filter header -->
                    <div class="sidebar-filters-body p-3 p-xl-4">
                        <div class="mb-4 border-bottom pb-4">
                            <div class="mb-3">
                                <h4 class="fs-5 fw-semibold mb-1">Country</h4>
                            </div>
                            <?php

                            ?>
                            <!-- Start Select2 -->
                            <select class="form-select mb-3" name="country" id="country">
                                <option selected disabled>Select Country</option>
                                <?php

                                if (isset($country_code)) {
                                    // Make sure to use single quotes around the variable in the SQL query
                                    $Vselect = "SELECT * FROM country WHERE country_code = '$country_code' ORDER BY country_name";
                                    $VSQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $Vselect);
                                } else {
                                    // Make sure to use single quotes around the variable in the SQL query
                                    $Vselect = "SELECT * FROM country  ORDER BY country_name";
                                    $VSQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $Vselect);
                                }
                                // Default country code


                                while ($VRow = mysqli_fetch_object($VSQL_STATEMENT)) { ?>
                                    <option value='<?php echo $VRow->country_code; ?>'><?php echo $VRow->country_name; ?></option>
                                <?php } ?>
                            </select>

                            <!-- /.End Select2 -->
                        </div>
                        <div class="mb-4 border-bottom pb-4">
                            <div class="mb-3">
                                <h4 class="fs-5 fw-semibold mb-1">State</h4>
                            </div>
                            <!-- Start Select2 -->
                            <select class="form-select mb-3" name="state" id="state">
                                <option selected disabled>Select State</option>

                            </select>
                            <!-- /.End Select2 -->
                        </div>
                        <div class="mb-4 border-bottom pb-4">
                            <div class="mb-3">
                                <h4 class="fs-5 fw-semibold mb-1">City</h4>
                            </div>
                            <!-- Start Select2 -->
                            <select class="form-select" aria-label="Default select example" name="city" id="city">
                                <option selected disabled>Select City</option>

                            </select>
                            <!-- /.End Select2 -->
                        </div>
                        <div class="mb-4 border-bottom pb-4">
                            <div class="mb-3">
                                <h4 class="fs-5 fw-semibold mb-2">Filter by God Name</h4>
                            </div>
                            <!-- Start Form Check -->
                            <!-- Start Form Check -->
                            <?php
                // Fetch all relevant god IDs from the abroad table
                $selectIndexIds = "SELECT DISTINCT god_id FROM abroad";
                $indexResult = mysqli_query($DatabaseCo->dbLink, $selectIndexIds);

                // Array to collect god IDs
                $godIds = [];

                if (mysqli_num_rows($indexResult) > 0) {
                    // Collect all god_ids from the result
                    while ($indexRow = mysqli_fetch_assoc($indexResult)) {
                        $godIds[] = $indexRow['god_id'];
                    }

                    // Check if there are valid god IDs
                    if (!empty($godIds)) {
                        // Convert array of god IDs into a comma-separated list
                        $godIdList = implode(',', $godIds);

                        // Fetch all god details in alphabetical order by god_name
                        $selectGod = "SELECT DISTINCT * FROM god WHERE index_id IN ($godIdList) ORDER BY god_name ASC";
                        $godResult = mysqli_query($DatabaseCo->dbLink, $selectGod);

                        // Check if there are results
                        if (mysqli_num_rows($godResult) > 0) {
                            while ($godRow = mysqli_fetch_assoc($godResult)) {
                                $god_name = htmlspecialchars($godRow['god_name'], ENT_QUOTES, 'UTF-8'); // Secure output
                                $index_id = $godRow['index_id'];
                ?>
                                <!-- Start Form Check -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="<?php echo $index_id; ?>" id="god<?php echo $index_id; ?>">
                                    <label class="form-check-label" for="god<?php echo $index_id; ?>">
                                        <?php echo $god_name; ?>
                                    </label>
                                </div>
                                <!-- End Form Check -->
                <?php
                            }
                        } else {
                            echo "<p class='text-center'>No gods found for the provided index IDs.</p>";
                        }
                    } else {
                        echo "<p class='text-center'>No valid god IDs found in the abroad table.</p>";
                    }
                } else {
                    echo "<p class='text-center'>No records found in the abroad table.</p>";
                }
                ?>


                        </div>

                        <!-- start apply button -->
                        <!-- <button type="button" class="btn btn-primary w-100">Apply filters</button> -->
                        <!-- end /. apply button -->
                        <!-- start clear filters -->
                        <a href="abroad.php" class="align-items-center d-flex fw-medium gap-2 justify-content-center mt-2 small text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewbox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                            </svg>
                            Clear filters
                        </a>
                        <!-- end /. clear filters -->
                    </div>
                </div>
</aside>
            <!-- end /. sidebar filters -->
            <!-- start items content -->
            <div class="col-xl-9 ps-lg-4 ps-xl-5 sidebar">
                <div class="d-flex flex-wrap align-items-center mb-3 gap-2">
                    <div class="fs-1 font-caveat page-header-title fw-semibold m-2 pb-3  text-primary">Temples in Abroad</div>
                    <!-- start button group -->
                    <!-- end /. button group -->
                </div>
                <div id="viewmore" class="listings grid-view">
                    <?php
                    $total_result = mysqli_query($DatabaseCo->dbLink, "SELECT COUNT(*) AS total FROM abroad");
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_records = $total_row['total'];
                    
                    $select = "SELECT * FROM abroad WHERE status='approved' ORDER BY order_by ASC  LIMIT 0, 9";
                    $SQL_STATEMENT = mysqli_query($DatabaseCo->dbLink, $select);

                    // Check if records are available
                    if (mysqli_num_rows($SQL_STATEMENT) > 0) {
                        while ($Row = mysqli_fetch_assoc($SQL_STATEMENT)) {
                            $photos = $Row['photos'];                            
                            $ccc = $DatabaseCo->dbLink->query("SELECT city_name FROM `city` WHERE city_id='".$Row['city']."'");
                            $cff = mysqli_fetch_array($ccc);
                            $sss = $DatabaseCo->dbLink->query("SELECT state_name FROM `state` WHERE state_code='".$Row['state']."' AND country_code='".$Row['country']."'");
                            $fff = mysqli_fetch_array($sss);
                        ?>
                            <div class="listing">
                                <a href="abroad-details.php?id=<?php echo $Row['index_id']; ?>" target="_blank">
                                    <a href="abroad-details.php?id=<?php echo $Row['index_id']; ?>" target="_blank">
                                        <img src="app/uploads/abroad/<?php echo $photos; ?>" alt="">
                                    </a>
                                    <div class="listing-details">
                                        <a href="abroad-details.php?id=<?php echo $Row['index_id']; ?>" target="_blank">
                                        <div class="listing-title"><?php echo $Row['title']; echo $cff['city_name']!=''?', ':'' ; echo $cff['city_name']; echo  $fff['state_name']!=''?', ':'' ; echo $fff['state_name']; ?></div>
                                       </a>
                                        <div class="listing-rating text-dark"><a href="abroad-details.php?id=<?php echo $Row['index_id']; ?>" target="_blank">Read more</a></div>
                                    </div>
                            </div>
                            <!-- Repeat for additional listings -->
                        <?php

                        }
                    } else {

                        ?>
                    <?php
                        echo "";
                    }
                    ?>
                </div>
                 <?php if($total_records>9){?>
                <div class="show_more_main m-3" id="show_more_main1" align="center">
        <span id="getID" data-id="1" data-category="<?php echo "abroad";?>" class="show_more btn btn-primary btn-lg" title="Load more Images">Load More</span>
        <span class="loding btn btn-info btn-lg text-white" style="display: none;"><span class="loding_txt">Loading...</span></span>
    </div><?php }?>
                <div class="row">
                    <div class="col-lg-12 mt--60">
                        <nav class="custom-pagination mt-5" aria-label="Page navigation">
                            <!-- Previous Button -->
                            <?php if ($page > 1) { ?>
                                <a class="prev page-numbers" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                    Previous
                                </a>
                            <?php } ?>

                            <!-- Page Numbers -->
                            <div class="page-links">
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <a href="?page=<?php echo $i; ?>"
                                        class="page-numbers <?php echo ($i == $page) ? 'current' : ''; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php } ?>
                            </div>

                            <!-- Next Button -->
                            <?php if ($page < $total_pages) { ?>
                                <a class="next page-numbers" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    Next
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                    </svg>
                                </a>
                            <?php } ?>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- end /. items content -->
        </div>
    </div>
</div>
<?php include_once './include/footer.php' ?>
<script>
    
$(document).on('click', '.show_more', function () {
    var button = $(this);
    var ID = $('#getID').data('id');//alert(ID);
    var newID = parseInt(ID) + 1;
    var category = button.data('category');//alert(category);
    $('.show_more').hide();
    $('.loding').show();
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: 'pageid=' + ID + '&type=' + category,
        success: function (html) {
            console.log(html);
            if (html != '') {
                $('#viewmore').append(html);
                $('#getID').attr('data-id', newID); 
                $('#getID').data('id', newID); 
                button.show(); 
                $('.loding').hide();
            } else {
                button.hide();
                $('.loding').hide();
            }
        }
    });
});
    $('#country').change(function() {
        let countryCode = $(this).val();
        $.ajax({
            url: './app/get_states.php',
            type: 'POST',
            data: { country_code: countryCode },
            success: function(response) {
                $('#state').html(response);
                $('#city').html('<option selected disabled>Select City</option>'); // Reset city dropdown
                fetchListingsByCountry(); // Fetch listings based on country filter
            }
        });
    });

    // Function to fetch cities based on selected state
    $('#state').change(function() {
        let stateCode = $(this).val();
        $.ajax({
            url: './app/get_cities.php',
            type: 'POST',
            data: { state_code: stateCode },
            success: function(response) {
                $('#city').html(response);
                fetchListingsByCountry(); // Fetch listings based on state filter
            }
        });
    });

    // Fetch listings based on selected country, state, and city filters
    function fetchListingsByCountry() {
        let country = $('#country').val();
        let state = $('#state').val();
        let city = $('#city').val();
        let filterType = $('input[name="filter_type"]:checked').val(); // Selected filter type
        $('.form-check-input').each(function() {
			this.checked = false;
		});

        $.ajax({
            url: 'fetch_listings_3.php',
            type: 'POST',
            data: { country: country, state: state, city: city, filter_type: filterType },
            success: function(data) {
                $('#viewmore').html(data); // Update listings container
            },
            error: function(xhr, status, error) {
                console.error("Error fetching listings:", error);
                $('#viewmore').html("<p>An error occurred while fetching listings.</p>");
            }
        });
    }

    // Fetch listings based on selected filters (checkboxes) and pagination
    function fetchListings(page = 1) {
        $("#country").prop("selectedIndex", 0).val();
        $("#state").html("<option value=''>Select State</option>");
        $('#city').html("<option value=''>Select City</option>");
        let selectedFilters = [];
        document.querySelectorAll('.form-check-input:checked').forEach(checkbox => {
            selectedFilters.push(checkbox.value);
        });

        const params = new URLSearchParams();
        params.append('page', page);

        if (selectedFilters.length > 0) {
            params.append('selectedFilters_abroad', selectedFilters.join(','));
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_listings.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('viewmore').innerHTML = response.listings;
                document.getElementById('paginationControls').innerHTML = response.pagination;
            }
        };
        xhr.send(params.toString());
    }

    // Event listener for checkboxes to fetch listings on change
    document.querySelectorAll('.form-check-input').forEach(checkbox => {
        checkbox.addEventListener('change', () => fetchListings());
    });

    // Initial fetch for page load
    fetchListings();

    // Clear page and reload function
    function clearPage() {
        location.reload();
    }

    // Trigger fetchListingsByCountry on filter change (country, state, city, filter type)
    $('#country, #state, #city').change(fetchListingsByCountry);
    $('input[name="filter_type"]').change(fetchListingsByCountry);
</script>
