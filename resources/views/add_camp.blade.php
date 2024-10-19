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
              <h1 class="about_pavadinimas text-center p-4">Stovyklos užpildymas</h1>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="/add_camp" method="POST" class="row g-3 transboxeventadd" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                  <label for="camp_name" class="form-label add_label_text">Stovyklos pavadinimas</label>
                  <input value="{{ old('camp_name') }}" type="text" class="form-control addEventInput" id="camp_name" name="camp_name" placeholder="Įrašykite stovyklos pavadinimą">
                </div>
                <div class="col-md-4">
                  <label for="camp_organizer" class="form-label add_label_text">Stovyklos organizatorius</label>
                  <input value="{{ old('camp_organizer') }}" type="text" class="form-control addEventInput" id="camp_organizer" name="camp_organizer" placeholder="Įrašykite stovyklos organizatorių">
                </div>
                <div class="col-md-4">
                  <label for="camp_address" class="form-label add_label_text">Stovyklos adresas</label>
                  <input value="{{ old('camp_address') }}" type="text" class="form-control addEventInput" id="camp_address" name="camp_address" placeholder="Įrašykite stovyklos adresą">
                </div>
                <div class="col-md-5 mx-auto center">
                    <label for="camp_arrival_date" class="form-label add_label_text">Stovyklos pradžios laikas ir valanda</label>
                    <input class="addEventInput centered-input" type="datetime-local" id="camp_arrival_date" name="camp_arrival_date">
                </div>
                <div class="col-md-5 mx-auto center">
                    <label for="camp_leave_date" class="form-label add_label_text">Stovyklos pabaigos laikas ir valanda</label>
                    <input class="addEventInput centered-input" type="datetime-local" id="camp_leave_date" name="camp_leave_date">
                </div>
                <div class="col-md-5 mx-auto center">
                    <label for="formFile" class="form-label add_label_text">Stovyklos nuotrauka</label>
                    <input value="{{ old('camp_foto') }}" class="form-control addEventInput" type="file" id="formFile" name="camp_foto">
                </div>
                <div class="col-md-7 mx-auto center">
                  <label for="camp_more_info" class="form-label add_label_text">Papildoma informacija apie stovyklą</label>
                  <textarea value="{{ old('camp_more_info') }}" class="form-control addEventInput" id="camp_more_info" name="camp_more_info" rows="2" placeholder="Įrašykite papildomą informaciją apie stovyklą"></textarea>
                </div>
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label for="camp_number_of_participants" class="form-label add_label_text">Renginio dalyvių skaičius</label>
                    <input value="{{ old('camp_number_of_participants') }}" type="text" class="form-control addEventInput" id="camp_number_of_participants" name="camp_number_of_participants" placeholder="Įrašykite stovyklos dalyvių skaičių">
                  </div>
                  <div class="col-md-4 mx-auto center">
                      <label for="camp_longitude_coordinate" class="form-label add_label_text">Stovyklos vietovės ilgumos koordinatės</label>
                      <input value="{{ old('camp_longitude_coordinate') }}" type="text" class="form-control addEventInput" id="camp_longitude_coordinate" name="camp_longitude_coordinate" placeholder="Įrašyti stovyklos vietovės ilgumos koordinates">
                  </div>
                  <div class="col-md-4 mx-auto center">
                      <label for="camp_latitude_coordinate" class="form-label add_label_text">Stovyklos vietovės platumos koordinatės</label>
                      <input value="{{ old('camp_latitude_coordinate') }}" type="text" class="form-control addEventInput" id="camp_latitude_coordinate" name="camp_latitude_coordinate" placeholder="Įrašyti stovyklos vietovės platumos koordinates">
                  </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" style=" margin-top: 50px; margin-bottom:30px;">
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