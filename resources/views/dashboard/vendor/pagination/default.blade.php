@if ($paginator->hasPages())

                                        <ul class="pagination m-0 ml-auto">
                                          @if ($paginator->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="15 6 9 12 15 18" /></svg>

                                                  @lang('pagination.previous')</a>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">@lang('pagination.previous')</a>
                                            </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($elements as $element)
                                                {{-- "Three Dots" Separator --}}
                                                @if (is_string($element))
                                                    <li class="disabled" class="page-item" aria-disabled="true"><a class="page-link" href="#">{{ $element }}</a></li>
                                                @endif

                                                {{-- Array Of Links --}}
                                                @if (is_array($element))
                                                    @foreach ($element as $page => $url)
                                                        @if ($page == $paginator->currentPage())
                                                            <li class="page-item activePagination" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            @if ($paginator->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
                                            </li>
                                              @else

                                              <li class="page-item disabled">
                                                  <a class="page-link" href="#">@lang('pagination.next')
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="9 6 15 12 9 18" /></svg>
                                                  </a>
                                              </li>

                                              @endif
                                        </ul>


                                    @endif
