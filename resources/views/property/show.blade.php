@extends('layouts.app')

@section('title', $property->type.' in '.$property->town)

@section('main-content')

<div class="px-2 sm:mt-28">

    <show-property
        :property = "{{$property}}"
    ></show-property>

    <p class="font-semibold text-lg sm:text-xl mt-24">
        Similar properties
    </p>

    <paginated-properties
        :initial-paginated-properties="paginatedProperties"
    >
    </paginated-properties>

</div>

@endsection 

<script type="application/javascript">
    let paginatedProperties = @JSON($paginatedProperties);
</script>

<style>
#map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
}
</style>