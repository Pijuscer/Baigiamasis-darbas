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
          <h1 class="about_pavadinimas text-center p-4">Visų vartotojų profiliai</h1>
          <div class="row justify-content-center">
            <div class="col-lg-8 transboxabout ">
              <table class="table table_style ">
                <thead class="table_thead">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="th_stilius">Vartotojo ID</th>
                    <th scope="col" class="th_stilius">Vardas</th>
                    <th scope="col" class="th_stilius">Pavardė</th>
                    <th scope="col" class="th_stilius">Telefono numeris</th>
                    <th scope="col" class="th_stilius">Adresas</th>
                    <th scope="col" class="th_stilius">Papildoma informacija</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($user_profiles as $user_profiles2)
                  <tr class="tr_stilius">
                    <th scope="row">{{ $user_profiles2->id}}</th>
                    <td class="th_stilius">{{$user_profiles2->user_id}}</td>
                    <td class="th_stilius">{{$user_profiles2->name}}</td>
                    <td class="th_stilius">{{$user_profiles2->surname}}</td>
                    <td class="th_stilius">{{$user_profiles2->telephone_number}}</td>
                    <td class="th_stilius">{{$user_profiles2->address}}</td>
                    <td class="th_stilius">{{$user_profiles2->additional_information}}</td>
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