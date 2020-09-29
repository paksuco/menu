@php
$hasChildren = $item->getChildren()->count() > 0;
@endphp
<a class="{{$container->getLinkClass($level,  $showActive && $item->active)}} relative"
    @if($hasChildren) href="#" @else href="{{$item->getLink()}}" @endif>
    <div class="flex items-center">
        @if($item->getIconClass())
        <i class="{{$container->getIconClass($level)}} {{$item->getIconClass()}}"></i>
        @endif
        <span class="{{$container->getTextClass($level)}}">{{$item->getTitle()}}</span>
        @if(!empty($item->getBadge()))
        <span class="bg-gray-200 ml-2 font-semibold -mt-px rounded-full text-xs py-0 w-6
            text-gray-700 flex items-center text-center justify-center
            leading-4">{{$item->getBadge()}}</span>
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
