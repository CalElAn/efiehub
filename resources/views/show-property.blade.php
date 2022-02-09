@extends('layouts.app')

@section('title', $property->type.' in '.$property->town)

@section('main-content')

<div class="container px-5 sm:px-10 sm:mt-28">

    @isset($property)
    <show-property
        :property = "{{$property}}"
        @@show-log-in-modal = "showLogInModal"
        @@unfavourited-property = "onUnfavouritedProperty"
        @@favourited-property = "onFavouritedProperty"
    ></show-property>
    @endisset

    {{-- <div id="map"></div> --}}

    <p class="font-semibold text-lg sm:text-xl mt-24">
        Similar properties
    </p>

    <div class="flex flex-col items-center mt-12 mb-10 gap-16 lg:grid lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-5 xl:gap-20">

        <property-card
            v-for="(item, index) in paginatedProperties.data"
            :key="index"
            :property="item"
            @@show-log-in-modal = "showLogInModal"
            @@unfavourited-property = "onUnfavouritedProperty"
            @@favourited-property = "onFavouritedProperty"
        ></property-card>

    </div>

    <pagination 
        v-model="page" 
        :records="paginatedProperties.total" 
        :per-page="paginatedProperties.per_page" 
        @paginate="getPaginatedProperties"    
        :options="paginationOptions"   
    />

</div>

@endsection 

<script type="application/javascript">
    let paginatedProperties = @JSON($paginatedProperties);
</script>

{{-- <script>
    // Initialize and add the map
    function initMap() {
      // The location of Uluru
      const uluru = { lat: 5.6098816, lng: -0.1835008 };
      // The map, centered at Uluru
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 20,
        center: uluru,
      });
      // The marker, positioned at Uluru
      const marker = new google.maps.Marker({
        position: uluru,
        map: map,
      });
    }
</script>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDirkNzKT8JLB1mus3DdxkdE4hySmMGGMI&callback=initMap&libraries=&v=weekly"
    async
></script> --}}

<style>
#map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
}
</style>