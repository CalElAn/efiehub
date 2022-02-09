@extends('layouts.app')

@section('title', 'Add Property')

@section('main-content')

<div class="pt-10 sm:pt-20">
    <add-property
    :property = "{{$property}}"
    :regions = "{{$regions}}"
    @@show-log-in-modal = "showLogInModal"
    ></add-property>
</div>

@endsection
