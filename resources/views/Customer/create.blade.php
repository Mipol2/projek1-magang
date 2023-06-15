<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">

        <label for="customer_id">Customer ID</label>
        <input type="number" name="customer_id" id="customer_id" onkeydown="return event.keyCode !== 69">

        <label for="address">Address</label>
        <input type="text" name="address" id="address">

        <label for="avatar">Avatar</label>
        <input type="text" name="avatar" id="avatar">

        <button type="submit">Submit</button>
    </form>
</body>
</html>