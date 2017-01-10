@extends('layouts.back-end.layout')

@section('style')
    <style>
        .mar-bot15{
            margin-bottom: 15px
        }
    </style>
@endsection

@section('cabecera')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Administrar Servicios</h3>
                <p class="animated fadeInDown">
                    Admin <span class="fa-angle-right fa"></span> Servicios
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <div class="row mar-bot15">
                <div class="col-md-12 article-v1-title titulos"><h3><b>PDF</b></h3></div>
                <div class="col-md-12">Edita la información referente a los "<b>REQUISITOS DE DOTACIÓN PARA EL INGRESO A LA FUNDACION ANTIOQUÍA</b>"</div>
            </div>
            <form id="requisitos">
                <div class="row">
                    <div class="col-xs-12" style="margin-bottom: 15px">
                        <textarea id='textoReq' name='textoReq' rows='10' cols='30' style='height:440px'>
                            {!! $pdf->texto !!}
                        </textarea>
                    </div>
                </div>

                <div class="row mar-bot15">
                    <div class="col-xs-12 text-right">
                        <button type='submit' class='btn btn-primary'>Guardar</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1" id="alertTexto"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/canvas-to-blob.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/sortable.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/purify.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/fileinput.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/locales/es.js')!!}
    {!!Html::script('plugins/ckeditor/ckeditor.js')!!}
    <script charset="UTF-8">
        $(function() {
            CKEDITOR.replace( 'textoReq', {
                // Define the toolbar: http://docs.ckeditor.com/#!/guide/dev_toolbar
                // The full preset from CDN which we used as a base provides more features than we need.
                // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
                toolbar: [
                    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
                    { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                    { name: 'insert', items: [ 'Table' ] },
                    { name: 'tools', items: [ 'Maximize' ] },
                    { name: 'editing', items: [ 'Scayt' ] }
                ],
                // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
                // One HTTP request less will result in a faster startup time.
                // For more information check http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-customConfig
                customConfig: '',
                // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
                // For more information check:
                //  - About Advanced Content Filter: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
                //  - About Disallowed Content: http://docs.ckeditor.com/#!/guide/dev_disallowed_content
                //  - About Allowed Content: http://docs.ckeditor.com/#!/guide/dev_allowed_content_rules
//                disallowedContent: 'img{width,height,float}',
//                extraAllowedContent: 'img[width,height,align]',
                // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
                /*********************** File management support ***********************/
                // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
                // solution with file upload/management capabilities, like for example CKFinder.
                // For more information see http://docs.ckeditor.com/#!/guide/dev_ckfinder_integration
                // Uncomment and correct these lines after you setup your local CKFinder instance.
                // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
                // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                /*********************** File management support ***********************/
                // Make the editing area bigger than default.
                height: 500,
                stylesSet: [
                    /* Inline Styles */
                    { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
                    { name: 'Cited Work', element: 'cite' },
                    { name: 'Inline Quotation', element: 'q' },
                    /* Object Styles */
                    {
                        name: 'Special Container',
                        element: 'div',
                        styles: {
                            padding: '5px 10px',
                            background: '#eee',
                            border: '1px solid #ccc'
                        }
                    },
                    {
                        name: 'Compact table',
                        element: 'table',
                        attributes: {
                            cellpadding: '5',
                            cellspacing: '0',
                            border: '1',
                            bordercolor: '#ccc'
                        },
                        styles: {
                            'border-collapse': 'collapse'
                        }
                    },
                    { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
                    { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
                ]
            } );
        });

        $('#requisitos').on('submit', function (e) {
            e.preventDefault();
            var contenido = encodeURIComponent((CKEDITOR.instances.textoReq.getData().split("\n").join("")).replace(/"/g,'\'').split("\t").join(""));
//            console.log();
            if (contenido != "") {
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('editTexto')}}',
                    data: "&inicio=" + JSON.stringify({id:'{{$pdf->id}}', texto:contenido}),
                    success: function (data) {
                        if (data == "exito"){
                            $("#alertTexto").html("<div class='alert alert-success alert-dismissible' role='alert'>" +
                                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                    "</button>" +
                                    "<strong>Correcto!</strong> El contenido de la pagina de inicio ha sido actualizado con exito.</div>");
                        }
                    },
                    error: function () {
                        console.log('error en la concexción');
                    }
                });
            }
            else {
                $("#alertTexto").html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "<strong>Error!</strong> Debes ingresar algún texto para mostrar en la página principal.</div>");
            }
        });
    </script>
@endsection