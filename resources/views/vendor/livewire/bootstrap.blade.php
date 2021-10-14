<div class="pagination-area " style="margin-top: 0px !important;" >
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <div class="pagination-number" >
            <ul class="">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class=" disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="fa fa-angle-{{LaravelLocalization::getCurrentLocale() == 'en' ? 'left' : 'right'}}"></i>
                    </li>
                @else
                    <li class="">
                        <a  dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-angle-{{LaravelLocalization::getCurrentLocale() == 'en' ? 'left' : 'right'}}"></i></a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class=" disabled" aria-disabled="true">{{ $element }}</li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}" aria-current="page"><a href="javascript:void(0)">{{ $page }}</a> </li>
                            @else
                                <li class="" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"><a  class="" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="">
                        <a  dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')"><i class="fa fa-angle-{{LaravelLocalization::getCurrentLocale() == 'ar' ? 'left' : 'right'}}"></i></a>
                    </li>
                @else
                    <li class=" disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-{{LaravelLocalization::getCurrentLocale() == 'ar' ? 'left' : 'right'}}"></i>
                    </li>
                @endif
            </ul>
        </div>
    @endif
</div>
