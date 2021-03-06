@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Tambah Kamar</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li><a href="{{ url('/admin/kamar')}}"></a>Kamar</li>
                    <li class="active">Tambah</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
               
           {!! Form::open(['url' => route('kamar.store'),'files'=>'true','method' => 'post', 'class'=>'form-horizontal']) !!}

                    @include('kamar._form')

            {!! Form::close() !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection

@section('scripts')
	<script type="text/javascript">
		CKEDITOR.replace('deskripsi');
        CKEDITOR.replace('deskripsi_2');
	</script>

  <script type="text/javascript">
    $('#destinasi').change(function(){

            var id_destinasi = $('#destinasi').val();
    
                        $.post('{{ url('/ajax-data-kamar') }}',{'_token': $('meta[name=csrf-token]').attr('content'),
                            id_destinasi:id_destinasi },function(data){

                            $('#id_rumah').find('option').remove();
                                
                                for (var i = 0; i < data.length; i++) {

                                $("#id_rumah").append('<option class="span-option" value="'+data[i].id_rumah+'">'+data[i].nama_pemilik+'</option>');
                                
                                }
                           
                        });

    });
</script>

@endsection