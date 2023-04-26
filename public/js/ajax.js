function send_ajax_request(url, data, callback, erCallback = null){
    show_loading()
    if(erCallback == null){
        erCallback= function(data){ 
            hide_loading();
            error_notification('<p dir="ltr">' + JSON.stringify(data) + '</p>');
        }
    }
    return $.ajax({
        url: url,
        data: data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
        success: function(){
            hide_loading();
        },
        error: erCallback
    })
    .done(callback)
    .catch(erCallback);
}

function send_ajax_get_request(url, callback, erCallback = null){
    show_loading()
    if(erCallback == null){
        erCallback= function(data){ 
            hide_loading();
            error_notification('<p dir="ltr">' + JSON.stringify(data) + '</p>');
        }
    }
    return $.ajax({
        url: url,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        success: function(){
            hide_loading();
        },
        error: erCallback
    })
    .done(callback);
}

function send_ajax_get_request_with_confirm(url, callback, message = "Are you sure?", erCallback = null){
    if (confirm(message) == true) {
        show_loading()
        if(erCallback == null){
            erCallback= function(data){ 
                hide_loading();
                error_notification('<p dir="ltr">' + JSON.stringify(data) + '</p>');
            }
        }
        return $.ajax({
                url: url,
                processData: false,
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                success: function(){
                    hide_loading();
                },
                error: erCallback
            })
            .done(callback);
    } else {
        return false;
    }
}

function show_loading(){
    $('#preloader').show();
}

function hide_loading(){
    $('#preloader').hide();
}

function open_admin_modal(url, title = ''){
    var modal = $('<div class="modal fade" id="admin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
                    '<div class="modal-dialog modal-lg">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                    '<h4 class="modal-title" id="myModalLabel">'+ title +'</h4>' +
                    '</div>' +
                    '<div class="modal-body" id="modal-body">' +
                    '<p>Modal content goes here.</p>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
    
    $('body').append(modal);
    
    $('#admin-modal').on('hidden.bs.modal', function () {
        $(this).remove();
      });
      
      
    send_ajax_get_request(
        url,
        function(data){
            $('#admin-modal #modal-body').html(data);
            $('#admin-modal').modal('show')
        }
    )
}


