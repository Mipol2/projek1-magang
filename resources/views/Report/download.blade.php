<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
	<table class='table table-bordered'>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-6">
					<h1 class="text-center">Customers</h1>
				</div>
			</div>
			<table id="customer-table">
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
		</div>
 
</body>
</html>