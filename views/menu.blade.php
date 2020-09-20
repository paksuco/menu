<nav class="relative paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}} {{$class}}"
    x-cloak style="{{$style}}">
    @if(!empty($title))
    <div class="{{$titleClass}}">{{$title}}</div>
    @endif
    {!! $menuManager->dump($key, $theme, $hoverable, $showActive, $activeVisible) !!}
</nav>
