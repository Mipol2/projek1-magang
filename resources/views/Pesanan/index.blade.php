<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    
    <title>Pesanan</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center">Pesanan</h1>
                <div class="text-center">
                    <a class="btn btn-primary btn-create" href="{{ route('pesanans.create') }}">
                        <i class="me-2" data-feather="plus-circle"></i>Create pesanan
                    </a>
                </div>
            </div>
        </div>
    <table id="pesanan-table" class="table table-dark table-striped">
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
                        <ul class="action">
                            <li class="edit">
                                <a href="{{ route('pesanans.edit', $pesanan) }}">edit</a>
                            </li>
                        </ul>
                        <ul class="action">
                            <li class="show">
                                <a href="{{ route('pesanans.show', $pesanan) }}">show</a>
                            </li>
                        </ul>
                        <ul class="action">
                            <li class="delete">
                                <a href="{{ route('pesanans.destroy', $pesanan) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $pesanan->id }}').submit();">delete</a>
                                <form id="delete-form-{{ $pesanan->id }}" action="{{ route('pesanans.destroy', $pesanan) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>