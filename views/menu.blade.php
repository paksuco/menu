<nav class="relative paksuco-menu-{{\Illuminate\Support\Str::kebab($instance->getKey())}} {{$class}}"
    x-cloak style="{{$style}}">
    @if(!empty($title))
    <div class="{{$titleClass}}">{{$title}}</div>
    @endif
    {!! $instance->dump($theme, $hoverable, $showActive, $activeVisible) !!}
</nav>
