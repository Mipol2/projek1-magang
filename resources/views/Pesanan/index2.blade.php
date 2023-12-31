{{-- <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        .btn-create {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        td{
            text-align: center;
        }
        th{
            text-align: center;
        }
    </style>
</head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center">Customers</h1>
                <div class="text-center">

                </div>
            </div>
        </div>
        @if(request()->has('view_deleted'))
        <a href="{{ route('customers.index') }}" class="btn btn-info">View All Users</a>
        <a href="{{ route('customers.restore.all') }}" class="btn btn-success">Restore All</a>
        @else
        <a class="btn btn-primary btn-create" href="{{ route('customers.create') }}">
            <i class="me-2" data-feather="plus-circle"></i>Create Customer
        </a>
        <a href="{{ route('customers.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Deleted Records</a>
        @endif
        <table id="customer-table" class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Customer ID</th>
                    <th>Address</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @if ($customer->avatar)
                                <img src="{{ asset('images/' . $customer->avatar) }}" alt="Avatar" style="width: 100px;">
                            @else
                                No Avatar
                            @endif
                        </td>
                        <td>
                            <ul class="action">
                                <li class="edit">
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">edit</a>
                                </li>
                            </ul>
                            <ul class="action">
                                <li class="show">
                                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-primary">show</a>
                                </li>
                            </ul>
                            <ul class="action">
                                <li>
                                    @if(request()->has('view_deleted'))
                                        <div>
                                            <a href="{{ route('customers.restore', $customer->id) }}" class="btn btn-success">Restore</a>
                                        </div>
                                        <br>
                                        <div>
                                            <a href="{{ route('customers.forceDelete', $customer->id) }}" class="btn btn-danger">Force Delete</a>
                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                        </form>
                                    @endif
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({
                "order": [[ 1, "asc" ]] // Sort by second column (index 1) in ascending order
            });
        });
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">TeuingNaonLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{route('welcome')}}" class="nav-link">
            <i class="fas fa-th-large nav-icon"></i>
              <p>Dashboard</p>
          </a>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Monitor
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->hasRole('super-admin'))
              <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{route('pesanans.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              @if (Auth::user()->hasRole('super-admin'))
              <li class="nav-item">
                <a href="{{route('report.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report</p>
                </a>
              </li>
              @endif
            </ul>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
   <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Data pesanan TeuingNaon</h3>
              <a class="btn btn-primary btn-create" href="{{ route('pesanans.create') }}">
                <i class="me-2" data-feather="plus-circle"></i>Create Pesanan
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Nama Customer</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->id_customer }}</td>
                        <td>{{ $pesanan->customer->name }}</td>
                        <td>{{ $pesanan->barang->nama_barang }}</td>
                        <td>{{ $pesanan->jumlah_barang }}</td>
                        <td>{{ 'Rp' . number_format($pesanan->harga_total, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="mx-2">
                                    <a href="{{ route('pesanans.edit', $pesanan) }}" type="button" class="btn btn-primary" style="width: 75px">edit</a>
                                </div>
                           
                                <div class="mx-2">
                                    <a href="{{ route('pesanans.show', $pesanan) }}" type="button" class="btn btn-success" style="width: 75px">show</a>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('pesanans.destroy', $pesanan) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $pesanan->id }}').submit();" type="button" class="btn btn-danger" style="width: 75px">delete</a>
                                    <form id="delete-form-{{ $pesanan->id }}" action="{{ route('pesanans.destroy', $pesanan) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                </div>
                            </div>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('template/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('template/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('template/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.min.js')}}"></script>
{{-- <!-- AdminLTE for demo purposes -->
<script src="{{asset('template/dist/js/demo.js')}}"></script> --}}
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
