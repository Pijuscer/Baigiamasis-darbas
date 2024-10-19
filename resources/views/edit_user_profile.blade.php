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
        <div class="container mt-4">
          <div class="d-flex justify-content-center">
            <div class="col-md-10">
              <a href="{{ url('/all_users') }}" class="btn btn-success btn-lg atgal">Atgal</a>
              <h1 class="text-center p-4 about_pavadinimas">Vartotojo profilio redagavimas</h1>
              <form action="{{ route('my_user_profile.update', $users_profiles->id) }}" class="row g-3 transboxeventadd" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label add_label_text">Vartotojo vardas</label>
                        <input value="{{ $users_profiles->name }}" type="text" class="form-control editEventInput" id="name" name="name" aria-label="name" placeholder="Redaguoti vartotojo profilio vardą">
                    </div>
                    <div class="col-md-4">
                        <label for="surname" class="form-label add_label_text">Vartotojo pavardė</label>
                        <input value="{{ $users_profiles->surname }}" type="text" class="form-control editEventInput" id="surname" name="surname" aria-label="surname" placeholder="Redaguoti vartotojo profilio pavardę">
                    </div>
                    <div class="col-md-4">
                        <label for="telephone_number" class="form-label add_label_text">Telefono numeris</label>
                        <input value="{{ $users_profiles->telephone_number }}" type="text" class="form-control editEventInput" id="telephone_number" name="telephone_number" aria-label="telephone_number" placeholder="Redaguoti vartotojo telefono numerį">
                    </div>
                    <div class="col-md-5">
                        <label for="address" class="form-label add_label_text">Adresas</label>
                        <input value="{{ $users_profiles->address }}" type="text" class="form-control editEventInput" id="address" name="address" aria-label="address" placeholder="Redaguoti savo namų adresą">
                    </div>
                    <div class="col-md-7">
                        <label for="additional_information" class="form-label add_label_text">Papildoma svarbi informacija apie save</label>
                        <input value="{{ $users_profiles->additional_information }}" type="text" class="form-control editEventInput" id="additional_information" name="additional_information" aria-label="additional_information" placeholder="Redaguoti papildomą indormaciją apie save">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" style=" margin-top: 60px; margin-bottom:40px;">
                        <button type="submit" class="btn btn-success btn-lg">Redaguoti</button>
                    </div>
                  </div>
              </form>
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