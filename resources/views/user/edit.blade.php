@extends('layouts.app')

@section('title', 'Edit User Profile')

@section('main-content')

<div class="mt-10 mx-3 sm:mt-32">
    <p class="mb-6 font-semibold text-xl sm:text-2xl">
        Edit user profile
    </p>

    <div class="w-full sm:max-w-md mt-6 px-6 mx-auto py-4 bg-white border border-gray-200 shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{"/users/{$user->id}"}}">
            @method('PATCH')
            @csrf

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <profile-picture-upload
                :user="{{$user}}"
            ></profile-picture-upload>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required />
            </div>

            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone number')" />

                <x-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" value="{{$user->phone_number}}" required />
            </div>

            <div class="flex justify-center mt-6">
                <a href="/forgot-password" class="underline text-gray-600">
                    Change password
                </a>
            </div>  

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>    
    </div>
</div>

@endsection 