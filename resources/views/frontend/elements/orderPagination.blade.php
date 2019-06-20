@if ($paginator->hasPages())
    <div class="sv-pagination">
        <div class="container">
            <div class="row">
                <ul>
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="blank">{{ $element }}</li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="current"><a href="javascript:void(0);">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ r('orderhistory', ['orderId' => __('translations.urlPage'), 'pageId' => $page]) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endif
