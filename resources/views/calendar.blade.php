<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- Sweet Alert cdn --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet"
    integrity="sha384-NlsxdkweGA8nr9s0TVc3Qu2zqhWMNsHrvzMpAjVR0yDqXgC2z+RWYoeCNG2uO2MC" crossorigin="anonymous">

  <!-- FullCalendar -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>

    body {
      padding-top: 30px; /* Prevent content from hiding under navbar */
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


  <!-- Navbar with Sidebar Toggle -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
        aria-controls="sidebar">
        ☰
      </button>
      <a class="navbar-brand" href="#">ADMIN LENSA</a>
    </div>
  </nav>

  <!-- Sidebar (Bootstrap Offcanvas) -->
  <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu Properties</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled">
        <li class="nav-item">
          <a href="{{ route('packages') }}" class="nav-link "><i class="bi bi-box"></i> <span>Package</span></a>
        </li>
        <li>
          <a href="{{ route('calendar') }}" class="nav-link active"><i class="bi bi-calendar-event"></i>
            <span>Calendar</span></a>
        </li>
        <li>
          <a href="{{ route('customerList') }}" class="nav-link"><i class="bi bi-people"></i> <span>Customer
              List</span></a>
        </li>
      </ul>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="text-center mt-5">BOOKING CALENDAR</h3>
        <div class="col-md-11">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <!-- Main content -->
  <div class="content">
    {{-- <h2>Welcome to Admin Dashboard</h2>
    <p>Click the sidebar items to explore different sections.</p> --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Default Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <p><strong>Event Code:</strong> <span id="event_code"></span></p>
            <p><strong>Event Title:</strong> <span id="eventTitle"></span></p>
            <p><strong>Event Venue:</strong> <span id="eventVenue"></span></p>
            <p><strong>Event Date:</strong> <span id="eventDate"></span></p>
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="viewDetailsBtn" class="btn btn-primary">VIEW DETAILS</button>


          </div>

        </div>
      </div>
    </div>


    <!-- Bootstrap + Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.getElementById("toggleBtn").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("collapsed");
      });
    </script>


    <script>
      $(document).ready(function () {
        // Attach CSRF token to all AJAX requests (needed for Laravel)
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        // Get events from Laravel (passed via controller)
        var booking = @json($events);


        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',  // ✅ month view
          headerToolbar: {
            left: 'title',

            right: 'prev,next today,dayGridMonth,timeGridWeek,timeGridDay' // ✅ Month / Week / Day buttons
          },

          selectable: true,             // ✅ allow selecting
          editable: true,               // ✅ drag and drop
          events: booking,  // Load events from Laravel
          eventClick: function (info) {
            // info → the parameter name you chose for the callback function (you could name it anything). event → not chosen by you. This is a fixed property name inside the info object that FullCalendar gives you.
            var id = info.event.id;
            var event_code = info.event.extendedProps.event_code;
            var title = info.event.title;
            var start = info.event.start;
            var venue = info.event.extendedProps.venue;
            var bookings_id = info.event.extendedProps.bookings_id;

            console.log("Event ID:", id);
            console.log("Event Event_code:", event_code);
            console.log("Event Title:", title);
            console.log("Event venue:", venue);
            console.log("Event Date:", start);
            console.log("Event bookings_id:", bookings_id);

            // Insert values into modal
            document.getElementById('event_code').textContent = event_code;
            document.getElementById('eventTitle').textContent = title;
            document.getElementById('eventVenue').textContent = venue;
            document.getElementById('eventDate').textContent = start.toLocaleString(); // format date

            // 🔑 Hook the button click (always override when modal opens)
            let viewBtn = document.getElementById('viewDetailsBtn');
            viewBtn.onclick = function () {
              // If you want by numeric id:
              window.location.href = "/calendar/viewDetails/" + bookings_id;

              // OR if you want by event_code instead:
              // window.location.href = "/calendar/viewDetails/" + event_code;
            };

            // Open Bootstrap modal
            var myModal = new bootstrap.Modal(document.getElementById('termsModal'));
            myModal.show();
          },

          eventDrop: function (info) {
            // Basic sanity log — if you don't see this, eventDrop isn't firing
            console.log('eventDrop fired:', info);

            var id = info.event.id;

            // info.event.start is a JS Date or null (for allDay drags it’s still a Date)
            var start = info.event.start;

            // Format to "YYYY-MM-DD HH:mm:ss" without Moment
            function formatDateTime(d) {
              const pad = n => String(n).padStart(2, '0');
              return (
                d.getFullYear() + '-' +
                pad(d.getMonth() + 1) + '-' +
                pad(d.getDate()) + ' ' +
                pad(d.getHours()) + ':' +
                pad(d.getMinutes()) + ':' +
                pad(d.getSeconds())
              );
            }

            var event_date = formatDateTime(start);

            $.ajax({
              url: "/calendar/update/" + id,          // matches Route::patch('/calendar/update/{id}')
              type: "PATCH",
              dataType: "json",
              data: { event_date: event_date },       // matches $request->event_date
              success: function (response) {
                Swal.fire({
                  title: "UPDATED!",
                  icon: "success"
                });
              },
              error: function (xhr) {
                console.error(xhr.responseText || xhr.statusText);
                Swal.fire({
                  title: "Error",
                  text: "Could not update event",
                  icon: "error"
                });
                info.revert(); // rollback if server rejects
              }
            });
          }




        });



        calendar.render();
      });

      document.getElementById('viewDetailsBtn').addEventListener('click', function () {
        window.location.href = "/calendar/viewDetails/" + { id };
      });



    </script>

    @if(session('success'))
      <script>
        Swal.fire({
          title: "Deleted!",
          text: "{{ session('success') }}",
          icon: "success",
          confirmButtonColor: "#3085d6",
        });
      </script>
    @endif

</body>


</html>