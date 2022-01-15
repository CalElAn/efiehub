@extends('layouts.app')

@section('title', $property->type.' in '.$property->town)

@section('main-content')

<div class="container px-5 sm:px-10 sm:mt-28">

    @isset($property)
    <show-property
        :property = "{{$property}}"
        :is-user-authenticated = "isUserAuthenticated"
        :authenticated-user = "authenticatedUser"
        @@show-log-in-modal = "showLogInModal"
        @@unfavourite-property = "onUnfavouriteProperty"
        @@favourite-property = "onFavouriteProperty"
    ></show-property>
    @endisset

    <p class="font-semibold text-lg sm:text-xl mt-24">
        Similar properties
    </p>

    <div class="flex flex-col items-center mt-12 gap-16 lg:grid lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-5 xl:gap-20">
        @isset($similarProperties)
        @foreach($similarProperties as $property)
        <property-card
            :property="{{$property}}"
            :is-user-authenticated = "isUserAuthenticated"
            :authenticated-user = "authenticatedUser"
            @@show-log-in-modal = "showLogInModal"
            @@unfavourite-property = "onUnfavouriteProperty"
            @@favourite-property = "onFavouriteProperty"
        ></property-card>
        @endforeach
        @endisset
    </div>

</div>

@endsection 

