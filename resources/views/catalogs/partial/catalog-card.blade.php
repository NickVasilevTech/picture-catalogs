<div class="col-4 mb-5">
    <div class="card h-100">
        <a href="{{route('catalog.view', ['catalog' => $catalog])}}" style="text-decoration: none;" class="link-secondary">
            <img class="card-img-top img-fluid" src="{{isset($catalog->thumbnail)? asset('storage/user_pictures/'.$catalog->thumbnail->filename) : asset('storage/plus.jpg')}}"
                onerror="this.onerror=null;this.src='https://dummyimage.com/290x400/dee2e6/6c757d.jpg&text=No+image+found';"
                alt="No Image"
                {{-- style="height:400px;object-fit:cover;object-position:center center;" --}}
                style="height:400px;object-fit:{{isset($catalog->thumbnail)? 'cover' : 'contain'}};object-position:center center;"
            />
            <div class="text-center">
                <h5 class="fw-bold">{{$catalog->name}}</h5>
            </div>
        </a>
        <div class="card-body pt-0 pb-3 px-2">
            <div class="text-center">
                by <a class="link-secondary fw-bold" href="{{ route('profile.view', ['username' => $catalog->authorName]) }}" style="text-decoration: none;">{{$catalog->authorName}}</a>
            </div>
        </div>
    </div>
</div>
