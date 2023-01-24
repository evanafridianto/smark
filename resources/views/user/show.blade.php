@extends('layouts.main')
@section('content')
    <div class="btn-toolbar el-example mb-2">
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('exportById.export', $user->id) }}" class="btn btn-secondary" target="_blank"><i
                class="fas fa-file-excel mr-2"></i>Export Excel</a>
    </div>
    <!-- grid row -->
    <div class="row">
        <!-- grid column -->
        <div class="col-lg-3">
            <!-- .card -->
            <div class="card card-fluid">
                <h6 class="card-header"> Quick Details </h6><!-- .nav -->
                <nav class="nav nav-tabs flex-column border-0">
                    <a href="{{ route('user.show', ['user', $user->id]) }}"
                        class="nav-link {{ Request::is('admin/user/*') ? 'active' : '' }}">Data
                        User</a>
                    <a href="{{ route('user.show', ['business-profile', $user->id]) }}"
                        class="nav-link {{ Request::is('admin/business-profile/*') ? 'active' : '' }}">Profil UMKM</a>
                    <a href="{{ route('user.show', ['advertisement', $user->id]) }}"
                        class="nav-link {{ Request::is('admin/advertisement/*') ? 'active' : '' }}">Advertisement</a>

                    <a href="{{ route('user.show', ['sales', $user->id]) }}"
                        class="nav-link {{ Request::is('admin/sales/*') ? 'active' : '' }}">
                        Penjualan</a>
                    <a href="{{ route('user.show', ['roas', $user->id]) }}"
                        class="nav-link {{ Request::is('admin/roas/*') ? 'active' : '' }}">ROAS</a>
                </nav><!-- /.nav -->
            </div><!-- /.card -->
        </div><!-- /grid column -->
        <!-- grid column -->
        <div class="col-lg-9">
            <div class="card card-fluid">
                <h6 class="card-header"> {{ $title }}</h6><!-- .card-body -->
                <div class="card-body">
                    @if (request('data') == 'user')
                        <div class="table-responsive">
                            <!-- .table -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="min-width:200px"> Nama </td>
                                        <td> : </td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td> Email </td>
                                        <td> : </td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table>
                            <!-- /.table -->
                        </div>
                    @elseif(request('data') == 'business-profile')
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="min-width:200px"> Nama UMKM </td>
                                        <td> : </td>
                                        <td>{{ $user->businessProfile->business_name }}</td>
                                    </tr>
                                    <tr>
                                        <td> Kategori UMKM </td>
                                        <td> : </td>
                                        <td>{{ $user->businessProfile->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td> Tanggal Berdiri </td>
                                        <td> : </td>
                                        <td>{{ $user->businessProfile->founded_at }}</td>
                                    </tr>
                                    <tr>
                                        <td> Alamat </td>
                                        <td> : </td>
                                        <td>{{ $user->businessProfile->address }}</td>
                                    </tr>
                                    <tr>
                                        <td> No.HP/WA </td>
                                        <td> : </td>
                                        <td>{{ $user->businessProfile->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td> Sosial Media 1 </td>
                                        <td> : </td>
                                        <td>
                                            <a target="_blank"
                                                href="http://{{ $user->businessProfile->social_media1 }}">{{ $user->businessProfile->social_media1 }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Sosial Media 2 </td>
                                        <td> : </td>
                                        <td><a target="_blank"
                                                href="http://{{ $user->businessProfile->social_media2 }}">{{ $user->businessProfile->social_media2 }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Sosial Media 3 </td>
                                        <td> : </td>
                                        <td><a target="_blank"
                                                href="http://{{ $user->businessProfile->social_media3 }}">{{ $user->businessProfile->social_media3 }}</a>
                                        </td>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table>
                        </div>
                    @elseif(request('data') == 'sales')
                        <div class="table-responsive">
                            <form action="">
                                <div class="row mt-2">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="start_date"><span
                                                        class="input-group-text">Start date</span></label> <input
                                                    type="email" class="form-control flatpickr"
                                                    value="{{ request('start_date') }}" id="start_date" name="start_date"
                                                    placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div><!-- /.form-group -->

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="end_date"><span
                                                        class="input-group-text">End date</span></label> <input
                                                    type="email" class="form-control flatpickr" id="end_date"
                                                    name="end_date" value="{{ request('end_date') }}"
                                                    placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <button type="submit" class="btn btn-info">Filter Data</button>
                                    </div>
                                </div>
                            </form>
                            <!-- .table -->
                            <table class="table table-striped">
                                <!-- thead -->
                                <thead>
                                    <tr>
                                        <th> ID Trans. </th>
                                        <th> Periode Ads. </th>
                                        <th> Tanggal </th>
                                        <th> Pelanggan </th>
                                        <th> Jumlah </th>
                                        <th> Total </th>
                                        <th> Penjualan/Retur </th>
                                        <th> Penanganan </th>
                                        <th> Ket. </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    @if ($sales->count())
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sale->transaction_id }} </td>
                                                <td>{{ $sale->advertisement->start_date . ' - ' . $sale->advertisement->end_date }}
                                                </td>
                                                <td>{{ $sale->date }} </td>
                                                <td>{{ $sale->customer }}</td>
                                                <td>{{ $sale->qty }}</td>
                                                <td>{{ $sale->total }}</td>
                                                <td>
                                                    {!! $sale->status == 'sold'
                                                        ? '<span class="badge badge-success">SOLD</span>'
                                                        : '<span class="badge badge-danger">RETURN</span>' !!}
                                                </td>
                                                <td>{{ $sale->handling }}</td>
                                                <td>{{ $sale->description }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="align-middle text-center" colspan="9">
                                                Data tidak ditemukan!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody><!-- /tbody -->
                            </table><!-- /.table -->
                        </div>
                        <!-- .pagination -->
                        <ul class="pagination justify-content-center mt-4">
                            {{ $sales->links('pagination::bootstrap-4') }}
                        </ul><!-- /.pagination -->
                    @elseif (request('data') == 'advertisement')
                        <div class="table-responsive">
                            <form action="">
                                <div class="row mt-2">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="start_date"><span
                                                        class="input-group-text">Start date</span></label> <input
                                                    type="email" class="form-control flatpickr"
                                                    value="{{ request('start_date') }}" id="start_date" name="start_date"
                                                    placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div><!-- /.form-group -->

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="end_date"><span
                                                        class="input-group-text">End date</span></label> <input
                                                    type="email" class="form-control flatpickr" id="end_date"
                                                    name="end_date" value="{{ request('end_date') }}"
                                                    placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <button type="submit" class="btn btn-info">Filter Data</button>
                                    </div>
                                </div>
                            </form>
                            <!-- .table -->
                            <table class="table table-striped">
                                <!-- thead -->
                                <thead>
                                    <tr>
                                        <th> Periode [Start Date - End Date]</th>
                                        <th> Media Promosi </th>
                                        <th> Cost Campaign </th>
                                        <th> Ket. </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    @if ($advertisements->count())
                                        @foreach ($advertisements as $advertisement)
                                            <tr>
                                                <td>{{ $advertisement->start_date . ' - ' . $advertisement->end_date }}
                                                </td>
                                                <td>{{ $advertisement->media }} </td>
                                                <td>{{ $advertisement->cost }}</td>
                                                <td>{{ $advertisement->description }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">
                                                Data tidak ditemukan!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody><!-- /tbody -->
                            </table><!-- /.table -->
                        </div>
                        <!-- .pagination -->
                        <ul class="pagination justify-content-center mt-4">
                            {{ $advertisements->links('pagination::bootstrap-4') }}
                        </ul><!-- /.pagination -->
                    @elseif (request('data') == 'roas')
                        <div class="table-responsive">
                            <form action="">
                                <div class="row mt-2">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="start_date"><span
                                                        class="input-group-text">Start date</span></label> <input
                                                    type="email" class="form-control flatpickr"
                                                    value="{{ request('start_date') }}" id="start_date"
                                                    name="start_date" placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div><!-- /.form-group -->

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group input-group-alt">
                                                <label class="input-group-prepend" for="end_date"><span
                                                        class="input-group-text">End date</span></label> <input
                                                    type="email" class="form-control flatpickr" id="end_date"
                                                    name="end_date" value="{{ request('end_date') }}"
                                                    placeholder="yyyy-mm-dd">
                                            </div><!-- /.input-group -->
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <button type="submit" class="btn btn-info">Filter Data</button>
                                    </div>
                                </div>
                            </form>
                            <!-- .table -->
                            <table class="table table-striped">
                                <!-- thead -->
                                <thead>
                                    <tr>
                                        <th>Periode Advertisement </th>
                                        <th> Cost Campaign </th>
                                        <th> Revenue </th>
                                        <th> Nilai ROAS </th>
                                        <th> Simpulan </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    @if ($roas->count())
                                        @foreach ($roas as $roa)
                                            <tr>
                                                <td>{{ $roa->advertisement->start_date . ' - ' . $roa->advertisement->end_date }}
                                                </td>
                                                <td>{{ $roa->advertisement->cost }} </td>
                                                <td>{{ $roa->revenue_campaign }} </td>
                                                @if ($roa->conclusion == 'Laba')
                                                    <td class="text-success">{{ $roa->roas_score }}</td>
                                                    <td>
                                                        {!! '<span class="badge badge-success">LABA</span>' !!}
                                                    </td>
                                                @else
                                                    <td class="text-danger">{{ $roa->roas_score }}</td>
                                                    <td>
                                                        {!! '<span class="badge badge-danger">RUGI</span>' !!}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">
                                                Data tidak ditemukan!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody><!-- /tbody -->
                            </table><!-- /.table -->
                        </div>
                        <!-- .pagination -->
                        <ul class="pagination justify-content-center mt-4">
                            {{ $roas->links('pagination::bootstrap-4') }}
                        </ul><!-- /.pagination -->
                    @endif
                </div><!-- /.card-body -->
            </div>
        </div><!-- /grid column -->
    </div><!-- /grid row -->
    <script>
        $(".flatpickr").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
