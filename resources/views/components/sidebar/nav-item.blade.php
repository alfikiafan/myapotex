@props(['route','name'])

<li class="nav-item">
    <x-sidebar.nav-link :route="$route" :name="$name"/>
</li>
