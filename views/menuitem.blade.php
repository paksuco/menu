<a class="{{$container->getLinkClass($level)}}" @if($item->getChildren()->count() > 0)
    href="#" @click="open_{{$loop->index}}_{{$level}} = true"
    @click.away="open_{{$loop->index}}_{{$level}} = false" @else
    href="{{$item->getLink()}}" @endif
    >
    @if($item->getIconClass())
    <i class="{{$item->getIconClass()}}"></i>&nbsp;
    @endif
    {{$item->getTitle()}}
</a>
@if($item->getChildren()->count() > 0)
<i class="{{$container->getIconClass($level)}}"></i>
@include("paksuco::menucontainer", ["container" => $item->getChildren(), "level" => $level + 1])
@endif
