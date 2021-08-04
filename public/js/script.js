$(function () {

    /*** LIBS ***/
    $('.data-table').DataTable({
        "bPaginate": false
    });

    $('.select2').select2();

    $('.cpf').inputmask('999.999.999-99', { 'placeholder': '000.000.000-00' });

    $('.cnpj').inputmask('99.999.999/9999-99', { 'placeholder': '99.999.999/9999-99' });

    $('.telefone').inputmask('(99) 99999-9999', { 'placeholder': '(99) 99999-9999' });

    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $(".amount").maskMoney({symbol:'R$ ', thousands:'.', decimal:','});

    if($(".filetree")[0]){
        $(".file-tree").filetree();
    }

    if($(".datepicker")[0]){
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy'
        });
    }

    if($(".datetimepicker")[0]){
        $(".datetimepicker").datetimepicker({
            format: 'dd/mm/yyyy'
        });
    }
    //$(".conteudo").wysihtml5();

    if($("#my-select")[0]){
        $("#my-select").multiSelect();
    }

    if($(".categoria-select")[0]){
        $(".categoria-select").on('change', function (e) {
            $(".subcategoria-select").empty();
            $.ajax({
                type: "POST",
                url: "/admin/categorias/findSubcategoria",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {categoria: $(".categoria-select").find(':selected').val()},
                success: function (data) {
                    $(".subcategoria-select").append(new Option('Selecione subcategoria', 0));
                    data.forEach(function (valor) {
                        $(".subcategoria-select").append(new Option(valor.title, valor.id));
                    });
                }
            });
        });
    }

    if($(".organizacao-select")[0]){
        $(".organizacao-select").on('change', function (e) {
            $(".catorganizacao-select").empty();
            $.ajax({
                type: "POST",
                url: "/admin/organizacoes/findCatorganizacao",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {organizacao: $(".organizacao-select").find(':selected').val()},
                success: function (data) {
                    $(".catorganizacao-select").append(new Option('Selecione categoria de organização', 0));
                    data.forEach(function (valor) {
                        $(".catorganizacao-select").append(new Option(valor.title, valor.id));
                    });
                }
            });
        });
    }

    if($(".categoria-folder")[0]){
        $(".categoria-folder").on('click', function (e) {
            var categoria_id = $(this).attr('data-id');
            window.location.href = "/admin/folder/categoria/"+categoria_id;
        });
    }

    if($(".subcategoria-folder")[0]){
        $(".subcategoria-folder").on('click', function (e) {
            var subcategoria_id = $(this).attr('data-id');
            window.location.href = "/admin/folder/subcategoria/"+subcategoria_id;
        });
    }

    /*if($(".file-folder")[0]){
        $(".file-folder").on('click', function (e) {
            var file_id = $(this).attr('data-id');
            window.location.href = "/admin/folder/subcategoria/"+subcategoria_id;
        });
    }*/

    /*if($(".categoria-folder")[0]){
        $(".categoria-folder").on('click', function (e) {
           var categoria_id = $(this).attr('data-id');
           var folder = $(this);
           $.ajax({
               type: "POST",
               url: "/admin/categorias/findSubcategoria",
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               data: {categoria: categoria_id},
               success: function (data) {
                   data.forEach(function (valor) {
                       console.log($(folder));
                       $(folder).parent().children().eq(1).append(
                           "<li class='folder-root closed'>"+
                           "<a href='#' class='subcategoria-folder' data-id='"+valor.id+"'>"+valor.title+"</a>"+
                           "<ul></ul>"+
                           "</li>"
                       );
                   });
               }
           });
        });
    }*/

    if($(".subcategoria-folder")[0]){
        $(".subcategoria-folder").on('click', function (e) {
           var subcategoria_id = $(this).attr('data-id');
           var folder = $(this);
           $.ajax({
               type: "POST",
               url: "/admin/categorias/findFiles",
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               data: {subcategoria_id: subcategoria_id},
               success: function (data) {
                   data.forEach(function (valor) {
                       $(folder).parent().children().eq(1).append(
                           "<li>"+
                           "<a href='#' data-id='"+valor.id+"'>"+valor.title+"</a>"+
                           "<ul></ul>"+
                           "</li>"
                       );
                   });
               }
           });
        });
    }

    $('.conteudo').each(function (e) {
        var editor = CKEDITOR.replace( this.id, {
            filebrowserBrowseUrl: 'http://localhost/node_modules/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'http://localhost/node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
        CKFinder.setupCKEditor( editor , 'ckfinder/');
    })
  });

/*
 * Some helper functions to work with our UI and keep our code cleaner
 */

// Adds an entry to our debug area
function ui_add_log(message, color)
{
    var d = new Date();

    var dateString = (('0' + d.getHours())).slice(-2) + ':' +
        (('0' + d.getMinutes())).slice(-2) + ':' +
        (('0' + d.getSeconds())).slice(-2);

    color = (typeof color === 'undefined' ? 'muted' : color);

    var template = $('#debug-template').text();
    template = template.replace('%%date%%', dateString);
    template = template.replace('%%message%%', message);
    template = template.replace('%%color%%', color);

    $('#debug').find('li.empty').fadeOut(); // remove the 'no messages yet'
    $('#debug').prepend(template);
}

// Creates a new file and add it to our list
function ui_multi_add_file(id, file)
{
    var template = $('#files-template').text();
    template = template.replace('%%filename%%', file.name);

    template = $(template);
    template.prop('id', 'uploaderFile' + id);
    template.data('file-id', id);

    $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
    $('#files').prepend(template);
}

// Changes the status messages on our list
function ui_multi_update_file_status(id, status, message)
{
    $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
}

// Updates a file progress, depending on the parameters it may animate it or change the color.
function ui_multi_update_file_progress(id, percent, color, active)
{
    color = (typeof color === 'undefined' ? false : color);
    active = (typeof active === 'undefined' ? true : active);

    var bar = $('#uploaderFile' + id).find('div.progress-bar');

    bar.width(percent + '%').attr('aria-valuenow', percent);
    bar.toggleClass('progress-bar-striped progress-bar-animated', active);

    if (percent === 0){
        bar.html('');
    } else {
        bar.html(percent + '%');
    }

    if (color !== false){
        bar.removeClass('bg-success bg-info bg-warning bg-danger');
        bar.addClass('bg-' + color);
    }
}

function ui_add_photo(data)
{
    var list = $('#list-photos');

    var item = "<td class='action'>"+
        "<form action='' method='post'>"+
            "<button class='btn btn-danger' type='submit'>Delete</button>"+
        "</form>"+
        "</td>";

    list.append(item);
}