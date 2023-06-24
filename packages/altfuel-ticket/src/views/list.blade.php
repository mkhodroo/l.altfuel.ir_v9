@extends('layouts.app')


@php
    $title ="";
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="javascript:void(0)" id="cat-form">
                <div class="form-group">
                    <label for="">دسته بندی</label>
                    @include('ATView::partial-view.catagory')
                    <button class="btn btn-info" onclick="filter()">فیلتر</button>
                </div>
            </form>
        </div>
        <table class="table table-stripped" id="tickets-table">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>دسته بندی</th>
                    <th>وضعیت</th>
                    <th>آخرین تغییرات</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('script')
    
    <script>
        function filter(){
            data = $('#cat-form').serialize();
            send_ajax_request(
                "{{ route('ATRoutes.get.getByCatagory') }}",
                data,
                function(data){
                    update_datatable(data);
                }
            )
        }
        var table = create_datatable(
            'tickets-table',
            "{{ route('ATRoutes.get.getAll') }}",
            [
                {data: 'id'},
                {data: 'title', render: function(title){
                    return `<a href="#">${title}</a>`;
                }},
                {data: 'catagory.name'},
                {data: 'status'},
                {data: 'updated_at'}
            ]
        );

        send_ajax_get_request(
            "{{ route('ATRoutes.get.getMyTickets') }}",
            function(data){
                update_datatable(data);
            }
        )

        table.on('click', 'tr', function(){
            var data = table.row( this ).data();
            show_comment_modal(data.id, data.title, data.user_id);
        })
        function show_comment_modal(ticket_id, title ,user){
            var fd = new FormData();
            fd.append('ticket_id', ticket_id);
            send_ajax_formdata_request(
                "{{ route('ATRoutes.show.ticket') }}",
                fd,
                function(body){
                    open_admin_modal_with_data(body, title + '<br>' + user, function(){
                        $(".direct-chat-messages").animate({ scrollTop: $('.direct-chat-messages').prop("scrollHeight")}, 1);
                    });
                },
                function(data){
                    show_error(data);
                    console.log(data);
                }
            )
        }
    </script>
@endsection