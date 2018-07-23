@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pagination_item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="pagination_item_text" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="pagination_item">
                <a class="pagination_item_text" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="pagination_item disabled" aria-disabled="true">
                  <span class="pagination_item_text" >{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination_item active" aria-current="page">
                          <span class="pagination_item_text" >{{ $page }}</span>
                        </li>
                    @else
                        <li class="pagination_item">
                          <a class="pagination_item_text" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination_item">
                <a class="pagination_item_text" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="pagination_item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="pagination_item_text" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
