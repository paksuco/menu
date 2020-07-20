<nav class="relative paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}} {{$class}}" x-cloak style="{{$style}}">
    {!! $menuManager->dump($key, $theme, $hoverable) !!}
</nav>
