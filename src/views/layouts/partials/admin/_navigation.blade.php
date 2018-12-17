<nav class="nav">
    <div class="nav__wrapper--fluid">
        <div class="nav__no__brand"></div>
        <div class="nav__navicon"></div>
        <div class="nav__links__wrapper nav__links--left">

            <ul class="nav__links">
                <li class="nav__links__item search__wrapper">
                    <input class="form__item search__input" type="search">
                </li>
            </ul>
        </div>
        <div class="nav__links__wrapper nav__links--right">
            <ul class="nav__links">
                @auth
                    <li class="nav__links__item nav__links__item--dropdown">
                        <a class="nav__avatar" href="#">
                            <img src="{{ asset('/img/admin/avatar-mini.jpg') }}" class="nav__avatar__img"> {{ Auth::user()->name }}</a>
                        <ul class="nav__links">
                            <router-link class="nav__links__item" tag="li" to="profile"><a>Profile</a></router-link>
                            <li class="nav__links__item">
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
    <div class="nav__shadow"></div>
</nav>
