    <a class="@if($level == 0) text-gray-50 group-hover:text-gray-200 @else
    text-gray-700 group-hover:text-gray-900 @endif whitespace-no-wrap"
    @if($item->getChildren()->count() > 0)
    href="#" @click="open_{{$loop->index}}_{{$level}} = true" @click.away="open_{{$loop->index}}_{{$level}} = false"
    @else
    href="{{$item->getLink()}}"
    @endif
    >
        @if($item->getIconClass())
        <i class="{{$item->getIconClass()}}"></i>&nbsp;
        @endif
        {{$item->getTitle()}}
    </a>
@if($item->getChildren()->count() > 0)
    <i class="fa {{$level == 0 ? "fa-chevron-down" : "fa-chevron-right"}} text-sm
        absolute inset-y-0 text-white group-hover:text-gray-400 right-2 flex items-center justify-center origin-center"></i>
    @include("paksuco::menucontainer", ["items" => $item->getChildren(), "level" => $level + 1])
@endif
