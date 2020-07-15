{!! $menuManager->styles() !!}

<nav class="relative bg-gray-800 text-gray-100 shadow
    paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}}"
    style="z-index: 9999">
    {!! $menuManager->dump($key) !!}
</nav>
