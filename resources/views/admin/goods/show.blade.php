@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-editable/css/bootstrap-editable.css') }}">
@endsection()

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Baju</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/goods') }}">Master Baju</a></li>
                            <li class="breadcrumb-item active">{{ $goods->goods_name }} </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Picture</h3>
                                <div class="card-tools">
                                    <a href="{{ route('files.show', $goods->id) }}" class="btn btn-info btn-xs"><b> Add
                                            Foto </b>
                                    </a>

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($goods->masterFileUploads as $key => $value)
                                        <div class="col-6 col-sm">
                                            <a href="{{ $value->pathImg() }}" data-toggle="lightbox"
                                                data-title="{{ $goods->goods_name }} {{ $loop->iteration }}"
                                                data-gallery="gallery">
                                                <img src="{{ $value->pathImg() }}"
                                                    class="img-fluid mb-2 rounded mx-auto d-block" style="max-height :83px"
                                                    alt="{{ $goods->goods_name }} {{ $loop->iteration }}" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="callout callout-info">
                            <a id="editProduct" data-toggle="modal" data-target='#editProductModal'
                                data-id="{{ $value->id }}" class="btn btn-primary btn-xs float-right text-white"><i
                                    class="fas fa-pencil-alt fa-xl"></i></a>

                            <h5 class="text-primary"><i class="fas fa-tshirt"></i> {{ $goods->goods_name }} </h5>
                            <h5 class="text-secondary">Description :</h5>
                            <p>
                                {{ $goods->description }}
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <b>Base Price : </b> @currency($goods->base_price)
                                    </div>
                                    <div class="alert alert-secondary">
                                        <b>Category: </b> {{ $goods->category->name }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <b>Total Quantity : </b> {{ $goods->total_qty }}
                                    </div>
                                    <div class="alert {{ $goods->is_active ? 'alert-primary' : 'alert-Light' }}">
                                        <b>Category: </b> {{ $goods->status() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Modal Edit Product --}}
                <div class="modal fade" id="editProductModal">
                    <div class="modal-dialog">
                        <form id="productdata">
                            <div class="modal-content">
                                <input type="hidden" id="goods_id" name="goods_id" value="{{ $goods->id }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Product {{ $goods->goods_name }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="goods_name"><strong>Product Name</strong></label>
                                        <input type="text" class="form-control form-control-sm" id="goods_name"
                                            name="goods_name" value="{{ $goods->goods_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><strong>Description</strong></label>
                                        <textarea class="form-control form-control-sm" rows="2" placeholder="Enter ..."
                                            name="description">{{ $goods->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="base_price"><strong>Base Price</strong></label>
                                        <input type="text" class="form-control form-control-sm" id="base_price"
                                            name="base_price" value="{{ $goods->base_price }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputBorder"><strong>Category</strong></label>
                                                <select class="custom-select form-control-border" name="category_id">
                                                    @foreach ($category as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ $goods->category_id == $value->id ? 'selected' : '' }}>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 align-items-center">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="is_active1"
                                                    name="is_active" {{ $goods->is_active == 0 ? 'checked' : '' }}
                                                    value="0">
                                                <label for="is_active1" class="custom-control-label">Non-Active</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="is_active2"
                                                    name="is_active" {{ $goods->is_active == '1' ? 'checked' : '' }}
                                                    value="1">
                                                <label for="is_active2" class="custom-control-label">Is Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="saveProduct">Save changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Color - {{ $goods->goods_name }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-outline-info btn-xs" id="addCardColor"><b> Add
                                            Color </b></button>

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="card-color"></div>
                                    @foreach ($goods->goodsColors as $key => $color)
                                        <div class="col-md-4 col-sm-6 card-color">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"><b>
                                                            <a href="#" class="xcolor"
                                                                data-pk="{{ $color->id }}" data-name="color">
                                                                {{ $color->color }}</a>
                                                        </b>
                                                        &nbsp; / &nbsp;
                                                        <a href="#" class="xcolor" data-pk="{{ $color->id }}"
                                                            data-name="additional_price"
                                                            data-value="{{ $color->additional_price }}">
                                                            <span class="badge bg-primary">
                                                                + @currency($color->additional_price)
                                                            </span>
                                                        </a>
                                                    </h3>

                                                    <div class="card-tools">
                                                        <form action="{{ route('goods.deletecolor', $color->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" id="addSize"
                                                                data-value="{{ $color->id }}"
                                                                class="btn btn-outline-primary btn-xs"><i
                                                                    class="fas fa-plus fa-sm"></i></button>
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-xs swalSuccesDelete"><i
                                                                    class="fas fa-times fa-sm"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">

                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr te>
                                                                <th>Size</th>
                                                                <th class="text-center">Rp.</th>
                                                                <th class="text-center">Qty</th>
                                                                <th></th>
                                                            </tr>
                                                        <tbody>
                                                            @foreach ($color->goodsSizes as $key => $size)
                                                                <tr>
                                                                    <td><a href="#" class="xsize"
                                                                            data-pk="{{ $size->id }}" data-name="size">
                                                                            {{ $size->size }}</a></td>
                                                                    <td class="text-center">
                                                                        <a href="#" class="xsize"
                                                                            data-pk="{{ $size->id }}"
                                                                            data-name="additional_price"
                                                                            data-value="{{ $size->additional_price }}">
                                                                            <span class="badge bg-primary float-right">+
                                                                                @currency($size->additional_price)</span></span>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="#" class="xsize"
                                                                            data-pk="{{ $size->id }}" data-name="qty">
                                                                            {{ $size->qty }}</a>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <form
                                                                                action="{{ route('goods.deletesize', $size->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')

                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger btn-xs swalSuccesDelete"><i
                                                                                        class="fas fa-times fa-sm"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr class="addSize-{{ $color->id }}"></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/bootstrap-editable/js/bootstrap-editable.js') }}"></script>


    <script>
        function removeElement(elementId) {
            var element = document.getElementById(elementId);
            element.parentNode.removeChild(element);
        };

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });


            $('button#saveProduct').on('click', function(e) {
                event.preventDefault()
                var id = $('input[name="goods_id"]').val();
                var url = "{{ route('goods.update', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        goods_name: $('input[name="goods_name"]').val(),
                        description: $('textarea[name="description"]').val(),
                        category_id: $('select[name="category_id"]').val(),
                        is_active: $('input[name="is_active"]:checked').val(),
                        base_price: $('input[name="base_price"]').val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#editProductModal').modal('hide');
                        window.location.reload(true);
                    }
                });
            });


            $('.xcolor').editable({
                mode: 'inline',
                tpl: "<input type='text' class ='form-control form-control-xs' style='width: 100px;height: 30px; padding: 2px 5px; font-size: 12px; line-height: 1.5;  border-radius: 3px;'>",
                showbuttons: false,
                url: "{{ route('goods.color-update') }}",
                title: 'Update',
                success: function(response, newValue) {
                    $(document).ready(showNotif('success', response.success));
                    window.location.reload(true);
                }
            });

            $('.xsize').editable({
                mode: 'inline',
                tpl: "<input type='text' class ='form-control form-control-xs' style='width: 80px;height: 22px; padding: 2px 5px; font-size: 12px; line-height: 1.5;  border-radius: 3px;'>",
                showbuttons: false,
                url: "{{ route('goods.size-update') }}",
                title: 'Update',
                success: function(response, newValue) {
                    $(document).ready(showNotif('success', response.success));
                    window.location.reload(true);
                }
            });


            let addSizeHtmlId = 1;
            $("button#addSize").on("click", function() {
                addSizeHtmlId++;
                let id = $(this).data("value");
                let addSizeHtml = `<tr id="addSize-${addSizeHtmlId}">
                <td>
                    <a href="#" class="insert-size-${id}"
                        data-name="goods_color_id"
                        style="display: none;">${id}
                    </a>
                    <a href="#" class="insert-size-${id}" data-name="size">
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" class="insert-size-${id}"
                        data-name="additional_price">
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" class="insert-size-${id}" data-name="qty">
                    </a>
                </td>
                <td class="text-right">
                    <button type="submit"
                        class="btn btn-outline-primary btn-xs save-btn-${id}"><i
                            class="fas fa-paper-plane fa-sm"></i></button>
                    <button
                        class="btn btn-outline-secondary btn-xs reset-btn"
                        onclick="javascript:removeElement('addSize-${addSizeHtmlId}'); return false;"><i
                            class="fas fa-times fa-sm"></i></button>
                </td>
            </tr>`;
                $(".addSize-" + id + ":last").after(addSizeHtml);

                $(".insert-size-" + id).editable({
                    mode: 'inline',
                    tpl: "<input type='text' class ='form-control form-control-xs' style='width: 80px;height: 22px; padding: 2px 5px; font-size: 12px; line-height: 1.5;  border-radius: 3px;'>",
                    showbuttons: false,
                    url: '/post'
                });

                $(".save-btn-" + id).click(function() {
                    $(".insert-size-" + id).editable('submit', {
                        url: "{{ route('goods.size-update') }}",
                        ajaxOptions: {
                            dataType: 'json'
                        },
                        success: function(response, newValue) {
                            console.log(response);
                            $(document).ready(showNotif('success', response.success));
                            window.location.reload(true);
                        },
                        error: function(errors) {
                            $(document).ready(showNotif('error', errors.responseJSON
                                .error));
                        }
                    });
                });
            });
        });


        var colorId = 1;
        var sizeId = 1;
        $("button#addCardColor").on("click", function() {
            colorId++;
            let addCardColor = `
            
        <div class="col-md-4 col-sm-6 card-color" id="card-color-rm-${colorId}">
            <form action="{{ route('goods.addcolor') }}" method="POST">
                @csrf
                <input type="hidden" name="goods_id" value="{{ $goods->id }}">
            <div class="card">
                <div class="card-body p-1">
                    <div class="form-group input-group input-group-sm card-header p-1">
                        <input type="text" class="form-control" placeholder="Color Name" name="color[${colorId}][colorName]">
                        <input type="text" class="form-control"
                            placeholder="Additional Price" name="color[${colorId}][colorPrice]">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-danger btn-flat"
                                onclick="javascript:removeElement('card-color-rm-${colorId}'); return false;"><i
                                    class="fas fa-times"></i></button>
                        </span>
                    </div>
                    <table class="table table-striped table-sm mt-1">
                        <thead>
                            <tr>
                                <th class="align-middle">Size</th>
                                <th class="align-middle text-center">Rp.</th>
                                <th class="align-middle text-center">Qty</th>
                                <th class="align-middle text-right">
                                    <a class="text-primary" id="addSizeProduct-${colorId}"" data-value="${colorId}"> <i
                                            class="fas fa-plus"></i> </a>
                                </th>
                            </tr>
                        <tbody>
                            <tr class="table-color-${colorId}"></tr>
                        </tbody>
                    </table>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary btn-xs float-right">Save</button>
                      </div>
                </div>
            </div>
        </form>
        </div>`;
            $(".card-color:last").after(addCardColor);

            $('a#addSizeProduct-' + colorId).on('click', function(e) {
                let id = $(this).data("value");
                sizeId++;
                let addSize = `<tr class="table-color-${id}" id="table-size-rm-${sizeId}">
                    <td class="text-left"><input type="text"
                            class="form-control form-control-sm"
                            placeholder="Size" name="color[${id}][size][sizeName][]"></td>
                    <td class="text-center">
                        <input type="text" class="form-control form-control-sm"
                            placeholder="Add Price" name="color[${id}][size][priceSize][]">
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control form-control-sm"
                            placeholder="Qty" name="color[${id}][size][qty][]">
                    </td>
                    <td class="align-middle text-center">
                        <a class="text-danger"
                            onclick="javascript:removeElement('table-size-rm-${sizeId}'); return false;">
                            <i class="fas fa-times">
                            </i></a>
                    </td>
                </tr>`;
                $(".table-color-" + id + ":last").after(addSize);
            });
        });
    </script>
@endsection
