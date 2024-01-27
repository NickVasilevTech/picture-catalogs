@extends('layouts.app', [
    'customBanner' => $customBanner,
    'username' => $username,
    'name' => $name
    ])
@section('content')
    <div class="container px-1 mt-5">
        @if(Auth::user()->username === $username)
        <div class="d-block">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <button type="button" class="btn btn-dark mt-4" data-bs-toggle="modal" data-bs-target="#picture-upload-modal" onclick="document.getElementById('picture-use-as-banner').value = true;">
                    {{__('Change profile banner')}}
                </button>
                <button type="button" class="btn btn-dark mt-4 ms-4" data-bs-toggle="modal" data-bs-target="#picture-upload-modal" onclick="document.getElementById('picture-use-as-banner').value = '';">
                    {{__('Upload a picture')}}
                </button>
                <button type="button" class="btn btn-dark mt-4 ms-4" data-bs-toggle="modal" data-bs-target="#create-catalog-modal">
                    {{__('Create a catalog')}}
                </button>

                <!-- Modal for uploading a picture -->
                <div class="modal" id="picture-upload-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('Upload a picture')}}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{ route('picture.upload.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-between">

                                        <div class="col-md-9">
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                        <input type="hidden" id="picture-use-as-banner" name="useAsBanner" value="false">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-dark">{{__('Upload')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for catalog creation -->
                <div class="modal" id="create-catalog-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('Create a catalog')}}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{ route('catalog.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-between">

                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        {{-- <input type="hidden" id="picture-use-as-banner" name="useAsBanner" value="false"> --}}
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-dark">{{__('Create')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="w-100">
        @endif
        <h2> {{ __('Pictures') }}</h2>
        <hr class="w-100">
        <div class="mt-4 row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @each('pictures.partial.picture-card', $pictures, 'picture', 'pictures.partial.no-pictures')
        </div>
        <h2> {{ __('Catalogs') }}</h2>
        <hr class="w-100">
        <div class="mt-4 row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            {{-- @if (count($groupCategories) > 0)
                @foreach ($groupCategories as $parent)
                    @include('partials.nav.categories', $parent)
                @endforeach
            @else
                @include('partials.group-none')
            @endif --}}
            {{-- @each('pictures.partial.picture-card', $catalogs, 'picture', 'pictures.partial.no-pictures') --}}
            @each('catalogs.partial.catalog-card', $catalogs, 'catalog', 'catalogs.partial.no-catalogs')
        </div>
    </div>
@endsection
