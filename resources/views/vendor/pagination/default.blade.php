@if ($paginator->hasPages())
    <div class="float-right pagination">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item page-pre"><a disabled="true" class="page-link" href="#">‹</a></li>
            @else
                <li class="page-item page-pre"><a disabled="true" class="page-link"
                                                  href="{{ $paginator->previousPageUrl() }}">‹</a></li>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item"><a disabled="true" class="page-link" href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item page-next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">›</a></li>
            @else
                <li class="page-item page-next"><a disabled="true" class="page-link" href="#">›</a></li>
            @endif
        </ul>
    </div>
@endif
