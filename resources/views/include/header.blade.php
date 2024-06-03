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
              @php
                  $user = auth()->user();
                  $notifications = $user->notifications; // Assuming you passed notifications to the view
              @endphp
              <div class="profile-notif">
                  <label class="dropdown">
                      <div class="dd-button">
                          Hi, {{ $user->name }}
                      </div>

                      <input type="checkbox" class="dd-input" id="test">

                      <ul class="dd-menu">
                          <li><a href="/profile" style="text-decoration: none;">Profile</a></li>
                          <li>
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <button type="submit">
                                      {{ __('Log out') }}
                                  </button>
                              </form>
                          </li>
                      </ul>
                  </label>
                  <img src="{{ asset('images/' . $user->user_image) }}" alt="Profile Image">

                  <div class="notifications">
    <span id="notification-bell">
        <i class="fa-regular fa-bell {{ auth()->user()->unreadNotifications->count() > 0 ? 'has-notifications' : '' }}"></i>
    </span>
                      @if(auth()->user()->unreadNotifications->count() > 0)
                          <span class="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                      @endif

                      <div class="notification-dropdown">
                          @if(auth()->user()->unreadNotifications->count() > 0)
                              <ul>
                                  @foreach(auth()->user()->unreadNotifications as $notification)
                                      <li>
                                          <a href="{{ url('/reservations/' . $notification->data['booking_id']) }}">
                                              {{ $notification->data['message'] }}
                                          </a>
                                          <br>
                                          <small>{{ \Carbon\Carbon::parse($notification->created_at)->format('M d, Y h:i A') }}</small>
                                      </li>
                                  @endforeach
                              </ul>
                          @else
                              <p>No notifications</p>
                          @endif
                      </div>
                  </div>

                  <span><i class="fa-solid fa-magnifying-glass"></i></span>
              </div>
          @endauth


          <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
        <span class="one"></span>
        <span class="two"></span>
        <span class="three"></span>
      </button>

    </div>

  </div>
</header>
