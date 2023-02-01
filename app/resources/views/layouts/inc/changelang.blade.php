<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ config('laravellocalization.supportedLocales.' . app()->getLocale() . '.native') }}
    </a>
    @yield('lang')
</li>
