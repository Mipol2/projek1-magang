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
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
                <div class="mx-2">
                  <button class="btn btn-primary btn-create" data-toggle="modal" data-target="#createPesananModal">
                    <i class="me-2" data-feather="plus-circle"></i>Create Pesanan
                  </button>
                </div>
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
  <!-- Create Customer Modal -->
  <div class="modal fade" id="createPesananModal" tabindex="-1" role="dialog" aria-labelledby="createPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createPesananModalLabel">Create Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
          <form id="createPesananForm" action="{{ route('pesanans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="mb-3">
                <div class="form-group">
                  <label for="id_customer">Nama Customer</label>
                  <select name="id_customer" id="id_customer" class="form-select" autocomplete="off" required>
                      <option value="" selected disabled hidden>Select nama customer..</option>
                      @foreach ($customers as $customer)
                          <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
      
              <div class="mb-3">
                  <label for="id_barang">Nama Barang</label>
                  <select name="id_barang" id="id_barang" class="form-select" autocomplete="off" required onchange="updateHarga()">
                      <option value="" selected disabled hidden>Select barang..</option>
                      @foreach ($barangs as $barang)
                          <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_barang }}">{{ $barang->nama_barang }}</option>
                      @endforeach
                  </select>
              </div>
              
              <div class="mb-3">
                  <label for="harga_barang">Harga Barang</label>
                  <input type="number" name="harga_barang" id="harga_barang" class="form-control" readonly>
              </div>
              <div class="mb-3">
                  <label for="jumlah_barang">Jumlah</label>
                  <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" onchange="calculateTotal()"  onkeydown="return event.keyCode !== 69">
              </div>
              <div class="mb-3">
                  <label for="harga_total">Harga Total</label>
                  <input type="number" name="harga_total" id="harga_total" class="form-control" readonly>
              </div>

              <div class="text-center">
                  <button type="submit"  class="btn-block btn-primary">Submit</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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
<!-- Swal -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

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
<script>
    function updateHarga() {
        var selectElement = document.getElementById("id_barang");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var hargaBarang = selectedOption.getAttribute("data-harga");

        document.getElementById("harga_barang").value = hargaBarang;
    }

    function calculateTotal() {
    var idBarang = document.getElementById("id_barang").value;
    var jumlahBarang = document.getElementById("jumlah_barang").value;

    var selectedOption = document.querySelector('#id_barang option[value="' + idBarang + '"]');
    var hargaBarang = parseFloat(selectedOption.getAttribute("data-harga"));

    var hargaTotal = hargaBarang * jumlahBarang;
    document.getElementById("harga_total").value = hargaTotal;
}
</script>
c
<!-- Page specific script -->
<script>
  $(function () {
    // Create Pesanan form submit using AJAX
    $('#createPesananForm').submit(function (e) {
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var formData = new FormData(form[0]);

      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
          form.find('.is-invalid').removeClass('is-invalid');
          form.find('.invalid-feedback').text('');
        },
        success:function(response){
          //show success message
          Swal.fire({
              type: 'success',
              icon: 'success',
              title: `${response.message}`,
              showConfirmButton: false,
              timer: 3000
          }).then((result) => {
            if (result.dismiss == Swal.DismissReason.timer){
              window.location.href = "{{route('pesanans.index')}}";
            }
          });
        },
        error: function (xhr) {
          var errors = xhr.responseJSON.errors;
          $.each(errors, function (key, value) {
            $('#' + key).addClass('is-invalid');
            $('#' + key + 'Error').text(value[0]);
          });
        }
      });
    });
  });
</script>
</body>
</html>
