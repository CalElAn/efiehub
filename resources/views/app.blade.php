<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    @routes
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset('/images/logo.png')}}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/265cf3da75.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @inertiaHead
</head>
<noscript>
    <strong>We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript> 
<body class="font-Poppins container sm:px-3 2xl:px-10">
    @inertia
</body>
</html>