<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/265cf3da75.js" crossorigin="anonymous"></script>
    <title>@yield('title', 'efiehub')</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    @isset($property->title )
    <meta property="og:title" content="{{$property?->title}}"/>
    <meta property="og:url" content=" {{url("/properties/{$property?->slug}")}}"/>    
    @endisset
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset('/images/logo.png')}}"/>
</head>
<noscript>
    <strong>We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript> 
<body class="font-Poppins container sm:px-3 2xl:px-10">
    <div id="app" class="min-h-screen flex flex-col justify-between">
        <div 
            class="sm:hidden bg-main-blue border-main-blue h-2"
            :class="{'hidden': !isInHomepage}"
        ></div>
        <a
            :class="[isInHomepage ? 'bg-logo bg-main-blue' : 'bg-logo-blue mt-3']"
            class="sm:hidden bg-contain bg-center bg-no-repeat h-7 block w-full" 
            href="/"
            alt="logo"
        ></a>        
        <nav-bar
            :is-scroll-y-past-search-bar = "isScrollYPastSearchBar"
            @@place-search-bar-in-nav-bar="placeSearchBarInNavBar=true"
            @@remove-search-bar-from-nav-bar="placeSearchBarInNavBar=false"
        ></nav-bar>
        <vue-progress-bar id="vue-progress-bar" ></vue-progress-bar>
        <div>    
            @yield('main-content')
        </div>
        <mobile-nav-bar
            @@show-mobile-search-bar = "showMobileSearchBarModal"
        ></mobile-nav-bar>
        <footer class="p-5 text-base sm:text-lg">
            <hr class="my-5">
            <div class="flex flex-col justify-center items-center gap-4 sm:flex-row sm:gap-12">
                <span>About us</span>
                <span>Terms of use</span>
                <span>Privacy policy</span>
            </div>
            <hr class="my-5">
            <div class="flex justify-center items-center gap-12">
                <span class="flex flex-shrink-0">&copy; efiehub</span>
                <div class="flex gap-3 justify-center items-center">
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>
        </footer>
        
        <mobile-search-bar
            :property-types="{{$propertyTypes}}"
            :regions = "{{$regions}}"
            :is-search-bar-in-navbar="false"                      
        ></mobile-search-bar>

        <share-property-modal></share-property-modal>

        <log-in-modal
            @@user-has-been-authenticated="onUserHasBeenAuthenticated"
        ></log-in-modal>

        <sign-up-modal
            @@user-has-been-authenticated="onUserHasBeenAuthenticated"
        ></sign-up-modal>

        {{-- for some strange reason modals dont render when this notif component is above them --}}
        <notifications position="bottom right" />

    </div>
</body>
</html>

<script type="application/javascript">
    var isUserAuthenticatedVar = @JSON(Auth::check());
    var authenticatedUserVar = @JSON(Auth::user()?->makeVisible(['email', 'phone_number']));

    let minPrice = {{$minPrice}}
    let maxPrice = {{$maxPrice}}
</script>

<script src="{{ mix('js/app.js') }}"></script>

<style>
    #vue-progress-bar {
        z-index: 10 !important; 
    }
</style>

