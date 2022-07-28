@extends('layout.v_template')
@section('title', 'Absen')

@section('content')
    <div class="absen-new__container">
        <div class="absen-new__card">
            <div class="absen-new__head">
                <div class="absen-new__head-group">
                    <p style="width: 100px;">Judul</p>
                    <p id="title"></p>
                </div>
    
                <div class="absen-new__head-group">
                    <p style="width: 100px;">Tanggal</p>
                    <p id="date"></p>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th>Name</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body"></tbody>
            </table>

            <a class="absen-new__button-secondary" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/absen/first-data',
                success: function(result) {
                    const date = new Date(result.absent.created_at);
					const dateFormat = new Intl.DateTimeFormat(['ban', 'id']).format(date);

                    $('#title').html(": " + result.absent.title);
                    $('#date').html(": " + dateFormat );

                    const element = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        if (value.status === 1) {
                            element.append(
                                '<tr>'+
                                    '<td>'+ (index+1) +'</td>'+
                                    '<td>'+ value.full_name +'</td>'+
                                    '<td>'+
                                        '<input type="checkbox" id="status'+index+'" data-index="'+ index +'" data-id="'+value.id+'" checked onchange="handleChangeCheck(this)">'+
                                    '</td>'+
                                '</tr>'
                            )
                        } else if (value.status === 0) {
                            element.append(
                                '<tr>'+
                                    '<td>'+ (index+1) +'</td>'+
                                    '<td>'+ value.full_name +'</td>'+
                                    '<td>'+
                                        '<input type="checkbox" id="status'+index+'" data-index="'+ index +'" data-id="'+value.id+'" onchange="handleChangeCheck(this)">'+
                                    '</td>'+
                                '</tr>'
                            );
                        }
                    });
                }
            });
        }

        function handleChangeCheck(e) {
            const el = $(e);
            const id = el.data('id');
            let value = 0;

            if(el.is(':checked')) {
                el.attr('value', 1)
                value = el.val();
            } else {
                el.attr('value', 0);
                value = el.val();
            }
            
            const formData = new FormData();
            formData.append('absentDetailId', id);
            formData.append('status', value);

            $.ajax({
                type: 'POST',
                url: '/api/absent/update',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    null
                }
            })
        }
    </script>
@endsection