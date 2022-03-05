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
    <p 
        v-if="paginatedProperties.total === 0"
        class="mt-24 text-center text-xl"
    >
        Your search did not match any available properties. Please try again sometime soon.
    </p>

    <paginated-properties
        :initial-paginated-properties="paginatedProperties"
    >
    </paginated-properties>
    
</div>

@endsection 

<script type="application/javascript">
    let paginatedProperties = @JSON($paginatedProperties);
    let searchQuery = @JSON($searchQuery);
</script>
