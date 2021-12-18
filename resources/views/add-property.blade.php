@extends('layouts.app')

@section('title', 'Add Property')

@section('main-content')
<div class="pt-20">
    <add-property
    :property = "{{$property}}"
    :is-user-authenticated = "isUserAuthenticated"
    :authenticated-user = "authenticatedUser"
    @@show-log-in-modal = "showLogInModal"
    ></add-property>
</div>
@endsection
