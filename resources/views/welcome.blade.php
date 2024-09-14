<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jaunimo laisvalaikio centras Kaune</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('/css1/style.css') }}" />
    </head>
    <body class="antialiased">
        <header>
            <nav class="colorNavbar navbar sticky-top navbar-expand-lg ">
                <div class="container-fluid">
                    <a href="{{ url('') }}" class="navbar-brand font-italic">JLCK</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navbar-collapse justify-content-end" id="navbarCollapse">
                        <a href="{{ url('/cares') }}" class="link nav-link">Renginiai</a>
                        <a href="{{ url('/prices') }}" class="link nav-link">Stovyklos</a>
                        <a href="{{ url('/prices') }}" class="link nav-link">Konsultacijos</a>
                        <a href="{{ url('/about') }}" class="link nav-link">Apie</a>
                        <div class="navbar-nav">
                            @if (Route::has('login'))
                                <div class="d-flex hidden fixed top-0 right-0 px-6 py-4 sm:block ">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="link nav-link text-sm text-gray-700 dark:text-gray-500 underline">Pradinis</a>
                                    @else
                                        <a href="{{ route('login') }}" class="link nav-link text-sm text-gray-700 dark:text-gray-500 underline">Prisijungimas</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="link nav-link ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registracija</a>
                                    @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container mt-4">
                <div class="d-flex justify-content-center">
                    <div class="col-md-12 transbox">
                        <h1 class="welcome_title text-left p-6" >Jaunimo laisvalaikio centras Kaune</h1>
                        <p class="welcome_footer text-left p-2">Mūsų jaunoji karta, tai mūsų ateitis</p>
                        <a href="#contact" class="button_about">Plačiau apie mus</a>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer_welcome">
            <div class="footer text-center p-3" >© 2024 Darbą atliko Pijus Černiauskas</div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
