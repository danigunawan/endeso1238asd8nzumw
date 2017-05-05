@extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Edit Warga</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="">Warga</li>
                    <li class="active">Edit</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
               
            {!! Form::model($warga, ['url' => route('warga.update', $warga->id),
            'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}

                    @include('warga._form')

            {!! Form::close() !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     

@section('scripts')
    <script type="text/javascript">
        CKEDITOR.replace('deskripsi_kategori');
    </script>

<!--ON READY -> KETIKA KOLOM DESTINASI SUDAH TERISI -->
<script type="text/javascript">
    $(document).ready(function(){
        var destinasi = $('#destinasi').val();

        $.post('{{ url('/ajax-data-kategori') }}',{'_token': $('meta[name=csrf-token]').attr('content'), destinasi:destinasi},function(data){
        
            $(".span-option").remove();
                for (var i = 0; i < data.length; i++) {
                    if (data[i].id == destinasi) {
                        $("#id_kategori_culture").append('<option selected class="span-option" value="'+data[i].id+'">'+data[i].nama_aktivitas+'</option>');
                    }
                    else{
                        $("#id_kategori_culture").append('<option class="span-option" value="'+data[i].id+'">'+data[i].nama_aktivitas+'</option>');
                    }                    
                }
              
        });
    });
</script>

<!--ON CHANGE -> KETIKA MEMILIH DESTINASI -->
<script type="text/javascript">
    
    $(document).on('change','#destinasi',function(e){

        var destinasi = $('#destinasi').val();

        $.post('{{ url('/ajax-data-kategori') }}',{'_token': $('meta[name=csrf-token]').attr('content'), destinasi:destinasi},function(data){
        
            $(".span-option").remove();
                for (var i = 0; i < data.length; i++) {
                    $("#id_kategori_culture").append('<option class="span-option" value="'+data[i].id+'">'+data[i].nama_aktivitas+'</option>');
                }
              
        });
    });

</script>

@endsection