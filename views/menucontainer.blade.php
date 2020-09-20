@if($container->count() > 0)
<ul x-cloak class="{{$container->getULClass($level)}}" @if($level> 0) x-cloak
    x-show.transition="open_{{$random}}_{{$loop->index}}_{{$level-1}}" @endif
    >
    @foreach($container->sortBy("priority") as $menuitem)
    @php $childCount = $menuitem->getChildren()->count(); @endphp
    <li class="{{$container->getLIClass($level, $childCount)}}" @if($childCount || $level> 0) x-data="{
        open_{{$random}}_{{$loop->index}}_{{$level}}: {{$showActive && $menuitem->active ? 'true' : 'false'}} }" @endif
        @click.stop="open_{{$random}}_{{$loop->index}}_{{$level}} = !open_{{$random}}_{{$loop->index}}_{{$level}}"
        @if($activeVisible == false)
        @click.away="open_{{$random}}_{{$loop->index}}_{{$level}} = false"
        @endif
        @if($hoverable)
        @mouseenter="open_{{$random}}_{{$loop->index}}_{{$level}} = true"
        @mouseleave="open_{{$random}}_{{$loop->index}}_{{$level}} = false"
        @endif
        >
        @include("paksuco-menu::menuitem", ["item" => $menuitem, "level" => $level, "showActive" => $showActive])
    </li>
    @endforeach
</ul>
@endif
