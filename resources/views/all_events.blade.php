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
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
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
      @if (session('message_user_edit'))
                <div class="alert alert-success">{{session('message_user_edit')}}</div>
              @endif
      <div class="container mt-4">
          <a href="{{ url('/my_user_profile') }}" class="btn btn-success btn-lg atgal">Atgal</a>
          <h1 class="about_pavadinimas text-center p-4">Visi renginiai</h1>
          <div class="row justify-content-center">
            <div class="col-lg-11 transboxabout ">
              <table class="table table_style ">
                <thead class="table_thead">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="th_stilius">Renginio pavadinimas</th>
                    <th scope="col" class="th_stilius">Renginioi organizatorius</th>
                    <th scope="col" class="th_stilius">Renginio adresas</th>
                    <th scope="col" class="th_stilius">Renginio laikas ir valanda</th>
                    <th scope="col" class="th_stilius">Renginio nuotrauka</th>
                    <th scope="col" class="th_stilius">Papildoma informacija apie renginį</th>
                    <th scope="col" class="th_stilius">Renginio dalyvių skaičius</th>
                    <th scope="col" class="th_stilius">Renginio vietovės ilgumos koordinatės</th>
                    <th scope="col" class="th_stilius">Renginio vietovės platumos koordinatės</th>
                    <th scope="col" class="th_stilius">Redaguoti</th>
                    <th scope="col" class="th_stilius">Ištrinti</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                  <tr class="tr_stilius">
                    <th scope="row">{{ $event->id}}</th>
                    <td class="th_stilius">{{$event->event_name}}</td>
                    <td class="th_stilius">{{$event->event_organizer}}</td>
                    <td class="th_stilius">{{$event->event_address}}</td>
                    <td class="th_stilius">{{$event->event_date}}</td>
                    <td class="th_stilius"><img src="{{ asset('storage/'.$event->event_foto) }}" width="50" height="50" class="img img-responsive"/></td>
                    <td class="th_stilius">{{$event->event_more_info}}</td>
                    <td class="th_stilius">{{$event->event_number_of_participants}}</td>
                    <td class="th_stilius">{{$event->event_longitude_coordinate}}</td>
                    <td class="th_stilius">{{$event->event_latitude_coordinate}}</td>
                    <td class="th_stilius">
                        <a class='no-underline btn btn-warning btn-sm' href="/all_events/edit/{{$event->id }}">Redaguoti</a>
                    </td>
                    <td class="th_style">
                        <a class='no-underline btn btn-danger btn-sm' href="/all_events/remove/{{$event->id }}">Ištrinti</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
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