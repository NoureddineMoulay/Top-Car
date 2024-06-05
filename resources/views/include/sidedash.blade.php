<div class="asidebar-container">
    <div class="logo"><img src="/images/Group 1.png" alt=""></div>
    <aside>
        <ul>
            <li>
                <a href="{{ route('cars.index') }}">
                    <div class="icons {{ Request::is('cars*') ? 'active' : '' }}">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <div class="icons {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('bookings.list') }}">
                    <div class="icons {{ Request::is('bookings*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('transactions.index') }}">
                    <div class="icons {{ Request::is('transactions*') ? 'active' : '' }}">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ url('/profile') }}">
                    <div class="icons {{ Request::is('profile*') ? 'active' : '' }}">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                </a>
            </li>
        </ul>
    </aside>
</div>
