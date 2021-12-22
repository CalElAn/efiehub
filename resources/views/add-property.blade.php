@extends('layouts.app')

@section('title', 'Add Property')

@section('main-content')
<a href="/" class="">
    <div class="sm:hidden bg-contain bg-center bg-no-repeat h-8 w-full bg-indigo-500" style="background-image: url('images/logo.png');" alt="logo"></div>
</a>
<div class="pt-10 sm:pt-20">
    <add-property
    :property = "{{$property}}"
    :is-user-authenticated = "isUserAuthenticated"
    :authenticated-user = "authenticatedUser"
    @@show-log-in-modal = "showLogInModal"
    ></add-property>
</div>
@endsection
