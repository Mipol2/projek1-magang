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
    <h1 class="text-center">Edit Customer</h1>
    <div class="container d-flex justify-content-center">
        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}">
            </div>

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID:</label>
                <input type="integer" name="customer_id" id="customer_id" class="form-control" value="{{ $customer->customer_id }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" id="address" class="form-control h-100" value="{{ $customer->address }}">
            </div>

            <div class="mb-3">
                <label for="currentImage" class="form-label">Current Image:</label>
                <img  class="form-control" src="{{ asset('images/' . $customer->avatar) }}" alt="Avatar" style="width: 100px;">
            </div>

            <div class="mb-3">
                <label for="inputImage" class="form-label">Select Image:</label>
                <input 
                    type="file" 
                    name="image" 
                    id="inputImage"
                    class="form-control @error('avatar') is-invalid @enderror"
                >
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
