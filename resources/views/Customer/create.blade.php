<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <h1 class="text-center">Create Customer</h1>
        <div class="container d-flex justify-content-center">
            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
    
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
    
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer ID:</label>
                    <input type="integer" name="customer_id" id="customer_id" class="form-control">
                </div>
    
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" name="address" id="address" class="form-control h-100">
                </div>

                <div class="mb-3">
                    <label for="inputImage" class="form-label">Select Image:</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="inputImage"
                        class="form-control"
                    >
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="preview-image">Preview:</label>
                    <img id="preview-image-before-upload" src="{{asset('images/no-preview-available.png')}}"
                        alt="preview image" style="max-height: 250px;">
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
    </form>
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
</body>
</html>