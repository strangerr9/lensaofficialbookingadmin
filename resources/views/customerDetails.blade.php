<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



  <style>
    body {
      padding-top: 60px;
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
  </style>
</head>

<body class="bg-light">

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
          <a href="{{ route('calendar') }}" class="nav-link"><i class="bi bi-calendar-event"></i>
            <span>Calendar</span></a>
        </li>
        <li>
          <a href="{{ route('customerList') }}" class="nav-link"><i class="bi bi-people"></i> <span>Customer
              List</span></a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">

  </div>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <!-- Card -->
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Booking Details</h5>

          </div>
          {{-- Customer details --}}
          <div class="card-body">

            <table class="table table-striped table-hover">
              <tbody>
                <tr>
                  <th scope="row">ID</th>
                  <td> {{ $booking->id }}</td>
                </tr>
                <tr>
                  <th scope="row">Booking Code</th>
                  <td>{{ $booking->booking_code }}</td>
                </tr>
                <tr>
                  <th scope="row">Bride Name</th>
                  <td>{{ $booking->bride_name }}</td>
                </tr>
                <tr>
                  <th scope="row">Bride Phone</th>
                  <td>{{ $booking->bride_phone }}</td>
                </tr>
                <tr>
                  <th scope="row">Bride Email</th>
                  <td>{{ $booking->bride_email }}</td>
                </tr>
                <tr>
                  <th scope="row">Groom Name</th>
                  <td>{{ $booking->groom_name }}</td>
                </tr>
                <tr>
                  <th scope="row">Groom Phone</th>
                  <td>{{ $booking->groom_phone }}</td>
                </tr>
                <tr>
                  <th scope="row">Groom Email</th>
                  <td>{{ $booking->groom_email }}</td>
                </tr>
                <tr>
                  <th scope="row">Package</th>
                  <td>{{ $booking->package ? $booking->package->name : 'N/A' }}</td>
                </tr>
                <tr>
                  <th scope="row">Notes</th>
                  <td>{{ $booking->notes }}</td>
                </tr>
                <tr>
                  <th scope="row">Same Day</th>
                  <td>{{ $booking->same_day == 1 ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                  <td><span class="badge bg-success">{{ $booking->status }}</span></td>
                </tr>
                <tr>
                  <th scope="row">T&C</th>
                  <td>{{ $booking->tnc }}</td>
                </tr>
                <tr>
                  <th scope="row">Created At</th>
                  <td>{{ $booking->created_at }}</td>
                </tr>
                <tr>
                  <th scope="row">Updated At</th>
                  <td>{{ $booking->updated_at }}</td>
                </tr>
                {{-- Event details --}}
                @foreach($booking->event_bookings as $event)
                  <tr class="table-primary">
                    <th colspan="2">Event {{ $loop->iteration }}</th>
                  </tr>


                  <tr>
                    <th scope="row">Event Type</th>
                    <td>{{ $event->event_type }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Event Date</th>
                    <td>{{ $event->event_date }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Venue Type</th>
                    <td>{{ $event->venue_type }}</td>
                  </tr>
                  <tr>
                    <th>Venue Address</th>
                    <td>{{ $event->venue_address }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- Buttons pinned to bottom -->
            <div class="card-footer text-end">
              <a href="{{ route('viewDetails.editDetails', $booking->id) }}"
                class="btn btn-warning btn-sm me-2">Edit</a>
              <!-- Delete Button -->
              <form id="delete-form-{{ $booking->id }}" action="{{ route('viewDetails.deleteBooking', $booking->id) }}"
                method="POST" style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $booking->id }})">
                  Delete
                </button>
              </form>


            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-' + id).submit();
        }
      });
    }
  </script>

  @if(session('success'))
    <script>
      Swal.fire({
        title: "UPDATED!",
        text: "{{ session('success') }}",
        icon: "success",
        confirmButtonColor: "#3085d6",
      });
    </script>
  @endif
</body>

</html>