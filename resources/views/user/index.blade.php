@extends('layouts.main')
@section('content')

    <!-- .card -->
    <div class="card card-fluid">
        <!-- .card-header -->
        <div class="card-header">
            {{--  <a href="{{ route('user.export') }}" target="_blank" class="btn btn-danger btn-lg">Export Excel</a>  --}}
            <a href="{{ route('user.export') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-file-excel"></i>
                Export Excel </a>
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
            <div class="table-responsive">
                <!-- .table -->
                <table class="table">
                    <!-- thead -->
                    <thead>
                        <tr>
                            <th> No. </th>
                            <th> Nama User </th>
                            <th> Email User </th>
                            <th> Nama UMKM </th>
                            <th> Kategori UMKM </th>
                            <th> Alamat </th>
                            <th> Aksi </th>
                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        @if ($users->count())
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle"> {{ $no++ }} </td>
                                    <td class="align-middle"> {{ $user->name }}</td>
                                    <td class="align-middle"> {{ $user->email }} </td>
                                    <td class="align-middle"> {{ $user->businessProfile->business_name }} </td>
                                    <td class="align-middle"> {{ $user->businessProfile->category->name }} </td>
                                    <td class="align-middle"> {{ $user->businessProfile->address }} </td>

                                    <td class="align-middle ">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i
                                                    class="fa fa-ellipsis-h"></i> <span
                                                    class="sr-only">Actions</span></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-arrow mr-n1"></div>
                                                <a class="dropdown-item"
                                                    href="{{ route('user.show', ['user', $user->id]) }}">Detail</a>
                                                <a class="dropdown-item" target="_blank"
                                                    href="{{ route('exportById.export', $user->id) }}">Export
                                                    Excel</a>
                                                <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0)" class="destroy dropdown-item"
                                                        href="">Delete</a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr><!-- /tr -->
                            @endforeach
                        @else
                            <tr>
                                <td class="align-middle text-center" colspan="7">
                                    Data tidak ditemukan!
                                </td>
                            </tr>
                        @endif
                    </tbody><!-- /tbody -->
                </table><!-- /.table -->
            </div><!-- /.table-responsive -->
            <!-- .pagination -->
            <ul class="pagination justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-4') }}
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

        @if (session('status') == 'user-deleted')
            bootprompt.alert({
                message: "User deleted!",
                title: "Success!",
                size: "small",
                buttons: {
                    ok: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
                callback: (result) => {
                    window.location.href = "{{ route('user.index') }}";
                }
            });
        @endif
    </script>
@endsection
