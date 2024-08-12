<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <!-- Load jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="flex justify-center h-[10%] w-full bg-slate-50">
        <p class="p-[30px] text-blue-800 text-xl">Welcome to Project Management System!!</p>
    </div>
    @include('../index')
</body>

</html>