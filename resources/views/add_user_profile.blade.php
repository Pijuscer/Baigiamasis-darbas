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
      <a href="{{ url('/my_user_profile') }}" class="btn btn-success btn-lg atgal">Atgal</a>
          <div class="d-flex justify-content-center">
            <div class="col-md-10">
              <h1 class="about_pavadinimas text-center p-4">Jūsų profilio užpildymas</h1>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="/add_user_profile" method="POST" class="row g-3 transboxuserprofileadd">
                @csrf
                <div class="col-md-4">
                  <label for="name" class="form-label add_label_text">Vardas</label>
                  <input value="{{ old('name') }}" type="text" class="form-control addUserProfileInput" id="name" name="name" placeholder="Įrašykite savo vardą">
                </div>
                <div class="col-md-4">
                  <label for="surname" class="form-label add_label_text">Pavardė</label>
                  <input value="{{ old('surname') }}" type="text" class="form-control addUserProfileInput" id="surname" name="surname" placeholder="Įrašykite savo pavardę">
                </div>
                <div class="col-md-4">
                  <label for="telephone_number" class="form-label add_label_text">Telefono numeris</label>
                  <input value="{{ old('telephone_number') }}" type="text" class="form-control addUserProfileInput" id="telephone_number" name="telephone_number" placeholder="Įrašykite savo telefono numerį">
                </div>
                <div class="col-md-5">
                  <label for="address" class="form-label add_label_text">Adresas</label>
                  <input value="{{ old('address') }}" type="text" class="form-control addUserProfileInput" id="address" name="address" placeholder="Įrašykite savo namų adresą">
                </div>
                <div class="col-md-7">
                  <label for="additional_information" class="form-label add_label_text">Papildoma svarbi informacija apie save</label>
                  <textarea value="{{ old('additional_information') }}" class="form-control addUserProfileInput" id="additional_information" name="additional_information" rows="2" placeholder="Įrašykite papildoma informacija apie save"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" style=" margin-top: 60px; margin-bottom:40px;">
                  <button type="submit" class="btn btn-success btn-lg">Išsaugoti</button>
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