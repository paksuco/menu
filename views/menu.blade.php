<nav class="relative paksuco-menu-{{\Illuminate\Support\Str::kebab($key)}} {{$class}}" x-cloak style="{{$style}}">
    @if(!empty($title))
    <div class="{{$titleclass}}">{{$title}}</div>
    @endif
    {!! $menuManager->dump($key, $theme, $hoverable) !!}
</nav>
