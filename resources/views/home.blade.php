<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title', env('APP_NAME'))</title>
</head>
<noscript>
    <strong>We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>  
<body class="font-Poppins container">
    <div id="app">
        <header>
            <div class="w-full h-header-bg-min sm:h-header-bg flex flex-col sm:px-14 bg-main-blue rounded-b-header-bg-min sm:rounded-3xl">
                <nav class="flex justify-center sm:justify-between pt-5">
                    <div class="bg-contain bg-center bg-no-repeat h-8 w-32" style="background-image: url('images/logo.png');" alt="logo"></div>
                    <div class="hidden sm:flex gap-3 text-sm sm:text-base">
                        <button class="px-5 py-1 border border-white bg-main-blue text-white rounded-full">
                            Add a property
                        </button>
                        <div class="flex gap-2">
                            <button class="px-4 py-1 bg-white text-main-blue rounded-full">
                                Sign up
                            </button>
                            <button class="px-4 py-1 bg-main-orange text-white rounded-full">
                                Log in
                            </button>
                        </div>
                    </div>
                </nav>
                <div class="flex flex-col flex-grow sm:grid sm:grid-cols-2 sm:mt-5 md:pt-6">
                    <div class="flex flex-col justify-start gap-5 sm:relative">
                        <p class="text-4xl sm:text-5xl xl:text-6xl font-bold text-white text-center sm:text-left mt-6 mx-9 sm:mx-0">
                            Rent that meets your lifestyle
                        </p>
                        <p class="text-white sm:text-2xl text-center sm:text-left my-4 mx-20 sm:mx-0">
                            Rent the easy way
                        </p>
                        <large-search-bar
                            :property-types="[]"
                            :is-search-bar-in-navbar="false"                      
                        ></large-search-bar>
                    </div>
                    <div class="relative flex flex-grow">
                        <div class="mx-auto flex-grow bg-contain bg-bottom bg-no-repeat sm:absolute right-0 md:bg-center lg:bg-top sm:w-header-img sm:h-header-img" alt="surprised man" style="background-image: url('images/surprised-man-2x.png');">
                        </div>
                        <button 
                            @@click="showMobileSearchBarModal"
                            class="absolute bottom-9 left-0 right-0 mx-auto h-14 w-44 justify-evenly text-white flex items-center rounded-full backdrop-filter backdrop-blur-2xl backdrop-opacity-90 bg-opacity-30 bg-white sm:hidden">
                            Find a home
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <mobile-search-bar></mobile-search-bar>
                </div>
            </div>
        </header>
        <section class="flex justify-center mt-6 lg:mt-10 sm:justify-start sm:mx-10 xl:text-lg">
            <button class="bg-main-orange text-white rounded-full w-44 h-12 sm:w-52 sm:h-16">
                Book an agent
            </button>
        </section>
        <section class="mt-24 mx-5 sm:mx-10">
            <p class="font-semibold text-2xl">
                Explore other locations
            </p>
            <div class="flex flex-col sm:grid sm:grid-cols-2 lg:grid-cols-3 mt-5 gap-8">
                <div class="flex gap-2.5">
                    <img src="images/accra.png" alt="accra" class="rounded-3xl w-16 h-16">
                    <div class="flex flex-col justify-center gap-1">
                        <p class="font-medium text-lg">
                            Accra
                        </p>
                        <p class="text-gray-700">
                            Greater Accra Region
                        </p>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <img src="images/kumasi.png" alt="accra" class="rounded-3xl w-16 h-16">
                    <div class="flex flex-col justify-center gap-1">
                        <p class="font-medium text-lg">
                            Kumasi
                        </p>
                        <p class="text-gray-700">
                            Ashanti Region
                        </p>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <img src="images/tamale.png" alt="accra" class="rounded-3xl w-16 h-16">
                    <div class="flex flex-col justify-center gap-1">
                        <p class="font-medium text-lg">
                            Tamale
                        </p>
                        <p class="text-gray-700">
                            Northern Region
                        </p>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <img src="images/kumasi.png" alt="accra" class="rounded-3xl w-16 h-16">
                    <div class="flex flex-col justify-center gap-1">
                        <p class="font-medium text-lg">
                            Kumasi
                        </p>
                        <p class="text-gray-700">
                            Ashanti Region
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-24 mx-5 sm:mx-10">
            <p class="font-semibold text-2xl">
                Rent in Accra
            </p>
            <div class="flex flex-col items-center mt-12 gap-16 lg:grid lg:grid-cols-2 2xl:grid-cols-3 lg:gap-20">
                <div class="rounded-main-card flex flex-col bg-main-blue h-96 w-72 sm:w-96">
                    <div class="bg-cover bg-no-repeat h-2/3" style="background-image: url('images/accra.png');" alt="accra home"></div>
                    <div class="h-1/3 flex flex-col text-white text-base justify-around gap-2 p-5">
                        <div>
                            <p class="font-medium text-lg">
                                Apartment Apartment in Okponglo
                            </p>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex flex-col">
                                <p>
                                    Self contained
                                </p>
                                <p>
                                    Porch
                                </p>
                            </div>
                            <div>
                                <p>
                                    $200
                                </p>
                                <p class="text-xs">
                                    per month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-main-card flex flex-col bg-main-blue h-96 w-72 sm:w-96">
                    <div class="bg-cover bg-no-repeat h-2/3" style="background-image: url('images/kumasi.png');" alt="accra home"></div>
                    <div class="h-1/3 flex flex-col text-white text-base justify-around gap-2 p-5">
                        <div>
                            <p class="font-medium text-lg">
                                Apartment in Kumasi
                            </p>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex flex-col">
                                <p>
                                    Self contained
                                </p>
                                <p>
                                    Porch
                                </p>
                            </div>
                            <div>
                                <p>
                                    $200
                                </p>
                                <p class="text-xs">
                                    per month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-main-card flex flex-col bg-main-blue h-96 w-72 sm:w-96">
                    <div class="bg-cover bg-no-repeat h-2/3" style="background-image: url('images/tamale.png');" alt="accra home"></div>
                    <div class="h-1/3 flex flex-col text-white text-base justify-around gap-2 p-5">
                        <div>
                            <p class="font-medium text-lg">
                                Apartment in Tamale
                            </p>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex flex-col">
                                <p>
                                    Self contained
                                </p>
                                <p>
                                    Porch
                                </p>
                            </div>
                            <div>
                                <p>
                                    $200
                                </p>
                                <p class="text-xs">
                                    per month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-main-card flex flex-col bg-main-blue h-96 w-72 sm:w-96">
                    <div class="bg-cover bg-no-repeat h-2/3" style="background-image: url('images/accra.png');" alt="accra home"></div>
                    <div class="h-1/3 flex flex-col text-white text-base justify-around gap-2 p-5">
                        <div>
                            <p class="font-medium text-lg">
                                Apartment in Tamale
                            </p>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex flex-col">
                                <p>
                                    Self contained
                                </p>
                                <p>
                                    Porch
                                </p>
                            </div>
                            <div>
                                <p>
                                    $200
                                </p>
                                <p class="text-xs">
                                    per month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-24 mx-5 sm:mx-10">
            <p class="font-semibold text-2xl mx-5 text-center">
                Not sure where to rent?
            </p>
            <div class="flex justify-center mt-4">
                <button class="bg-main-orange text-white rounded-full w-52 h-16">
                    Book an agent
                </button>
            </div>
        </section>
        <section class="flex items-center mt-24 mx-2 sm:mx-10 rounded-main-card bg-cover bg-no-repeat bg-become-an-agent lg:bg-become-an-agent-2x" style="height: 549px">
            <div class="flex flex-col gap-5 sm:mx-24">
                <p class="text-white text-center text-4xl font-semibold sm:text-5xl">
                    Become an agent
                </p>
                <p class="text-white text-center font-medium sm:text-2xl">
                    Earn extra income and unlock new opportunities
                </p>
                <div class="flex justify-center">
                    <button class="bg-main-orange text-white rounded-full w-52 h-16 sm:text-lg">
                        Learn more
                    </button>
                </div>
            </div>
        </section>
        <section class="mt-24 mx-5 sm:mx-10 flex flex-col gap-20 lg:grid lg:grid-cols-3 text-justify">
            <div class="flex flex-col gap-6">
                <p class="text-center font-semibold text-2xl text-main-blue">
                    Rent the easy way
                </p>
                <p>
                    Discover thousands of apartments and homes for rent
                </p>
            </div>
            <div class="flex flex-col gap-6">
                <p class="text-center font-semibold text-2xl text-main-blue">
                    Add a property
                </p>
                <p>
                    Boost your rental business. Reach thousands of tenants through our website and other partner websites with just one click
                </p>
            </div>
            <div class="flex flex-col gap-6">
                <p class="text-center font-semibold text-2xl text-main-blue">
                    Earn extra income
                </p>
                <p>
                    Upload properties and earn money on ......
                </p>
            </div>
        </section>
        <footer class="mt-12 p-5 text-lg">
            <hr class="my-5">
            <div class="flex flex-col justify-center items-center gap-6 sm:flex-row sm:gap-12">
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
    </div>
</body>
</html>

<script type="application/javascript">
    var isUserAuthenticatedVar = @JSON(Auth::check());
    var authenticatedUserVar = @JSON(Auth::user());
</script>

<script src="{{ mix('js/app.js') }}"></script>
