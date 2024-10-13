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
                        <a href="{{ url('/cares') }}" class="link nav-link">Profilis</a>
                        <a href="{{ url('/cares') }}" class="link nav-link">Renginiai</a>
                        <a href="{{ url('/prices') }}" class="link nav-link">Stovyklos</a>
                        <a href="{{ url('/prices') }}" class="link nav-link">Konsultacijos</a>
                        <a href="{{ url('/about') }}" class="link nav-link">Apie</a>
                        <a href="{{ url('/all_users') }}" class="link nav-link">Rolės</a>
                        <div class="dropdown">
                          @if(Auth::user() != null)
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                          </button>
                          @endif
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button type="submit" class="dropdown-item nav_dropdown">Atsijungti</button>
                          </form>
                        </ul>
                      </div> 
                    </div>
                </div>
            </nav>
        </header>
      <main>
      <div class="container mt-4">
      <a href="{{ url('/my_user_profile') }}" class="btn btn-success btn-lg back_button">Atgal</a>
          <div class="d-flex justify-content-center">
            <div class="col-md-10">
              <h1 class="about_pavadinimas text-center p-4">Renginiai</h1>
              <div class="row ">
                        <!-- Kiekvienai picai sukuriama forma kurios iš kontrolerio -->
                        @foreach ($events as $event)
                        <form action="{{ route('events.show', $event->id) }}" method="GET" class="col-sm mx-auto d-flex justify-content-center form_style">
                        @csrf
                            <div class="card card_style  " style="width: 20rem;">
                                <img src="{{ asset('storage/'.$event->event_foto) }}" class="card-img-top pizzas_dashboard" alt="..." name="pizza_foto">
                                <div class="card-body">
                                    <h5 class="card-title dashboard_card_title">{{$event->event_name}}</h5>
                                    <h5 class="card-title dashboard_card_title2">Renginio data</h5>
                                    <p class="card-text dashboard_card_text">{{$event->event_date}}</p>
                                    <h5 class="card-title dashboard_card_title2">Renginio adresas</h5>
                                    <p class="card-text dashboard_card_text">{{$event->event_address}}</p>
                                </div>
                                
                                @if (Auth::check() && (Auth::user()->roles == "Administratorius" || (isset($userProfile) && $userProfile->verified == true)))
                                  <button type="submit" class="btn btn-success btn-lg btn_more">Plačiau</button>
                                @endif
                              
                                
                               
                            </div>
                            </form>
                        @endforeach
                    </div>
            </div>
          </div>
        </div>
      </main>
      <footer>
        <div class="footer text-center p-3 all_footer">© 2024 Darbą atliko Pijus Černiauskas</div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>