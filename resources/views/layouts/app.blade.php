<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title', 'efiehub')</title>
</head>
<noscript>
    <strong>We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>  
<body class="font-Poppins lg:px-5 2xl:px-10">
    <div id="app" class="min-h-screen flex flex-col justify-between">
        <a href="/" class="sm:hidden">
            <div class="sm:hidden bg-contain bg-center bg-no-repeat h-8 w-full bg-main-blue" style="background-image: url('/images/logo.png');" alt="logo"></div>
        </a>        
        <nav-bar
            :authenticated-user = "authenticatedUser"
            :is-user-authenticated = "isUserAuthenticated"
            :is-scroll-y-past-search-bar = "isScrollYPastSearchBar"
            @@place-search-bar-in-nav-bar="placeSearchBarInNavBar=true"
            @@remove-search-bar-from-nav-bar="placeSearchBarInNavBar=false"
            @@show-log-in-modal = "showLogInModal"
            @@show-sign-up-modal="showSignUpModal"
        ></nav-bar>
        <div>    
            @yield('main-content')
        </div>
        <mobile-nav-bar
            :authenticated-user="authenticatedUser"
            :is-user-authenticated="isUserAuthenticated"
            @@show-mobile-search-bar = "showMobileSearchBarModal"
            @@show-log-in-modal = "showLogInModal"
            @@show-sign-up-modal="showSignUpModal"
        ></mobile-nav-bar>
        <footer class="p-5 text-base sm:text-lg">
            <hr class="my-5">
            <div class="flex flex-col justify-center items-center gap-4 sm:flex-row sm:gap-12">
                <span>About us</span>
                <span>Terms of use</span>
                <span>Privacy policy</span>
            </div>
            <hr class="my-5">
            <div class="flex justify-center gap-12">
                <span>&copy; efiehub</span>
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="#000000" viewBox="0 0 24 24" >
                        <path d="M17.525,9H14V7c0-1.032,0.084-1.682,1.563-1.682h1.868v-3.18C16.522,2.044,15.608,1.998,14.693,2 C11.98,2,10,3.657,10,6.699V9H7v4l3-0.001V22h4v-9.003l3.066-0.001L17.525,9z"/>
                    </svg>
                </div>
            </div>
        </footer>
        <log-in-modal
            :show-welcome-text="showWelcomeText"
            :welcome-text="welcomeText"
            @@show-sign-up-modal="showSignUpModal"
            @@user-has-been-authenticated="onUserHasBeenAuthenticated"
            @@closed-log-in-modal = "showWelcomeText = false"
        ></log-in-modal>
        <sign-up-modal
            @@show-log-in-modal="showLogInModal"
            @@user-has-been-authenticated="onUserHasBeenAuthenticated"
        ></sign-up-modal>
    </div>
</body>
</html>

<script type="application/javascript">
    var isUserAuthenticatedVar = @JSON(Auth::check());
    var authenticatedUserVar = @JSON(Auth::user());
</script>

<script src="{{ mix('js/app.js') }}"></script>
