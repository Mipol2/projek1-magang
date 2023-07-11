<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | DataTables</title>
      
        <!-- Google Font: Source Sans Pro -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
              <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('pesanans.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report</p>
                </a>
              </li>
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
                <h1>Edit Pesanan</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Edit Pesanan</li>
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
                      <h3 class="card-title">Edit Pesanan</h3>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <form id="form-update" action="{{ route('pesanans.update', $pesanan) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                
                            <div class="mb-3">
                                <label for="id_customer" class="form-label">Nama Customer:</label>
                                <select name="id_customer" id="id_customer" class="form-select form-control" autocomplete="off" required>
                                    <option value="" selected disabled hidden>Select nama customer..</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $pesanan->id_customer == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">nama barang:</label>
                                <select name="id_barang" id="id_barang" class="form-select form-control" autocomplete="off" required onchange="updateHarga()">
                                    <option value="" selected disabled hidden>Select barang..</option>
                                    @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_barang }}" {{ $pesanan->id_barang == $barang->id ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div>
                                <label for="harga_barang">Harga Barang:</label>
                                <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="{{ $pesanan->barang->harga_barang }}" onchange="calculateTotal()" readonly>
                            </div>
                
                            <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">jumlah barang:</label>
                                <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" value="{{ $pesanan->jumlah_barang }}" onchange="calculateTotal()"  onkeydown="return event.keyCode !== 69">
                            </div>
                
                
                            <div class="mb-3">
                                <label for="harga_total">Harga Total:</label>
                                <input type="number" name="harga_total" id="harga_total" class="form-control"  value="{{ $pesanan->harga_total }}" readonly>
                            </div>
                
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('#inputImage').change(function(){
                    let reader = new FileReader();
            
                    reader.onload = (e) => { 
                        $('#preview-image-before-upload').attr('src', e.target.result); 
                    }
            
                    reader.readAsDataURL(this.files[0]); 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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

<!-- AdminLTE for demo purposes -->
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
  $(document).ready(function() {
      $('#form-update').submit(function(event) {
          event.preventDefault();

          var formData = $(this).serialize();

          if (formData.length > 0) {
              $('#form-update :input').removeClass('is-invalid');
              $('#form-update :input').addClass('is-valid');

              // Hapus pesan kesalahan
              $('#form-update :input').parent().next('.invalid-feedback').hide();

              let isFormValid = false;
          }

          $.ajax({
              url: $(this).attr('action'),
              type: $(this).attr('method'),
              data: formData,
              dataType: 'json',
              success: function(response) {
                  console.log(response);
                  var message = response.message;

                  if (response.success) {
                      Swal.fire({
                          html: '<strong>' + message + '</strong>',
                          icon: 'success',
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 1100
                      }).then((result) => {
                          if (result.dismiss === Swal.DismissReason.timer) {
                              window.location.href = "{{ route('pesanans.index') }}";
                          }
                      });
                  } else {
                      Swal.fire({
                          title: 'Error!',
                          html: '<strong>' + response.message + '</strong>',
                          icon: 'error',
                          confirmButtonColor: '#534686'
                      });
                  }
              },
              error: function(error) {
                  console.log(error);
                  if (error['responseJSON']) {
                      if (error['responseJSON']['errors']) {

                          const errors = error['responseJSON']['errors'];
                          let index = 0;

                          // Hapus pesan kesalahan
                          for (const key in errors) {
                              $('#' + key.replace(/\./g, "\\.")).addClass('is-invalid');

                              if ($('#' + key.replace(/\./g, "\\.")).parent().next(
                                      '.invalid-feedback').length) {
                                  $('#' + key.replace(/\./g, "\\.")).parent().next(
                                      '.invalid-feedback').show().text(errors[key][0]);
                              } else {
                                  $('#' + key.replace(/\./g, "\\.")).next(
                                      '.invalid-feedback').show().text(errors[key][0]);
                              }

                              if (index == 0) {
                                  $('#' + key.replace(/\./g, "\\.")).focus();
                              }

                              index++;
                          }
                      }
                  }
              }
          })
      })
  });
</script>

</body>
</html>
