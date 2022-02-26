@extends('layouts.app')

@section('title', 'Add Property')

@section('main-content')

<div class="pt-10 sm:pt-20">
    <create-or-edit-property
    :mode="'{{$mode}}'"
    :property="{{$property}}"
    :property-types-and-features = "{{$propertyTypesAndFeatures}}"
    :regions = "{{$regions}}"
    ></create-or-edit-property>
</div>

@endsection
