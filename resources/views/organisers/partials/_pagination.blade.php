<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        <div class="pagination-container margin-top-20 margin-bottom-40">
            <nav class="pagination">
                @if ($paginator->hasPages())
                    <ul>
                        @if ($paginator->onFirstPage())
                            <li class="disabled"><i class="sl sl-icon-arrow-left"></i></li>
                        @else
                            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="sl sl-icon-arrow-left"></i></a></li>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="current-page"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @if ($paginator->hasMorePages())
                             <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="sl sl-icon-arrow-right"></i></a></li>
                        @else
                             <li class="disabled"><i class="sl sl-icon-arrow-right"></i></li>
                        @endif
                    </ul>
                @endif
            </nav>
        </div>
    </div>
</div>



