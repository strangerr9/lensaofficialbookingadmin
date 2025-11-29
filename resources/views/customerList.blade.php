<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      padding-top: 30px;
      /* Prevent content from hiding under navbar */
    }

    .nav-link {
      color: #adb5bd;
      font-size: 1.05rem;
      display: block;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
      border-radius: 8px;
      transition: all 0.2s;
      margin-top: 5%
    }

    .nav-link.active,
    .nav-link:hover {
      color: #fff;
      background: #027df8;
    }

    #calendar {
      max-width: 100%;
      margin: 20px auto;
      background: #fff;
      padding: 10px;
      border-radius: 8px;
      text-decoration: none !important;
    }



    /* Make FullCalendar header responsive */
    @media (max-width: 768px) {
      .fc-toolbar {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
      }

      .fc-left,
      .fc-center,
      .fc-right {
        float: none !important;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
      }

      .fc-button {
        font-size: 12px;
        /* smaller buttons */
        padding: 4px 6px;
        /* compact padding */
      }


    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
        ☰
      </button>
      <a class="navbar-brand" href="#">ADMIN LENSA</a>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu Properties</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled">
        <li><a href="{{ route('packages') }}" class="nav-link"><i class="bi bi-box"></i> Package</a></li>
        <li><a href="{{ route('calendar') }}" class="nav-link"><i class="bi bi-calendar-event"></i> Calendar</a></li>
        <li><a href="{{ route('customerList') }}" class="nav-link active"><i class="bi bi-people"></i> Customer List</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Customer List Table -->
  <div class="container mt-5">
    <div class="d-flex mb-3">
      <input type="text" id="searchInput" class="form-control me-2" placeholder="Search by bride, groom, or event code">
      <button id="searchBtn" class="btn btn-primary">Search</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Event Code</th>
            <th>Bride Name</th>
            <th>Groom Name</th>
            <th>Package</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="customerTable">
          @include('partials.customer-table', ['bookings' => $bookings])
        </tbody>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(function () {
      function runSearch() {
        const keyword = $("#searchInput").val();

        $.ajax({
          url: "{{ route('customer.search') }}",
          type: "GET",
          data: { search: keyword },
          success: function (html) {
            $("#customerTable").html(html);
          },
          error: function (xhr) {
            console.error('Search error:', xhr.status, xhr.responseText);
          }
        });
      }

      // 🔥 Live search on keyup (with small delay to avoid too many requests)
      let typingTimer;
      $("#searchInput").on("keyup", function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(runSearch, 300); // wait 300ms after typing stops
      });

      // Still keep the button if user prefers clicking
      $("#searchBtn").on("click", runSearch);
    });
  </script>


</body>

</html>