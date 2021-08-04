@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/dmuploader/dist/css/jquery.dm-uploader.min.css') }} ">
    <style>
        .dm-uploader {
            background: #eaeaea;
            height: 300px;
        }
        .dm-uploader h3{
            height: 80%;
            text-align: center;
            padding-top: 15%;
        }
        .dm-uploader.active {
            background: #aed2e3;
        }
    </style>
@stop


@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('products.index') }}">{{$title}}</a></li>
        <li class="active">{{$subtitle}}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <div class="box-body">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <div class="col-md-6 col-sm-12">

                    <!-- Our markup, the important part here! -->
                    <div id="drag-and-drop-zone" class="dm-uploader p-5">
                        <h3 class="mb-5 mt-5 text-muted">Arraste e solte as fotos aqui</h3>

                        <div class="btn btn-primary btn-block mb-5">
                            <span>Procurar no computador</span>
                            <input type="file" title='Click to add Files' />
                        </div>
                    </div><!-- /uploader -->

                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            Lista de fotos
                        </div>

                        <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                            <li class="text-muted text-center empty">Nenhuma foto carregada.</li>
                        </ul>
                    </div>
                </div>
            </div><!-- /file list -->

            <div class="box-footer">
                <button class="btn-block btn-lg btn-success" id="send-images">Enviar</button>
            </div>

            <table class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Data de criação</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($photos as $item)
                    <tr>
                        <td> <img class="img-album img-responsive pad img-thumbnail" style="width: 300px" id="list-photos" src="{{ asset("storage/photos/{$item->file}") }}"></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td class="action">
                            <form action="{{ route('photo.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('plugins/dmuploader/dist/js/jquery.dm-uploader.min.js') }}"></script>
    <script>
        // Adds an entry to our debug area
        // function ui_add_log(message, color) {
        //     var d = new Date();

        //     var dateString = (('0' + d.getHours())).slice(-2) + ':' +
        //         (('0' + d.getMinutes())).slice(-2) + ':' +
        //         (('0' + d.getSeconds())).slice(-2);

        //     color = (typeof color === 'undefined' ? 'muted' : color);

        //     var template = $('#debug-template').text();
        //     template = template.replace('%%date%%', dateString);
        //     template = template.replace('%%message%%', message);
        //     template = template.replace('%%color%%', color);
        //     console.log(message)
        //     $('#debug').find('li.empty').fadeOut(); // remove the 'no messages yet'
        //     $('#debug').prepend(template);
        // }
        // // Creates a new file and add it to our list
        // function ui_multi_add_file(id, file) {
        //     var template = $('#files-template').text();
        //     console.log(file);
        //     template = template.replace('%%filename%%', file.name);

        //     template = $(template);
        //     template.prop('id', 'uploaderFile' + id);
        //     template.data('file-id', id);

        //     $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
        //     $('#files').prepend(template);
        // }

        // Changes the status messages on our list
        function ui_multi_update_file_status(id, status, message) {
            $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
        }

        // Updates a file progress, depending on the parameters it may animate it or change the color.
        function ui_multi_update_file_progress(id, percent, color, active) {
            color = (typeof color === 'undefined' ? false : color);
            active = (typeof active === 'undefined' ? true : active);

            var bar = $('#uploaderFile' + id).find('div.progress-bar');

            bar.width(percent + '%').attr('aria-valuenow', percent);
            bar.toggleClass('progress-bar-striped progress-bar-animated', active);

            if (percent === 0) {
                bar.html('');
            } else {
                bar.html(percent + '%');
            }

            if (color !== false) {
                bar.removeClass('bg-success bg-info bg-warning bg-danger');
                bar.addClass('bg-' + color);
            }
        }

        // Toggles the disabled status of Star/Cancel buttons on one particual file
        function ui_multi_update_file_controls(id, start, cancel, wasError) {
            wasError = (typeof wasError === 'undefined' ? false : wasError);

            $('#uploaderFile' + id).find('button.start').prop('disabled', !start);
            $('#uploaderFile' + id).find('button.cancel').prop('disabled', !cancel);

            if (!start && !cancel) {
                $('#uploaderFile' + id).find('.controls').fadeOut();
            } else {
                $('#uploaderFile' + id).find('.controls').fadeIn();
            }

            if (wasError) {
                $('#uploaderFile' + id).find('button.start').html('Retry');
            }
        }

    </script>
    <script>
        $(document).ready(function(){
            'use strict';
            const url = '{!! Request::url() !!}';
            // const id = url.split('/')[7];
            const id = {{$product_id}};

            $("#drag-and-drop-zone").dmUploader({
                url: '{{URL::to('admin/products/{id}/photos')}}'.replace('{id}', id),
                auto: false,
                maxFileSize: 3000000, // 3 Megs
                extraData: function(id) {
                    return {
                        "title": $('#photo-'+id).val()
                    };
                },
                onDragEnter: function(){
                    // Happens when dragging something over the DnD area
                    this.addClass('active');
                },
                onDragLeave: function(){
                    // Happens when dragging something OUT of the DnD area
                    this.removeClass('active');
                },
                onInit: function(){
                    // Plugin is ready to use
                    ui_add_log('Penguin initialized :)', 'info');
                },
                onComplete: function(){
                    // All files in the queue are processed (success or error)
                    ui_add_log('All pending tranfers finished');
                    location.reload();
                },
                onNewFile: function(id, file){
                    // When a new file is added using the file selector or the DnD area
                    ui_add_log('New file added #' + id);
                    ui_multi_add_file(id, file);
                },
                onBeforeUpload: function(id){
                    // about tho start uploading a file
                    ui_add_log('Starting the upload of #' + id);
                    ui_multi_update_file_status(id, 'uploading', 'Uploading...');
                    ui_multi_update_file_progress(id, 0, '', true);
                },
                onUploadCanceled: function(id) {
                    // Happens when a file is directly canceled by the user.
                    ui_multi_update_file_status(id, 'warning', 'Canceled by User');
                    ui_multi_update_file_progress(id, 0, 'warning', false);
                },
                onUploadProgress: function(id, percent){
                    // Updating file progress
                    ui_multi_update_file_progress(id, percent);
                },
                onUploadSuccess: function(id, data){
                    // A file was successfully uploaded
                    ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
                    ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
                    ui_multi_update_file_status(id, 'success', 'Upload Complete');
                    ui_multi_update_file_progress(id, 100, 'green', false);
                },
                onUploadError: function(id, xhr, status, message){
                    ui_multi_update_file_status(id, 'danger', message);
                    ui_multi_update_file_progress(id, 0, 'danger', false);
                },
                onFallbackMode: function(){
                    // When the browser doesn't support this plugin :(
                    ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
                },
                onFileSizeError: function(file){
                    ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
                }
            });

            $("#send-images").click(function () {
                $("#drag-and-drop-zone").dmUploader("start");
            });
        });
    </script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
        <li class="media">
            <div class="media-body mb-1">
                <p class="mb-2">
                    <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                </p>
                <div class="form-group">
                    <input type="text" placeholder="Descrição da foto" id="photo-%%id%%" class="form-control photo-description">
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar"
                         style="width: 0%"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <hr class="mt-1 mb-1" />
            </div>
        </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
        <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
@stop