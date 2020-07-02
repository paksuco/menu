
{!! $menuManager->styles() !!}

<nav class="paksuco-menu shadow-sm paksuco-menu-{{\Illuminate\Support\Str::slug($key)}}">
    {!! $menuManager->dump($key) !!}
</nav>
