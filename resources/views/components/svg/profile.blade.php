@php
    $width=24;
    $height=24;
@endphp

<svg width="{{$attributes['width']??$width}}"
        height="{{$attributes['height']??$height}}"
        viewBox="-5 0 56 56" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <title>profile</title>
    <path class="color-foreground" d="M24 4c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm0 6c3.31 0 6 2.69 6 6 0 3.32-2.69 6-6 6s-6-2.68-6-6c0-3.31 2.69-6 6-6zm0 28.4c-5.01 0-9.41-2.56-12-6.44.05-3.97 8.01-6.16 12-6.16s11.94 2.19 12 6.16c-2.59 3.88-6.99 6.44-12 6.44z" fill="#ffffff"/>
    <path d="M0 0h48v48h-48z" fill="none"/>
</svg>
