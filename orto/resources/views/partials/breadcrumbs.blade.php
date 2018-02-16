
<ol class="breadcrumb">
    <li><a href="/">Página inicial</a></li>
    @foreach($items as $label => $url)
        @if($loop->last)
            <li class="active">
                {{ $label }}
            </li>
        @else
            <li>
                <a href="{{ $url }}">{{ $label }}</a>
            </li>
        @endif
    @endforeach
</ol>
