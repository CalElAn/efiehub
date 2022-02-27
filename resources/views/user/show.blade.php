@extends('layouts.app')

@section('title', 'User Profile')

@section('main-content')

<div class="mt-10 mx-3 sm:mt-32">
    <p class="mb-6 font-semibold text-xl sm:text-2xl">
        User profile
    </p>
    
    @if($user->is_user_the_authenticated_user)
    <div class="mb-2 flex justify-end">
        <a 
            class="flex gap-1 items-center border border-main-blue text-main-blue p-2 rounded-lg hover:underline hover:bg-gray-100"
            href="{{"/users/{$user->id}/edit"}}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-main-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </a>
    </div>
    @endif

    <user-card
        class="md:mx-5 lg:mx-36 xl:mx-96"
        :user="{{Illuminate\Support\Js::from($user)}}"
        :property="null"
        :show-full-card="true"
    >
    </user-card>

    @php
        use Illuminate\Support\Js;
    @endphp

    <user-profile-nav-bar
        :user="{{Js::from($user)}}"
        :paginated-properties="{{Js::from($paginatedProperties)}}"
        :reviews="{{Js::from($reviews)}}"
        :paginated-favourited-properties="{{Js::from($paginatedFavouritedProperties)}}"
        :notifications="{{Js::from($notifications)}}"
    ></user-profile-nav-bar>
    
</div>

@endsection 

<script type="application/javascript">
    let paginatedProperties = @JSON($paginatedProperties);
</script>
