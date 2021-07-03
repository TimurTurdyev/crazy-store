<ul class="nav nav-vertical" id="filterNav">
    @if( ($categories = $filter->get('categories', collect()))->count() )
        <li class="nav-item">
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="#groupCollapse">
                Категории товара
            </a>
            <div class="collapse show" id="groupCollapse">
                <div class="form-group">
                    <ul class="list-styled mb-0" id="productsNav">
                        @foreach( $categories as $category )
                            <li class="list-styled-item">
                                <a class="list-styled-link"
                                   href="{{ route('catalog', $category->id) }}?group={{ $group->id }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
    @endempty

    @if( ($groups = $filter->get('groups', collect()))->count() )
        @php
            $params = request()->get('group') ?? [];

            if (is_string($params)) {
                $params = explode('.', $params);
            }
        @endphp
        <li class="nav-item">
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="#groupCollapse">
                Группа товара
            </a>
            <div class="collapse show" id="groupCollapse">
                <div class="form-group form-group-overflow mb-6">
                    <div class="list">
                        @foreach( $groups as $group )
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" name="group" id="group_id_{{ $group->id }}"
                                       value="{{ $group->id }}"
                                       type="checkbox"
                                       @if( in_array($group->id, $params) )
                                       checked
                                    @endif
                                >
                                <label class="custom-control-label" for="group_id_{{ $group->id }}">
                                    {{ $group->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
    @endempty

    @if( ($brands = $filter->get('brands', collect()))->count() )
        @php
            $params = request()->get('brand') ?? [];

            if (is_string($params)) {
                $params = explode('.', $params);
            }
        @endphp
        <li class="nav-item">
            <!-- Toggle -->
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="#brandCollapse">
                Бренд
            </a>
            <!-- Collapse -->
            <div class="collapse show" id="brandCollapse">
                <!-- Search -->
                <div class="form-group form-group-overflow mb-6">
                    <div class="list">
                        @foreach( $brands as $brand )
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" name="brand" id="brand_{{ $brand->id }}"
                                       value="{{ $brand->id }}"
                                       type="checkbox"
                                       @if( in_array($brand->id, $params) )
                                       checked
                                    @endif
                                >
                                <label class="custom-control-label" for="brand_{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
    @endif

    @if( ($sizes = $filter->get('sizes', collect()))->count() )
        @php
            $params = request()->get('size') ?? [];

            if (is_string($params)) {
                $params = explode('.', $params);
            }
        @endphp
        <li class="nav-item">
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="#sizeCollapse">
                Размер
            </a>
            <div class="collapse show" id="sizeCollapse" data-toggle="simplebar"
                 data-target="#sizeGroup">
                <div class="form-group form-group-overlow mb-6" id="sizeGroup">
                    @foreach( $sizes as $size )
                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                            <input class="custom-control-input" name="size" id="size_{{ $size->id }}"
                                   value="{{ $size->id }}" type="checkbox"
                                   @if( in_array($size->id, $params) )
                                   checked
                                @endif
                            >
                            <label class="custom-control-label" for="size_{{ $size->id }}">
                                {{ $size->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
    @endif
</ul>

<button type="button" class="btn btn-primary btn-block" onclick="location.href = location.href.split('?')[0]">Очистить
</button>
@push('scripts')
    <script>
        var timer = null;

        $('#filterNav').on('change', 'input', function () {
            if (timer) clearTimeout(timer);
            var check = {}
            timer = setTimeout(function () {
                $('#filterNav input:checked').each(function () {
                    var $item = $(this);
                    if (!check[$item.attr('name')]) {
                        check[$item.attr('name')] = [];
                    }

                    if (check[$item.attr('name')].indexOf($item.val()) === -1) {
                        check[$item.attr('name')].push($item.val());
                    }
                });

                var params = [];

                for (var key in check) {
                    params.push(key + '=' + check[key].join('.'));
                }
                params = params.join('&');
                location.href = location.href.split('?')[0] + (params ? '?' + params : '');
            }, 1000);
        });

        var params = {};
        var queryPath = '{{ request()->getQueryString() }}'.split('&amp;');

        $.each(queryPath, function (i, v) {
            var p = v.split('=');
            if (p.length > 1)
                params[p[0]] = p[1].split('.');
        });

        $('#filterNav input').each(function () {
            var $item = $(this);
            if ($item.prop('checked') && !params[$item.attr('name')]) {
                $item.prop('checked', false);
            }
        });
    </script>
@endpush
