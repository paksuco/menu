@if($container->count() > 0)
<ul x-cloak class="{{$container->getULClass($level)}}" @if($level> 0) x-cloak
    x-show.transition="open_{{$random}}_{{$loop->index}}_{{$level-1}}" @endif
    >
    @foreach($container as $menuitem)
    @php $childCount = $menuitem->getChildren()->count(); @endphp
    <li class="{{$container->getLIClass($level, $childCount)}}" @if($childCount || $level> 0) x-data="{
        open_{{$random}}_{{$loop->index}}_{{$level}}: false }" @endif
        @click.stop="open_{{$random}}_{{$loop->index}}_{{$level}} = !open_{{$random}}_{{$loop->index}}_{{$level}}"
        @click.away="open_{{$random}}_{{$loop->index}}_{{$level}} = false"
        @if($hoverable)
        @mouseenter="open_{{$random}}_{{$loop->index}}_{{$level}} = true"
        @mouseleave="open_{{$random}}_{{$loop->index}}_{{$level}} = false"
        @endif
        >
        @include("paksuco::menuitem", ["item" => $menuitem, "level" => $level])
    </li>
    @endforeach
</ul>
@endif
