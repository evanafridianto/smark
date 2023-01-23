   @extends('layouts.main')
   @section('content')
       <div class="section-block">
           <!-- metric row -->
           <div class="metric-row">
               <!-- metric column -->
               <div class="col-12 col-sm-6 col-lg-4">
                   <!-- .metric -->
                   <div class="card-metric bg-warning">
                       <div class="metric">
                           <p class="metric-value h3">
                               <sub><i class="oi oi-people text-white"></i></sub> <span
                                   class="value text-white">{{ $umkm }}</span>
                           </p>
                           <h2 class="metric-label text-white"> Total UMKM </h2>
                       </div>
                   </div><!-- /.metric -->
               </div><!-- /metric column -->
               <!-- metric column -->
               <div class="col-12 col-sm-6 col-lg-4">
                   <!-- .metric -->
                   <div class="card-metric text-white" style="background-color: #6fae9b">
                       <div class="metric ">
                           <p class="metric-value h3 ">
                               <sub><i class="fas fa-dollar-sign text-white"></i></sub> <span
                                   class="value">{{ $roasLaba }}</span>
                           </p>
                           <h2 class="metric-label text-white"> Total ROAS laba </h2>
                       </div>
                   </div><!-- /.metric -->
               </div><!-- /metric column -->
               <!-- metric column -->
               <div class="col-12 col-sm-6 col-lg-4">
                   <!-- .metric -->
                   <div class="card-metric bg-danger">
                       <div class="metric">
                           <p class="metric-value h3 text-white">
                               <sub><i class="fas fa-user-minus text-white"></i></sub> <span
                                   class="value">{{ $roasRugi }}</span>
                           </p>
                           <h2 class="metric-label text-white"> Total ROAS Rugi </h2>
                       </div>
                   </div><!-- /.metric -->
               </div><!-- /metric column -->
           </div><!-- /metric row -->
       </div><!-- /.section-block -->
       <!-- card-deck-xl -->
       <div class="card-deck-xl">
           <div class="row">
               <!-- grid column -->
               <div class="col-lg-6">
                   <!-- .card -->
                   <div class="card card-fluid">
                       <div class="card-header"> Statistik Data Penjualan Per UMKM
                       </div>
                       <!-- .card-body -->
                       <div class="card-body">
                           <div style="height:400px">
                               <canvas id="chartSold" class="chartjs"></canvas>
                           </div>
                       </div><!-- /.card-body -->
                   </div><!-- /.card -->
               </div><!-- /.col -->
               <div class="col-lg-6">
                   <!-- .card -->
                   <div class="card card-fluid">
                       <div class="card-header"> 5 UMKM Dengan ROAS Laba Terbanyak
                       </div>
                       <!-- .card-body -->
                       <div class="card-body">
                           <div style="height:400px">
                               <canvas id="chartReturn" class="chartjs"></canvas>
                           </div>
                       </div><!-- /.card-body -->
                   </div><!-- /.card -->
               </div><!-- /.col -->
               <!-- .card -->
               <div class="col-lg-6">
                   <div class="card card-fluid">
                       <div class="card-header"> Jumlah UMKM Per Kategori </div><!-- .lits-group -->
                       <div class="card-body">
                           <!-- .lits-group-item -->
                           <div class="table-responsive">
                               <!-- .table -->
                               <table class="table table-bordered">
                                   <!-- thead -->
                                   <thead class="thead-">
                                       <tr>
                                           <th class="text-center">No. </th>
                                           <th>Kategori Usaha </th>
                                           <th class="text-center"> Jumlah </th>
                                       </tr>
                                   </thead><!-- /thead -->
                                   <tbody>
                                       @if ($business_profiles->count())
                                           @php
                                               $no = 1;
                                           @endphp
                                           @foreach ($business_profiles as $business)
                                               <tr>
                                                   <td class="text-center">{{ $no++ }}</td>
                                                   <td>{{ $business->name }}</td>
                                                   <td class="text-center">{{ $business->total }} </td>
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
                               {{ $business_profiles->links('pagination::bootstrap-4') }}
                           </ul><!-- /.pagination -->
                       </div><!-- /.lits-group -->
                   </div><!-- /.card -->
               </div><!-- /.card -->
               <!-- /.card -->
               <!-- .card -->
               <div class="col-lg-6">
                   <div class="card card-fluid">
                       <div class="card-header"> Jumlah UMKM Per Media Campaign </div>
                       <div class="card-body">
                           <!-- .todo-list -->
                           <div class="table-responsive">
                               <!-- .table -->
                               <table class="table table-bordered">
                                   <!-- thead -->
                                   <thead class="thead-">
                                       <tr>
                                           <th class="text-center">No. </th>
                                           <th>Media Campaign </th>
                                           <th class="text-center"> Jumlah </th>
                                       </tr>
                                   </thead><!-- /thead -->
                                   <tbody>
                                       @if ($advertisements->count())
                                           @php
                                               $no = 1;
                                           @endphp
                                           @foreach ($advertisements as $advertisement)
                                               <tr>
                                                   <td class="text-center">{{ $no++ }}</td>
                                                   <td>{{ $advertisement->media }}</td>
                                                   <td class="text-center">{{ $advertisement->total }} </td>
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
                       </div><!-- /.card-body -->
                   </div><!-- /.card -->
               </div>
           </div>
           <script>
               window.onload = function() {

                   const sales = {!! $sales !!}
                   var data = {
                       labels: sales.map(row => row.business_name),
                       datasets: [{
                           label: 'Return',
                           backgroundColor: Looper.colors.brand.red,
                           data: sales.map(row => row.total_return)
                       }, {
                           label: 'Sold',
                           backgroundColor: Looper.colors.brand.blue,
                           data: sales.map(row => row.total_sold)
                       }]
                   };

                   new Chart($('#chartSold'), {
                       type: 'bar',

                       data: data,
                       options: {
                           title: {
                               display: true,
                               text: 'Sold - Return'
                           },
                           tooltips: {
                               mode: 'index',
                               intersect: false
                           },
                           scales: {
                               xAxes: [{
                                   stacked: true
                               }],
                               yAxes: [{
                                   stacked: true
                               }]
                           }
                       }

                   });


                   const laba = {!! $laba !!}


                   new Chart($('#chartReturn'), {
                       type: 'pie',
                       data: {
                           labels: laba.map(row => row.business_name),
                           datasets: [{
                               label: 'Statistik 5 UMKM Dengan ROAS Laba Terbanyak',
                               data: laba.map(row => row.total),
                               borderColor: [this.borderColor, this.borderColor, this.borderColor, this
                                   .borderColor, this.borderColor
                               ],
                               backgroundColor: [Looper.colors.brand.red, Looper.colors.brand.purple, Looper
                                   .colors
                                   .brand.yellow, Looper.colors.brand.teal, Looper.colors.brand.indigo
                               ],
                           }]
                       }

                   });
               }
           </script>
       @endsection
