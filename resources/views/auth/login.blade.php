{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}" class="d-flex flex-column align-items-center justify-content-center">
        @csrf

        <!-- Username Address -->
        <div>
            <div class="d-block mt-4">
                <label for="username">{{__('Username')}}</label>
            </div>
            <x-text-input id="username" class="block mt-1 w-full" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('username')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>


        <!-- Password -->
        <div class="mt-2">
            <div class="d-block ">
                <label for="password">{{__('Password')}}</label>
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>
        <div class="d-block d-flex align-items-center justify-content-center">
            <x-input-error :messages="$errors->get('password')" class="mt-2 invalid-feedback d-block mw-100" />
        </div>

        <!-- Remember Me -->
        <div class="d-block mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex align-items-center justify-content-center mt-4">
            <div class="d-block d-flex align-items-center justify-content-center">
                <x-primary-button class="btn btn-dark">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            @if (Route::has('password.request'))
            <div class="d-block d-flex align-items-center justify-content-center">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        @endif
        </div>
    </form>
@endsection

{{-- </x-guest-layout> --}}
