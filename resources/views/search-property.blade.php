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
        @{{paginatedProperties.total}} properties found
    </div>

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
    let searchQuery = @JSON($searchQuery);
</script>
