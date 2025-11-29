<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-NlsxdkweGA8nr9s0TVc3Qu2zqhWMNsHrvzMpAjVR0yDqXgC2z+RWYoeCNG2uO2MC" crossorigin="anonymous">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        body {
            padding-top: 100px;
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

<body>
    <!-- Navbar with Sidebar Toggle -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
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
                    <a href="{{ route('packages') }}" class="nav-link active"><i class="bi bi-box"></i>
                        <span>Package</span></a>
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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


    <!-- Main content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Ticket</div>
                    <div class="card-body">
                        <form method="POST" action="save-package">
                            @csrf
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Package Name</th>
                                        <th scope="col">Short Code</th>
                                        <th scope="col">Events Included</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="name" class="form-control"
                                                placeholder="Package Name" required></td>
                                        <td><input type="text" name="short_code" class="form-control"
                                                placeholder="Short Code" required></td>

                                        <!-- Events Included (multiple inputs allowed) -->
                                        <td>
                                            <select name="events_included[]" class="form-control select2"
                                                multiple="multiple" required>
                                                <!-- initially empty, user can type or select -->
                                            </select>
                                        </td>


                                        <td><input type="number" step="0.01" name="price" class="form-control"
                                                placeholder="Price" required></td>
                                        <td><input type="text" name="description" class="form-control"
                                                placeholder="Description" required></td>
                                        <td>
                                            <button type="submit" class="btn btn-success">Create</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
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
            $('.select2').select2({
                tags: true, // allow typing custom event names
                tokenSeparators: [',']
            });
        });
    </script>


</body>

</html>