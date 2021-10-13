@if ($paginator->hasPages())
<!-- Pagination -->
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="javascript:void(0)" class="next">&lt;</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="prev">&lt;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="javascript:void(0);" class="current">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="next">&gt;</a></li>
            {{-- <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <span><i class="fa fa-angle-double-right"></i></span>
                </a>
            </li> --}}
        @else
            <li>
                <a href="javascript:void(0)" class="prev">&gt;</a>
            </li>
        @endif
    </ul>
<!-- Pagination -->
@endif