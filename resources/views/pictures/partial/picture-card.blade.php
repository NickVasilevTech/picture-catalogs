<div class="col-4 mb-5">
    <div class="card h-100">
        @auth
        <a href="{{route('picture.view', ['picture' => $picture])}}">
        @endauth
            <img class="card-img-top img-fluid" src="{{asset('storage/user_pictures/'.$picture->filename)}}"
                onerror="this.onerror=null;this.src='https://dummyimage.com/290x400/dee2e6/6c757d.jpg&text=No+image+found';"
                alt="No Image"
                style="height:400px;object-fit:cover;object-position:center center;"
            />
        @auth
        </a>
        @endauth
        <div class="card-body p-4">
            <div>{{-- <div class="text-center"> --}}
                <span class="float-start">by
                    @auth
                    <a href="{{ route('profile.view', ['username' => $picture->authorName]) }}" style="text-decoration: none;">
                    @endauth
                        <span class="link-secondary fw-bold">{{$picture->authorName}}</span>
                    @auth
                    </a>
                    @endauth
                </span>

                @auth
                @php
                    $userCatalogs = Session::get('user_catalogs');
                @endphp

                @if(isset($userCatalogs) && count($userCatalogs) > 0 )
                    <div class="dropdown">
                    <button type="button" class="float-end fw-bold btn btn-light" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 30px; padding: 0px 8px 3px 8px;">+</button>
                    <ul class="dropdown-menu">
                        @foreach ($userCatalogs as $catalog)
                            @php
                                $picturesInCatalog = explode(",", $catalog->pictures);
                                $isInCatalog = in_array($picture->id,$picturesInCatalog);
                            @endphp
                            <li  id="p{{$picture->id}}-c{{$catalog->id}}" onclick="addPictureToCatalog('{{route('catalog.add-picture', ['catalog_id' => $catalog->id, 100])}}', '#p{{$picture->id}}-c{{$catalog->id}} svg')" role="button" >
                                <span class="dropdown-item icon-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16" style="opacity:{{$isInCatalog? 1 : 0}};">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"></path>
                                    </svg>
                                    {{$catalog->name}}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                @endauth

            </div>
        </div>
    </div>
</div>

@section('meta_tags')
    <meta name="csrf-token" content="{{ $picture->id }}" />
@endsection

@section('scripts')
    <script>
        function addPictureToCatalog(url, id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                method: 'POST',
                success:function(response)
                {
                    if (response.success == true) {
                        $(id).css('opacity', '1');
                    }
                },
                error: function(response) {
                    $('#errors-modal .modal-body').append('<div><ul></ul></div>');
                    let errors = response.responseJSON.errors;
                    Object.keys(response.responseJSON.errors).forEach(param => {
                        response.responseJSON.errors[param].forEach(error => {
                            $('#errors-modal .modal-body ul').append('<li class="invalid-feedback d-block">'+error+'</li>');
                        });
                    });
                    $('#errors-modal').modal('show');
                }
            });
        };
    </script>
@endsection
