@extends('layouts.main')
@section('content')

    <!-- .card -->
    <div class="card card-fluid">
        <!-- .card-header -->
        <div class="card-header">
            <a href="{{ route('category.create') }}" class="btn btn-info">Add New</a>
        </div><!-- /.card-header -->
        <!-- .card-body -->
        <div class="card-body">
            <!-- .form-group -->
            <div class="col-lg-4">
                <form action="">
                    <div class="form-group">
                        <!-- .input-group -->
                        <div class="input-group input-group-alt">
                            <!-- .input-group -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                                </div><input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="Search">
                            </div><!-- /.input-group -->
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div><!-- /.input-group -->
                    </div><!-- /.form-group -->
                    <!-- .table-responsive -->
                </form><!-- /.input-group-prepend -->
            </div>

            {{--  <div class="text-muted"> Showing 1 to 10 of 1,000 entries </div>  --}}
            <div class="table-responsive">
                <!-- .table -->
                <table class="table">
                    <!-- thead -->
                    <thead>
                        <tr>
                            <th> No. </th>
                            <th> Nama Kategori </th>
                            <th> Deskripsi </th>
                            <th> Aksi </th>
                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        @if ($categories->count())
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle"> {{ $no++ }} </td>
                                    <td class="align-middle"> {{ $category->name }}</td>
                                    <td class="align-middle"> {{ $category->description }} </td>
                                    <td class="align-middle">
                                        <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i>
                                                <span class="sr-only">Edit</span>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" type="submit"
                                                class="destroy btn btn-sm btn-icon btn-secondary"><i
                                                    class="far fa-trash-alt"></i>
                                                <span class="sr-only">Remove</span></a>
                                        </form>
                                    </td>
                                </tr><!-- /tr -->
                            @endforeach
                        @else
                            <tr>

                                <td class="align-middle text-center" colspan="4">
                                    Data tidak ditemukan!
                                </td>
                            </tr>
                        @endif
                    </tbody><!-- /tbody -->
                </table><!-- /.table -->
            </div><!-- /.table-responsive -->
            <!-- .pagination -->
            <ul class="pagination justify-content-center mt-4">
                {{ $categories->links('pagination::bootstrap-4') }}
            </ul><!-- /.pagination -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    <script>
        $('.destroy').click(function(e) {
            e.preventDefault();
            bootprompt.confirm({
                size: "small",
                title: "Are you sure ?",
                message: "Data will be deleted!",
                buttons: {
                    confirm: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
                callback: (result) => {
                    if (result) {
                        $(this).closest("form").submit();
                    }
                }
            });
        });

        @if (session('status') == 'category-deleted')
            bootprompt.alert({
                message: "Category deleted!",
                title: "Success!",
                size: "small",
                buttons: {
                    ok: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
                callback: (result) => {
                    window.location.href = "{{ route('category.index') }}";
                }
            });
        @endif
    </script>
@endsection
