@extends('layout.v_template')
@section('title', 'Admin')

@section('content')
    <div class="admin__container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="admin__input-select" id="role" onchange="handleChangeRole(this)">
                        <option value="" hidden>Pilih role</option>
                        <option value="1">Admin</option>
                        <option value="2">Sekretaris</option>
                        <option value="3">Bendahara</option>
                        <option value="4">Anggota</option>
                        <option value="5">Pengembangan</option>
                        <option value="6">Publikasi</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="handleClose()">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="handleSave()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let id = null;
        let role = null;

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/user',
                success: function(result) {
                    const el = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        el.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td>'+ value.name +'</td>'+
                                '<td>'+ value.email +'</td>'+
                                '<td id="role'+index+'"></td>'+
                                '<td>'+
                                    '<button class="admin__table-button-secondary" type="button" data-toggle="modal" data-target="#edit-modal" data-id="'+value.id+'" data-role="'+value.level+'" onclick="handleEditRoleModal(this)">Edit Role</button>'+
                                '</td>'+
                            '</tr>'
                        );

                        const roleEl = $('#role'+index+'')

                        if (value.level === 1) {
                            roleEl.html("Admin");
                        } else if (value.level === 2) {
                            roleEl.html("Sekretaris");
                        } else if (value.level === 3) {
                            roleEl.html("Bendahara");
                        } else if (value.level === 4) {
                            roleEl.html("Anggota");
                        } else if (value.level === 5) {
                            roleEl.html("Pengembangan");
                        } else if (value.level === 6) {
                            roleEl.html("Publikasi");
                        }
                    });
                }
            });
        }

        function handleEditRoleModal(e) {
            id = $(e).data('id');
            role = $(e).data('role');

            $('#role').val(role);
        }

        function handleChangeRole(e) {
            const value = $(e).val();

            role = parseInt(value);
        }

        function handleClose() {
            id = null;
            role = null;
        }

        function handleSave() {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('role', role);

            $.ajax({
                type: 'POST',
                url: '/api/user/role',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    id = null;
                    role = null;
                    $('#edit-modal').modal('hide');
                    showData();
                }
            });
        }
    </script>
@endsection