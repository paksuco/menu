@if($items->count() > 0)
    @if($level > 1)
        <ul x-show="open_{{$loop->index}}_{{$level-1}}" x-cloak class="bg-white border rounded-sm level-{{$level}} shadow z-{{$level}} absolute left-0 box-border top-0 transform translate-x-full">
    @elseif($level == 1)
        <ul x-show="open_{{$loop->index}}_{{$level-1}}" x-cloak class="bg-white border rounded-sm level-{{$level}} shadow z-{{$level}} absolute top-full left-0">
    @else
        <ul class="p-3 sm:p-0 flex flex-col sm:flex-row level-{{$level}} z-{{$level}}">
    @endif
    @foreach($items as $menuitem)
        @if($level == 0)
            @if($menuitem->getChildren()->count() > 0)
                <li class="px-3 py-2 pr-6 relative" x-data="{ open_{{$loop->index}}_{{$level}}: false }">
            @else
                <li class="px-3 py-2 relative">
            @endif
        @else
            <li class="p-2 pr-5 relative border-b" x-data="{ open_{{$loop->index}}_{{$level}}: false }">
        @endif
            @include("paksuco::menuitem", ["item" => $menuitem, "level" => $level])
        </li>
    @endforeach
    </ul>
@endif
