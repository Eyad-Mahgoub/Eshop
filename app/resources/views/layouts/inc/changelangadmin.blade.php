
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ config('laravellocalization.supportedLocales.' . app()->getLocale() . '.native') }}
    </a>
    <ul class="dropdown-menu">
        @foreach (config('laravellocalization.supportedLocales') as $key => $local)
            @if ($key != app()->getLocale())
                <li>
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, null, [], true) }}">
                        {{ $local['native'] }}
                    </a>
                </li>
            @endif

        @endforeach
    </ul>
</li>
