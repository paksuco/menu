@php
$hasChildren = $item->getChildren()->count() > 0;
@endphp
<a class="{{$container->getLinkClass($level,  $showActive && $item->active)}}"
    @if($hasChildren) href="#" @else href="{{$item->getLink()}}" @endif>
    <div class="flex items-center">
        @if($item->getIconClass())
        <i class="{{$container->getIconClass($level)}} {{$item->getIconClass()}}"></i>
        @endif
        <span class="{{$container->getTextClass($level)}}">{{$item->getTitle()}}</span>
    </div>
    @if($hasChildren)
    <i class="{{$container->getArrowClass($level)}}"></i>
    @endif
</a>
@if($hasChildren)
@include("paksuco-menu::menucontainer", [
    "container" => $item->getChildren()->setTheme($theme),
    "level" => $level + 1,
    "showActive" => $showActive,
    "activeVisible" => $activeVisible
])
@endif
