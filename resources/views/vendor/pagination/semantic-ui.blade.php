@if ($paginator->hasPages())
<!-- Full Pagination (Desktop) -->
<div class="ui pagination menu full-pagination">
    @if ($paginator->onFirstPage())
    <a class="item disabled" aria-disabled="true" aria-label="« Previous">
        <i class="left chevron icon"></i> Previous
    </a>
    @else
    <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="« Previous">
        <i class="left chevron icon"></i> Previous
    </a>
    @endif

    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <a class="item disabled" aria-disabled="true">{{ $element }}</a>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
    @else
    <a class="item" href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next »">
        Next <i class="right chevron icon"></i>
    </a>
    @else
    <a class="item disabled" aria-disabled="true" aria-label="Next »">
        Next <i class="right chevron icon"></i>
    </a>
    @endif
</div>

<!-- Simplified Pagination (Mobile) -->
@if ($paginator->hasPages())
<div class="ui pagination menu mobile-pagination">
    {{-- Previous Link --}}
    @if ($paginator->onFirstPage())
    <a class="item disabled" aria-disabled="true" aria-label="« Previous">
        <i class="left chevron icon"></i> Previous
    </a>
    @else
    <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="« Previous">
        <i class="left chevron icon"></i> Previous
    </a>
    @endif

    @php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    @endphp

    @if($last <= 5) {{-- If there are 5 or fewer pages, show them all --}} @for($i=1; $i <=$last; $i++) @if($i==$current) <a class="item active"
        href="#">{{ $i }}</a>
        @else
        <a class="item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @endif
        @endfor
        @else
        @if($current <= 2) {{-- For page 1 and 2: show pages 1, 2, 3, ... last --}} @for($i=1; $i <=3; $i++) @if($i==$current) <a class="item active"
            href="#">{{ $i }}</a>
            @else
            <a class="item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
            @endfor
            <span class="item">...</span>
            <a class="item" href="{{ $paginator->url($last) }}">{{ $last }}</a>
            @elseif($current == 3)
            {{-- For page 3: show 1, ... , 3, ... , last --}}
            <a class="item" href="{{ $paginator->url(1) }}">1</a>
            <span class="item">...</span>
            <a class="item active" href="#">{{ $current }}</a>
            <span class="item">...</span>
            <a class="item" href="{{ $paginator->url($last) }}">{{ $last }}</a>
            @elseif($current >= 4 && $current < $last - 1) {{-- For middle pages: show 1, ... , current, ... , last --}} <a class="item"
                href="{{ $paginator->url(1) }}">1</a>
                <span class="item">...</span>
                <a class="item active" href="#">{{ $current }}</a>
                <span class="item">...</span>
                <a class="item" href="{{ $paginator->url($last) }}">{{ $last }}</a>
                @else
                {{-- For the last two pages: show 1, ... , last-2, last-1, last --}}
                <a class="item" href="{{ $paginator->url(1) }}">1</a>
                <span class="item">...</span>
                @for($i = $last - 2; $i <= $last; $i++) @if($i==$current) <a class="item active" href="#">{{ $i }}</a>
                    @else
                    <a class="item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                    @endfor
                    @endif
                    @endif

                    {{-- Next Link --}}
                    @if ($paginator->hasMorePages())
                    <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next »">
                        Next <i class="right chevron icon"></i>
                    </a>
                    @else
                    <a class="item disabled" aria-disabled="true" aria-label="Next »">
                        Next <i class="right chevron icon"></i>
                    </a>
                    @endif
</div>
@endif

@endif