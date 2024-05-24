<div class="head-container">
  
  @auth
  @php
  $user=auth()->user();
  @endphp
    <nav>
      <h2>Cars Management</h2>
      <div class="input-search">
     </div>
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
                    <button  type="submit">
                        {{ __('Log out') }}
                    </button>
                </form>
            </li>
  
        </ul>
    </label>
      <img src="{{asset('images/'. $user->user_image)}}" alt="Profile Image">
      <span><i class="fa-regular fa-bell"></i></span>
      <span><i class="fa-solid fa-magnifying-glass"></i></span>
      
  </div>
   </nav>
   @endauth
 </div>