@props(['name'])
@if(isset($name))
    @component('components.svg.'.$name, ['attributes'=>$attributes])
    @endcomponent
@endif
