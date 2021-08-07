<!doctype html>
<html style="scroll-behavior: smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Deliveboo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="pad">
        <header>
            <div class="my_container">
              <div class="logo">
                <img src="/img/logow-notext.png" alt="logo">
                <a class="" href="{{ url('/') }}">
                    Deliveboo
                </a>
              </div>
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
              <div class="actions">
              <!-- Authentication Links -->
                @guest
                
                    <div>
                       <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg>
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                  @if (Route::has('register'))
                    <div >
                        <svg data-v-1f42fb90="" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path data-v-1f42fb90="" d="M17 3H7V6H2V20H22V6H17V3ZM15 6H9V5H15V6ZM4 8H20V11H4V8ZM20 12V18H4V12H9V14H15V12H20ZM10 12H14V13H10V12Z"></path></svg>
                         {{-- <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg> --}}
                        <a  href="{{ route('register') }}">Registrati</a>
                    </div>
                 @endif
                 @else
                    <div id="r_none">
                        <svg data-v-1f42fb90="" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path data-v-1f42fb90="" d="M15.55 11.8642L13.8012 13.6129L19.749 20.3375L18.2509 21.6625L12.3844 15.0298L5.70707 21.7071L4.29286 20.2929L11.0568 13.5289L9.67929 12.112L6.93679 14.8345L2.99365 8.15994L4.35279 2.93054L12.4737 12.112L14.1358 10.45L12.7929 9.1071L12.8008 7.68498L17.3008 3.28498L18.6991 4.715L14.9222 8.40798L15.55 9.03578L19.2929 5.29288L20.7071 6.7071L16.9642 10.45L17.5079 10.9937L21.3008 7.28498L22.6991 8.715L18.1991 13.115L16.7929 13.1071L15.55 11.8642ZM5.34352 7.06944L5.14324 7.84003L7.32097 11.6642L8.40646 10.6124L5.34352 7.06944Z"></path></svg>
                        {{-- <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg> --}}
                         <a  href="{{ route('register') }}">I miei ristoranti</a>
                    </div>
                     <div>
                        <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M2 13V11H22V13H2ZM2 19V17H22V19H2ZM2 7V5H22V7H2Z"></path></svg>
                         <a id="navbarDropdown my-link" class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             {{ Auth::user()->name }}
                         </a>
    
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 Esci
                             </a>
    
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                         </div>
                     </div>
                 @endguest
              </div>
            </div>
        </header>

        <main class="py-5">
            @yield('content')
        </main>

        <footer>
            <div class="my_container">
      
              <div class="top">
      
                <!-- Scopri Deliveroo -->
                <div class="f-info">
                  <h3>Scopri Deliveboo</h3>
                  <ul class="my-ul">
                    <li>
                      <a href="#">Investitori</a>
                      <a href="#">Chi siamo</a>
                      <a href="#">Ristoranti</a>
                      <a href="#">Altro</a>
                      <a href="#">Pressroom</a>
                      <a href="#">Il nostro blog</a>
                      <a href="#">Programmazione</a>
                      <a href="#">Design</a>
                      <a href="#">Lavora con noi</a>
                      <a href="#">Diventa nostro partner</a>

                    </li>
                  </ul>
                </div>
      
                <!-- Note legali -->
                <div class="f-info">
                  <h3>Note legali</h3>
                  <ul class="my-ul">
                    <li>
                      <a href="#">Termini & Condizioni</a>
                      <a href="#">Informativa sulla privacy</a>
                      <a href="#">Cookies</a>
                    </li>
                  </ul>
                </div>
      
                <!-- Aiuto -->
                <div class="f-info">
                  <h3>Aiuto</h3>
                  <ul class="my-ul">
                    <li>
                      <a href="#">Contatti</a>
                      <a href="#">FAQ</a>
                      <a href="#">Tipi di cucina</a>
                      <a href="#">Mappa del sito</a>
                    </li>
                  </ul>
                </div>
      
                <!-- app link -->
                <div class="f-info">
                  <h3>Porta Deliveboo con te</h3>
                  <a href="#">
                    <img src="https://www.tbus.it/img/appstore-ita.png" alt="">
                  </a>
                  <a href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Google_Play_Store_badge_IT.svg/1024px-Google_Play_Store_badge_IT.svg.png" alt="">
                  </a>
                </div>
              </div>
      
              <div class="bot">
                <div class="social">
                  <ul class="my-ul">
                    <li>
                      <a href="#">
                        <i class="fab fa-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fab fa-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                       <i class="fab fa-instagram"></i>
                      </a>
                    </li>
                  </ul>
                </div>
      
                <span>© 2021 Deliveboo</span>
              </div>
      
            </div>   
       </footer>
    </div>
</body>
</html>
