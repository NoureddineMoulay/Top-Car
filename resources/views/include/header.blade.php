<header class="header" data-header>
  <div class="container">

    <div class="overlay" data-overlay></div>

    <a href="#" class="logo">
      <img src="./images/logo.svg" alt="Ridex logo">
    </a>

    <nav class="navbar" data-navbar>
      <ul class="navbar-list">

        <li>
          <a href="#home" class="navbar-link selected-link" data-nav-link>Home</a>
        </li>

        <li>
          <a href="#featured-car" class="navbar-link" data-nav-link>Our cars</a>
        </li>

        <li>
          <a href="#" class="navbar-link" data-nav-link>About us</a>
        </li>
        <li>
          <a href="#blog" class="navbar-link" data-nav-link>Contact Us</a>
        </li>

      </ul>
    </nav>

    <div class="header-actions">
      @guest
      <a href="{{ url('/register') }}" class="btn explore" aria-labelledby="aria-label-txt">
          <ion-icon name="car-outline"></ion-icon>
          <span id="aria-label-txt">Register</span>
      </a>
      <a href="{{ url('/login') }}" class="lgn-link">Login</a>
  @endguest
  
  @auth
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn explore">
              {{ __('Log Out') }}
          </button>
      </form>
  @endauth
  
      <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
        <span class="one"></span>
        <span class="two"></span>
        <span class="three"></span>
      </button>

    </div>

  </div>
</header>