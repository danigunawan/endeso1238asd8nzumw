@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Pesanan</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Pesanan</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                @include('layouts._flash') 


                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#homestay">Pesanan Homestay</a></li>
                        <li><a data-toggle="tab" href="#culture">Pesanan Cultur Experience</a></li>
                      </ul>
                      <br><br>
                      <div class="tab-content">
                         <div id="homestay" class="tab-pane fade in active">
                     
                         <table  class="table-striped table" id="datatable_pesanan_homestay">
                             <thead>
                                <tr>
                                    <th >Status</th> 
                                </tr>
                             </thead>
                        </table>

                         </div>

                        <div id="culture" class="tab-pane fade">                          
                                 {!! $html->table(['class'=>'table-striped']) !!}
                        </div>
                      </div>
                   </div>
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection

@section('scripts')
{!! $html->scripts() !!}
<script type="text/javascript">
$("#datatable_pesanan_homestay").DataTable({
    "serverSide":true,"processing":true,"ajax":"{{ url('pesana/homestay') }}","columns":[ 
    {"data":"status_pesanan","name":"status_pesanan","title":"","orderable":false,"searchable":false}
]});
</script>
@endsection