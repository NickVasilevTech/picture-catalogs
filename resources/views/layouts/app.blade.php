<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        @yield('meta_tags')
        <title>Pavel Andreev Foundation - Picture Catalogs</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap styles-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Bootstrap javascript-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
        @yield('scripts')
    </head>
    <body class="font-sans antialiased d-flex flex-column min-vh-100">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container px-4 px-lg-5">
                    <a class="navbar-brand" href="{{ route('home')}}">Picture Catalogs</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        </ul>
                        <form class="d-flex">
                            @auth
                            <button class="btn btn-dark" type="button" onclick="window.location.href=('{{ route('profile.view') }}');">
                                {{ __('My Profile') }}
                            </button>
                            <button class="btn btn-dark ms-2" type="button" onclick="window.location.href=('{{ route('logout') }}');">
                                {{ __('Logout') }}
                            </button>
                            @else
                                <button class="btn btn-dark" type="button" onclick="window.location.href=('{{ route('login') }}');">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('register'))
                                    <button class="btn btn-dark ms-2" type="button" onclick="window.location.href='{{ route('register') }}';">
                                        {{ __('Register') }}
                                    </button>
                                @endif
                            @endauth
                        </form>
                    </div>
                </div>
            </nav>
            <!-- Header-->
            <header class="bg-dark" style="background-size: cover;background-position: center center;background-image:url({{
                (isset($customBanner))?
                    ( $customBanner == '' ?
                        asset('storage/default-no-banner.jpg')
                        : asset('storage/user_pictures/'.$customBanner)
                    )
                    : asset('storage/default-banner.png')
            }});">
                <div class="h-100 w-100 py-5" style="background: rgba(0,0,0,0.5)">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="text-center text-white">
                        <h1 class="display-4 fw-bolder">{{ (isset($username))? $username : __('Edit and organize your pictures') }}</h1>
                        <p class="lead fw-normal text-white-40 mb-0">{{ (isset($name))? $name : __('With our catalogs platform') }}</p>
                    </div>
                </div>
                </div>
            </header>
            {{-- @endif --}}
            <!-- Page Content -->
            <main>
                <div class="h-100 d-flex 'flex-column align-items-center justify-content-center">
                @yield('content')
                </div>
            </main>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark mt-auto">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Picture Catalogs 2024</p></div>
        </footer>
    </body>
</html>

