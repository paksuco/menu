
{!! $menuManager->styles() !!}

<nav class="paksuco-menu shadow-sm paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}}">
    {!! $menuManager->dump($key) !!}
</nav>
