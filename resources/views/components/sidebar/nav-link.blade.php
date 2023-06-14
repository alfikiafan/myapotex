@props(['route','name'])

<a class="nav-link {{ request()->routeIs($route) ? ' active' : '' }}" href="{{ route($route) }}">
    <x-sidebar.nav-svg :name="$name"/>
    <span class="nav-link-text ms-1">{{ucwords($name)}}</span>
</a>
