@if($container->count() > 0)
    <ul
        class="{{$container->getULClass($level)}}"
        @if($level > 0) x-cloak x-show="open_{{$random}}_{{$loop->index}}_{{$level-1}}" @endif
    >
        @foreach($container as $menuitem)
        <li class="{{$container->getLIClass($level, $menuitem->getChildren()->count())}}"
            @if($menuitem->getChildren()->count() || $level > 0) x-data="{ open_{{$random}}_{{$loop->index}}_{{$level}}: false }" @endif
            >
            @include("paksuco::menuitem", ["item" => $menuitem, "level" => $level])
        </li>
        @endforeach
    </ul>
@endif
