@if($items->count() > 0)
    @if($level > 1)
        <ul class="bg-white border rounded-sm transform hover:scale-100 hover:translate-x-100 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top paksuco-level-{{$level}} shadow z-{{$level}}">
    @elseif($level == 1)
        <ul class="bg-white border rounded-sm transform hover:scale-100 hover:translate-x-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top paksuco-level-{{$level}} shadow z-{{$level}}">
    @else
        <ul class="flex flex-row paksuco-level-{{$level}} z-{{$level}}">
    @endif
    @foreach($items as $menuitem)
        @if($level == 0)
        <li class="p-2 pr-5 mr-3 relative">
        @else
        <li class="p-2 pr-5 relative border-b">
        @endif
            @include("paksuco::menuitem", ["item" => $menuitem, "level" => $level])
        </li>
    @endforeach
    </ul>
@endif
