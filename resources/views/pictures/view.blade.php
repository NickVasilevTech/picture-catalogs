@extends('layouts.app')
@section('content')
    <div class="container px-1 mt-5">
        <img class="card-img-top img-fluid" src="{{asset('storage/user_pictures/'.$picture['filename'])}}"
                onerror="this.onerror=null;this.src='https://dummyimage.com/290x400/dee2e6/6c757d.jpg&text=No+image+found';"
                alt="No Image"
                style="height:400px;object-fit:cover;object-position:center center;"
            />
        <div class="text-start">
            by <a class="link-secondary fw-bold" href="{{ route('profile.view', ['username' => $picture['authorName']]) }}" style="text-decoration: none;">{{$picture['authorName']}}</a>
        </div>
        <h2> {{ __('Comments') }}</h2>
        <hr class="w-100">
        @auth
        <div class="mt-4 row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
            <form method="POST" action="{{route('picture.comment')}}" class="w-75">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="commentBody" id="comment-body"></textarea>
                    <input type="hidden" name="pictureId" value="{{$picture['id']}}">
                </div>
                <button type="submit" class="btn btn-dark my-2">{{__('Leave a comment')}}</button>
            </form>
        </div>
        @endauth
        <div class="my-4 ms-1 row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
            @each('pictures.partial.comment', $comments, 'comment')
        </div>
    </div>
    <!-- Summernote WYSIWYG Editor -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        addEventListener("DOMContentLoaded", (event) => {
            $('#comment-body').summernote({
                height: 200
            });
        });
    </script>
@endsection
