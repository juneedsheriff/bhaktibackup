<?php
// DB CONNECTION (adjust if needed)
include_once './app/class/XssClean.php';



include_once './app/class/databaseConn.php';



include_once './app/lib/requestHandler.php';







$DatabaseCo = new DatabaseConn();



$xssClean = new xssClean();

include('./include/header.php');
?>


<style>
  .dataTables_filter{
    text-align:right;
  }
  .dataTables_paginate .pagination{
    float:right;
  }
/* ===== DEVOTIONAL CARD UI ===== */
div.dataTables_wrapper div.dataTables_info {
    padding-top: 20px;
    padding-bottom: 20px;
}
div.dataTables_wrapper div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: right;
    padding-top: 20px;
}
.darshan-card{
    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:all .3s ease;
}
.darshan-card:hover{
    transform:translateY(-5px);
}

.darshan-thumb{
    width:100%;
    height:200px;
    object-fit:cover;
}

.status-badge{
    position:absolute;
    top:12px;
    left:12px;
    padding:5px 12px;
    font-size:12px;
    font-weight:600;
    border-radius:20px;
    color:#fff;
}

.status-live{
    background:#dc3545;
    animation:pulse 1.5s infinite;
}

.status-offline{
    background:#6c757d;
}

@keyframes pulse{
    0%{box-shadow:0 0 0 0 rgba(220,53,69,.7);}
    70%{box-shadow:0 0 0 12px rgba(220,53,69,0);}
    100%{box-shadow:0 0 0 0 rgba(220,53,69,0);}
}

.watch-btn{
    border-radius:20px;
    padding:6px 18px;
}
</style>
</head>

<body>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">🔴 Live Darshan</h1>
        <p class="text-muted">
            Experience divine blessings from sacred temples across India
        </p>
    </div>

<?php
$query = "SELECT * FROM live_darshan ORDER BY temple_name ASC";
$result = mysqli_query($DatabaseCo->dbLink, $query);
?>

<!-- HIDDEN TABLE (FOR DATATABLE SEARCH + PAGINATION) -->
<table id="darshanTable" class="table d-none">
<thead>
<tr>
    <th>Temple</th>
    <th>God</th>
    <th>Location</th>
</tr>
</thead>
<tbody>
<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr data-row='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, "UTF-8"); ?>'>
    <td><?= $row['temple_name']; ?></td>
    <td><?= $row['god_name']; ?></td>
    <td><?= $row['location']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<!-- CARD VIEW -->
<div class="row" id="darshanCards"></div>

</div>

<!-- VIDEO MODAL -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <iframe id="videoFrame" width="100%" height="450"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<?php 
include('./include/footer.php');
?>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
let table = $('#darshanTable').DataTable({
    pageLength: 6,
    lengthChange: false,
    ordering: false,
    searching: true,
    language:{
        search: "🔍 Search Temple / God"
    }
});

/* Render cards on pagination/search */
table.on('draw', function(){
    renderCards();
});
renderCards();

function renderCards(){
    let html = '';
    let rows = table.rows({ page:'current' }).nodes();

    $(rows).each(function(){
        let data = JSON.parse($(this).attr('data-row'));

        let statusClass = data.status === 'Live'
            ? 'status-live'
            : 'status-offline';

        let embedUrl = data.live_url.replace('watch?v=', 'embed/');

        html += `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="darshan-card position-relative h-100">

                <span class="status-badge ${statusClass}">
                    ${data.status}
                </span>

                <img src="${data.thumbnail || 'assets/images/default-image.png'}"
                     class="darshan-thumb"
                     onerror="this.src='assets/images/default-image.png'">

                <div class="p-3 text-center">
                    <h6 class="fw-bold">${data.temple_name}</h6>
                    <p class="text-muted mb-1">${data.god_name}</p>
                    <small>${data.location}</small>

                    <div class="small text-success mt-1">
                        🕒 ${data.stream_start ?? '24x7'}
                        ${data.stream_end ? ' - ' + data.stream_end : ''}
                    </div>

                    <button class="btn btn-danger btn-sm mt-3 watch-btn"
                        onclick="playVideo('${embedUrl}')"
                        ${data.status === 'Offline' ? 'disabled' : ''}>
                        ▶ Watch Live
                    </button>
                </div>

            </div>
        </div>`;
    });

    $('#darshanCards').html(html);
}

/* Video Controls */
function playVideo(url){
    $('#videoFrame').attr('src', url + '?autoplay=1');
    $('#videoModal').modal('show');
}

$('#videoModal').on('hidden.bs.modal', function(){
    $('#videoFrame').attr('src','');
});
</script>
