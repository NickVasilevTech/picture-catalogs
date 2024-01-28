@extends('layouts.app', isset($catalog)? [
    'customBanner' => $catalog['banner'],
    'username' => $catalog['name'],
    'name' => $catalog['authorName']
] : [])

@section('content')
    {{-- <section class="py-5"> --}}
        <div class="container px-1 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @each('pictures.partial.picture-card', $pictures, 'picture', 'pictures.partial.no-pictures')
            </div>
        </div>
        <div class="d-block">{{$pictures->links()}}</div>
    {{-- </section> --}}
@endsection

