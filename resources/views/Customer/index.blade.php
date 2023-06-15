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
</html>
