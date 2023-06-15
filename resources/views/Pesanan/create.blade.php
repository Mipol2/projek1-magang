<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
    <form action="{{ route('pesanans.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="id_customer">ID Customer</label>
        <select name="id_customer" id="id_customer" class="form-select" autocomplete="off" required>
            <option value="" selected disabled hidden>Select id customer..</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <label for="id_barang">Nama Barang</label>
        <select name="id_barang" id="id_barang" class="form-select" autocomplete="off" required onchange="updateHarga()">
            <option value="" selected disabled hidden>Select barang..</option>
            @foreach ($barangs as $barang)
                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_barang }}">{{ $barang->nama_barang }}</option>
            @endforeach
        </select>
        
        <label for="harga_barang">Harga Barang</label>
        <input type="number" name="harga_barang" id="harga_barang" readonly>

        <label for="jumlah_barang">Jumlah</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang" onchange="calculateTotal()"  onkeydown="return event.keyCode !== 69">

        <label for="harga_total">Harga Total</label>
        <input type="number" name="harga_total" id="harga_total" readonly>

        <button type="submit">Submit</button>
    </form>

    
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
</body>
</html>