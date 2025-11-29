<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Sweet Alert cdn --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
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
  <nav class="navbar navbar-dark bg-dark">
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
            <form action="{{ route('viewDetails.updateDetails', $booking->id) }}" method="POST">
              @csrf
              @method('PATCH')
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
                    <td><input type="text" id="bride_name" name="bride_name" class="form-control"
                        value="{{ $booking->bride_name }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bride Phone</th>
                    <td><input type="number" id="bride_phone" name="bride_phone" class="form-control"
                        value="{{ $booking->bride_phone }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bride Email</th>
                    <td><input type="text" id="bride_emai" name="bride_email" class="form-control"
                        value="{{ $booking->bride_email }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Groom Name</th>
                    <td><input type="text" id="groom_name" name="groom_name" class="form-control"
                        value="{{ $booking->groom_name  }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Groom Phone</th>
                    <td><input type="number" id="groom_phone" name="groom_phone" class="form-control"
                        value="{{ $booking->groom_phone  }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Groom Email</th>
                    <td><input type="text" id="groom_email" name="groom_email" class="form-control"
                        value="{{ $booking->groom_email  }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Package</th>
                    <td>
                      <select id="package_id" name="package_id" class="form-control">
                        @foreach($packages as $package)
                          <option value="{{ $package->id }}" {{ $booking->package_id == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                          </option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Notes</th>
                    <td><input type="text" id="notes" name="notes" class="form-control"
                        value="{{ $booking->notes  }}"></td>
                  </tr>
                  <tr>
                    <th scope="row">Status</th>
                    <td>
                      <select id="status" name="status" class="form-control">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">T&C</th>
                    {{-- <td><input type="text" id="tnc  " name="tnc  " class="form-control"
                        value="{{ $booking->tnc  }}">
                    </td> --}}
                  </tr>
                  <tr>
                    <th scope="row">Created At</th>
                    <td>{{ $booking->created_at }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Updated At</th>
                    <td>{{ $booking->updated_at }}</td>
                  </tr>


                  @foreach($booking->event_bookings as $event)
                  {{-- Sekadar nak fetch id dari database --}}
                  <input type="hidden" name="event_id[]" value="{{ $event->id }}"> 
                    {{-- Event details --}}
                    <tr class="table-primary">
                    <th colspan="2">Event {{ $loop->iteration }}</th>
                    </tr>
                    <tr>
                    <th scope="row">Event Type</th>
                    <td>
                      <input type="text" name="event_type[]" class="form-control" value="{{ $event->event_type }}">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">Event Date</th>
                    <td>
                      <input type="date" name="event_date[]" class="form-control" value="{{ $event->event_date }}">
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">Venue Type</th>
                    <td>
                      <select name="venue_type[]" class="form-control">
                      <option value="Hall" {{ $event->venue_type == 'Hall' ? 'selected' : '' }}>Hall</option>
                      <option value="House" {{ $event->venue_type == 'House' ? 'selected' : '' }}>House</option>
                      </select>
                    </td>
                    </tr>
                    <tr>
                    <th>Venue Address</th>
                    <td>
                      <input type="text" name="venue_address[]" class="form-control"
                      value="{{ $event->venue_address }}">
                    </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- Buttons pinned to bottom -->
              <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>