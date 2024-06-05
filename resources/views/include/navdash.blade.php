<div class="head-container">

  @auth
        @php
            $user = auth()->user();
            // Extract the management part from the URL
            $currentPage = request()->segment(count(request()->segments())) . ' Management';
        @endphp
        <nav>
            <h2>
                {{ ucfirst($currentPage) }} <!-- Capitalize the first letter -->
            </h2>
      <div class="input-search">
     </div>
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
                <img src="{{ asset('images/' . $user->user_image)}}" alt="Profile Image">

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
   </nav>
   @endauth
 </div>
