@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> List Address </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">My Address </a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12">
                        <div class="card-header">
                            <h3 class="card-title">Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('address.create') }}" class="btn btn-primary btn-sm"> Add Data </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Address</th>
                                        <th>Utama</th>
                                        <th>ZIP</th>
                                        <th>Latitude </th>
                                        <th>Longitude</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($address as $key => $value)
                                        <tr>
                                            <td class="text-primary">{{ $value->id }} </td>
                                            <td>{{ $value->full_address }} </td>
                                            <td class="text-center"> <span
                                                    class="badge {{ $value->is_main ? 'badge-primary' : 'badge-secondary' }}">{{ $value->is_main ? 'Utama' : '-' }}</span>
                                            </td>
                                            <td>{{ $value->zip_code }} </td>
                                            <td>{{ $value->lat }} </td>
                                            <td>{{ $value->long }} </td>
                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <form action="{{ route('address.destroy', $value->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a href="{{ route('address.edit', $value->id) }}"
                                                            class="btn btn-outline-primary btn-xs"><i
                                                                class="fas fa-pencil-alt fa-xl"></i></a>

                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-xs swalSuccesDelete"><i
                                                                class="fas fa-trash fa-xl"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
