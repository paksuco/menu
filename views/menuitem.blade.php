@php $hasChildren = $item->getChildren()->count() > 0; @endphp
<a class="{{$container->getLinkClass($level)}}" @if($hasChildren) href="#" @else href="{{$item->getLink()}}" @endif>
    <div>
        @if($item->getIconClass())
        <i class="{{$item->getIconClass()}}"></i>&nbsp;
        @endif
        {{$item->getTitle()}}</div>
    @if($hasChildren)
    <i class="{{$container->getIconClass($level)}}"></i>
    @endif
</a>
@if($hasChildren)
@include("paksuco::menucontainer", ["container" => $item->getChildren()->setTheme($theme), "level" => $level + 1])
@endif
