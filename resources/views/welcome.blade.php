<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initialscale=1.0">
 <title>Welcome</title>
 <script src="js/app.js"></script>
 @vite('resources/sass/app.scss')
</head>

<body>
    <div class="container text-center my-5">
        <h1 class="mb-4">Belajar Controller & View pada Laravel</h1>
        {{-- Contoh cara mereferensikan gambar di dalam file blade dengan
        menggunakan pendekatan Vite --}}
        <img class="img-thumbnail" width="300" src="{{
        Vite::asset('resources/images/sukamse.jpg') }}" alt="image">
        <div class="col-md-2 offset-md-5 mt-4">
        <div class="d-grid gap-2">
        <a class="btn btn-dark" href="home">Home</a>
        </div>
        </div>
        </div>
        @vite('resources/js/app.js')
</body>
</html>
