<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show</title>
</head>
<body>
    <form action="{{ route('customers.destroy', $customer) }}" method="DELETE">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $customer->name }}" disabled>

        <label for="customer_id">Customer ID</label>
        <input type="integer" name="customer_id" id="customer_id" value="{{ $customer->customer_id }}" disabled>


        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="{{ $customer->address }}" disabled>


        <label for="avatar">Avatar</label>
        <input type="text" name="avatar" id="avatar" value="{{ $customer->avatar }}" disabled>

        <button type="submit">Delete</button>
    </form>
</body>
</html>