@extends('layouts.app')
@section('title', __( 'productcatalogue::lang.catalogue_qr' ))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'productcatalogue::lang.catalogue_qr' )</h1>
</section>
<section class="content">
    <div class="row">
            <div class="col-md-7">
	@component('components.widget', ['class' => 'box-solid'])
        
                <div class="form-group">
                    {!! Form::label('location_id', __('purchase.business_location').':') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('color', __('productcatalogue::lang.qr_code_color').':') !!}
                    {!! Form::text('color', '#000000', ['class' => 'form-control']); !!}
                </div>
                <br>
                <button type="button" class="btn btn-primary" id="generate_qr">@lang( 'productcatalogue::lang.generate_qr' )</button>
            
            
        
    @endcomponent
</div>

<div class="col-md-5">
    @component('components.widget', ['class' => 'box-solid'])

        <div class="text-center">
            <img src="#" id="qr_img" class="hide">
            <br><span id="catalogue_link"></span>
            <br>
            <a href="#" class="btn btn-success hide" id="download_image" target="_blank" download="QRCode.png">@lang( 'productcatalogue::lang.download_image' )</a>
        </div>
    @endcomponent
</div>


</div>
</section>
@stop
@section('javascript')
<script src="{{ asset('modules/productcatalogue/plugins/qrcode/qrcode.js') }}"></script>
<script type="text/javascript">

    (function($) {
        "use strict";

    $(document).ready( function(){
        $('#color').colorpicker();
    });
    
    $(document).on('click', '#generate_qr', function(e){
        if ($('#location_id').val()) {
            var link = "{{url('catalogue/' . session('business.id'))}}/" + $('#location_id').val();
            var color = '#000000';
            if ($('#color').val().trim() != '') {
                color = $('#color').val();
            }
            var opts = {
                errorCorrectionLevel: 'H',
                margin: 4,
                width: 250,
                color: {
                    dark: color,
                    light: "#ffffffff"
                }
            }

            QRCode.toDataURL(link, opts, function (err, url){
                $('#qr_img').attr('src', url);
                $('#download_image').attr('href', url);
                $('#qr_img').removeClass('hide');
                $('#catalogue_link').html('<a target="_blank" href="'+ link +'">Link</a>');
                $('#download_image').removeClass('hide');
            })
            
        } else {
            alert("{{__('productcatalogue::lang.select_business_location')}}")
        }
    });
    })(jQuery);
</script>
@endsection