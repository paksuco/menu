<div class="group">
    <a class="text-blue-500 group-hover:text-blue-800 whitespace-no-wrap" href="{{$item->getLink()}}">
    @if($item->getIconClass())
        <i class="{{$item->getIconClass()}} text-gray-400 group-hover:text-gray-700"></i>&nbsp;
    @endif
        {{$item->getTitle()}}
    </a>
    @if($item->getChildren()->count() > 0)
    <i class="fa {{$level == 0 ? "fa-chevron-down" : "fa-chevron-right"}} paksuco-arrow absolute inset-y-0 right-{{$level == 0 ? 0 : 2 }} flex items-center justify-center origin-center"></i>
</div>
@include("paksuco::menucontainer", ["items" => $item->getChildren(), "level" => $level + 1])
@else
</div>
@endif
