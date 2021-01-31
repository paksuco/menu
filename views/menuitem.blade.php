@php
$hasChildren = $item->getChildren()->count() > 0;
@endphp
<a class="{{$container->getLinkClass($level,  $showActive && $item->active)}} relative"
    @if($hasChildren) href="#" @else href="{{$item->getLink()}}" @endif>
    <div class="flex items-center">
        @if($item->getIconClass())
        <i class="{{$container->getIconClass($level)}} {{$item->getIconClass()}}"></i>
        @endif
        <span class="{{$container->getTextClass($level)}} flex-1">{{$item->getTitle()}}</span>
        @if(!empty($item->getBadge()))
        <span class="flex items-center justify-center px-2 py-0 ml-2 -mr-1 font-semibold leading-4 text-gray-800 bg-gray-200 rounded-lg" style="font-size:10px;padding-bottom: 2px">{{$item->getBadge()}}</span>
        @endif
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
