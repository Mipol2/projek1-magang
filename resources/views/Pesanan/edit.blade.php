<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">Edit pesanan</h1>
    <div class="container d-flex justify-content-center">
        <form action="{{ route('pesanans.update', $pesanan) }}" method="POST" enctype="multipart/form-data">
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
        </form>
    </div>
    <script>
function updateHarga() {
    var selectElement = document.getElementById("id_barang");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var hargaBarang = selectedOption.getAttribute("data-harga");

    document.getElementById("harga_barang").value = hargaBarang;
    
    calculateTotal(); // Call calculateTotal() after updating harga_barang
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
</body>
</html>
