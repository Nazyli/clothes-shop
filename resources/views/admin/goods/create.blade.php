@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Data Baju</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/admin/goods') }}">Data Baju</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('goods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Product Picture</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-xs" id="addUploadProduct"
                                            data-trigger="hover" data-toggle="popover"
                                            data-content="Add row upload product picture" data-placement="top">
                                            <i class="fa fa-plus"></i> Add Row
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="uploadProduct"></div>
                                    <div class="form-group input-group uploadProduct" id="uploadProduct">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto[]" id="customFile"
                                                multiple="true">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger"
                                                onclick="javascript:removeElement('uploadProduct');">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @error('foto.*')
                                        <strong class="text-danger"> file of type: png, jpg, jpeg.</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">New Product</h3>

                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="goods_name"><strong>Product Name</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('goods_name') is-invalid @enderror"
                                            id="goods_name" name="goods_name" value="{{ old('goods_name') }}">
                                        @error('goods_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description"><strong>Description</strong></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" rows="2"
                                            placeholder="Enter ..." name="description">{{ old('description') }}</textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputBorder"><strong>Category</strong></label>
                                                <select
                                                    class="custom-select form-control-border @error('category_id') is-invalid @enderror"
                                                    name="category_id">
                                                    <option disabled selected value></option>
                                                    @foreach ($category as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ old('category_id') == $value->id ? 'selected' : '' }}>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 align-items-center">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="is_active1"
                                                    name="is_active" value="0">
                                                <label for="is_active1" class="custom-control-label">Non-Active</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="is_active2"
                                                    name="is_active" value="1" checked>
                                                <label for="is_active2" class="custom-control-label">Is Active</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="base_price"><strong>Price</strong></label>
                                        <input type="text"
                                            class="form-control form-control-border @error('base_price') is-invalid @enderror"
                                            id="base_price" name="base_price" value="{{ old('base_price') }}">
                                        @error('base_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Color Product</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-xs" id="addCardColor">
                                            <i class="fa fa-plus"></i> Add Row
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="card-color"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block"><b>Save</b></button>
                        <a href="{{ url('admin/goods') }}" class="btn btn-secondary btn-block"><b>Cancel</b></a>
                </form>

            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        function removeElement(elementId) {
            var element = document.getElementById(elementId);
            element.parentNode.removeChild(element);
        };
        var fileId = 1;

        $("button#addUploadProduct").on("click", function() {
            fileId++;

            let uploadProduct = `<div class="form-group input-group uploadProduct" id="uploadProduct-${fileId}">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto[]" id="customFile-` +
                fileId + `" multiple="true">
                                    <label class="custom-file-label" for="customFile-${fileId}">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger" onclick="javascript:removeElement('uploadProduct-${fileId}'); return false;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>`;
            $(".uploadProduct:last").after(uploadProduct);
            bsCustomFileInput.init();
        });

        var colorId = 1;
        var sizeId = 1;
        $("button#addCardColor").on("click", function() {
            colorId++;
            let addCardColor = `
        <div class="col-md-4 col-sm-6 card-color" id="card-color-rm-${colorId}">
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

                </div>
            </div>
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
