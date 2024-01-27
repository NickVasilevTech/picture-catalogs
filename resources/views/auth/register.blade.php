{{-- <x-guest-layout> --}}
@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}" class="d-flex w-25 mw-25 flex-column mx-auto align-items-center justify-content-center">
        @csrf

        <!-- Username -->
        <div class="mt-4">
            <div class="d-block">
                <x-input-label for="username" :value="__('Username')" />
            </div>
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('username')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <!-- Name -->
        <div class="mt-2">
            <div class="d-block">
                <x-input-label for="name" :value="__('Name')" />
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('name')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <div class="d-block">
                <x-input-label for="email" :value="__('Email')" />
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <div class="d-block">
                <x-input-label for="password" :value="__('Password')" />
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('password')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <div class="d-block">
                <label for="password_confirmation">{{__('Confirm Password')}} </label>
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <div class="d-block d-flex align-items-center justify-content-center">
                <x-primary-button class="btn btn-dark">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            <div class="d-block d-flex align-items-center justify-content-center">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </div>
    </form>
@endsection
{{-- </x-guest-layout> --}}
