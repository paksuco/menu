<nav class="relative paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}} {{$class}}" style="{{$style}}">
    {!! $menuManager->dump($key, $theme, $hoverable) !!}
</nav>
