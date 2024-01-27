@extends('layouts.app', isset($catalog)? [
    'customBanner' => $catalog['banner'],
    'username' => $catalog['name'],
    'name' => $catalog['authorName']
] : [])

@section('content')
    {{-- <section class="py-5"> --}}
        <div class="container px-1 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                {{-- @if ( isset($catalog) )
                    <div class="col-4 mb-5">
                        <div class="card h-100">
                            {{-- <a href="{{route('picture.view', ['picture' => $picture])}}"> --}}
                                {{-- <img class="card-img-top img-fluid" src="{{asset('storage/plus.jpg')}}"
                                    onerror="this.onerror=null;this.src='https://dummyimage.com/290x400/dee2e6/6c757d.jpg&text=No+image+found';"
                                    alt="No Image"
                                    style="height:400px;object-fit:contain;object-position:center center;"
                                /> --}}
                            {{-- </a> --}}
                            {{-- <div class="card-body p-4">
                                <div class="text-center">
                                    {{__('Add a new picture')}}</a>
                                </div>
                            </div> --}}
                            {{-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div> --}}
                        {{-- </div>
                    </div>
                    @each('pictures.partial.picture-card', $pictures, 'picture')
                @else --}}
                    @each('pictures.partial.picture-card', $pictures, 'picture', 'pictures.partial.no-pictures')
                {{-- @endif --}}
            </div>
        </div>
    {{-- </section> --}}
@endsection

