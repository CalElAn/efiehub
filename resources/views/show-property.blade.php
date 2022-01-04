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

</div>

@endsection 

