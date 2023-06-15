<!DOCTYPE html>
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
            </div>
        </div>
        <table id="customer-table" class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Customer ID</th>
                    <th>Address</th>
                    <th>Avatar</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <a class="btn btn-primary btn-create" href="{{ route('report.download') }}">
                <i class="me-2" data-feather="plus-circle"></i>
                Download PDF
            </a>
        </div>
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
</html>
