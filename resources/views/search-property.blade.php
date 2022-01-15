@extends('layouts.app')

@section('title', 'Search Property')

@section('main-content')

<div class="mt-10 sm:mt-32">

    <search-property
        :property-types = "{{$propertyTypes}}"
        :regions = "{{$regions}}"
        :search-query="searchQuery"
        @@update-properties-and-search-query="updatePropertiesAndSearchQuery"
    ></search-property>

    <div class="flex justify-end px-6 pt-1 text-xs sm:text-sm font-medium">
        @{{properties.length}} properties found
    </div>

    <div class="flex flex-col items-center mt-12 gap-16 lg:grid lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-5 xl:gap-20">

        <property-card
            v-for="(item, index) in properties"
            :key="index"
            :property="item"
            :is-user-authenticated = "isUserAuthenticated"
            :authenticated-user = "authenticatedUser"
            @@show-log-in-modal = "showLogInModal"
            @@unfavourite-property = "onUnfavouriteProperty"
            @@favourite-property = "onFavouriteProperty"
        ></property-card>

    </div>
</div>

@endsection 

<script type="application/javascript">
    let properties = @JSON($properties);
    let searchQuery = @JSON($searchQuery);
</script>
