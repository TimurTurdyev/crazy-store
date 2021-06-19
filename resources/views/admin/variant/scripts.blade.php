@push('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        var $tablePrices = $('.table-prices');
        console.log($tablePrices)
        $tablePrices.each(function (i, table) {
            var $table = $(table);

            $table.on('click', '.btn-danger', function () {
                $(this).closest('tr').remove();
            });

            $table.on('click', '.btn-success', function () {
                var $tBody = $table.children('tbody');
                var count = $tBody.find('tr').length;
                var row = $('#price_row').html().replace(/\{index\}/gi, count);
                $tBody.append($(row));
            });
        });

        var $cardImages = $('.card-photos');

        $cardImages.each(function (i, images) {
            var $images = $(images);

            $images.on('change', '.input_image_hidden', function () {
                var src = location.origin + '/' + $(this).val();
                $(this).prev().attr('href', src).children('img').attr('src', src);
            });

            $images.on('click', '.image_delete', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();

                $images.find('tbody tr').each(function (index, item) {
                    $(this).find('input[name*="photos"]').each(function (i, input) {
                        var inputName = $(input).attr('name').replace(/photos\[\d{0,}\]/gi, 'photos[' + index + ']');
                        var inputId = $(input).attr('id');
                        console.log(inputId)
                        if (inputId) {
                            inputId = inputId.replace(/input-photos-\d{0,}/gi, 'input-photos-' + index);
                        }
                        $(input).attr('name', inputName);
                        if (inputId) {
                            $(input).attr('id', inputId);
                        }
                    });

                    $(this).find('button[data-inputid]').each(function (i, button) {
                        var inputId = $(button).data('inputid').replace(/input-photos-\d{0,}/gi, 'input-photos-' + index);
                        console.log(inputId)
                        if (inputId) {
                            $(button).data('inputid', inputId);
                        }
                    });
                });
            });

            $images.find('.add_image').on('click', function (event) {
                event.preventDefault();
                var $tableImage = $images.find('table tbody');
                var count = $tableImage.children().length;
                var imageRow = $('#image_row').html().replace(/\{index\}/gi, count);
                $tableImage.append(imageRow);
            });
        });
    </script>
    <script type="template/html" id="price_row">
        <tr>
            <td>
                new
                <input type="hidden" name="prices[{index}][id]" value="">
            </td>
            <td>
                <select name="size_id" class="form-control">
                    <option value="null">-- Выберите --</option>
                    @foreach( $sizes ?? [] as $size )
                        <option value="{{ $size->id }}">
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="prices[{index}][cost]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][price]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][quantity]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][discount]" value="0" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </script>
    <script type="template/html" id="image_row">
        <tr>
            <td>
                <a href="{{ asset('images/placeholder.png') }}" data-toggle="lightbox">
                    <img src="{{ asset('images/placeholder.png') }}"
                         class="image img-fluid img-size-64">
                </a>
                <input type="hidden" value="{{ asset('images/placeholder.png') }}" name="photos[{index}][path]" id="input-photos-{index}"
                       class="input_image_hidden">
            </td>
            <td>
                <input type="number" name="photos[{index}][sort_order]" value="{index}" class="form-control">
            </td>
            <td>
                <button class="btn btn-success popup_selector" data-inputid="input-photos-{index}">+</button>
            </td>
            <td>
                <button class="btn btn-danger image_delete">x</button>
            </td>
        </tr>
    </script>
@endpush
