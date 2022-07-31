@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
    <div class="publikasi-edit__container">
        <div class="publikasi-edit__card">
            <div style="margin-bottom: 20px; display: block;">
                <input class="input-text" type="text" placeholder="Masukkan Judul gambar" id="title" onkeyup="handleChangeTitle(this)">
                <div id="error-title"></div>
            </div>

            <div style="margin-bottom: 13px; display: block;">
                <textarea class="input-textarea" placeholder="Masukkan deskripsi gambar" id="desc" onkeyup="handleChangeDesc(this)"></textarea>
                <div id="error-desc"></div>
            </div>

            <div style="display: flex;">
                <button class="button-success" type="button" onclick="handleSave()">Simpan</button>
                <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
            </div>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';
        let title = "";
        let desc = "";

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/gallery/edit/' + id,
                success: function(result) {
                    title = result.data.title;
                    desc = result.data.desc;

                    $('#title').val(result.data.title);
                    $('#desc').val(result.data.desc);
                }
            });
        }

        function handleChangeTitle(e) {
            const value = $(e).val();

            title = value;

            $('#error-title').html("");
        }

        function handleChangeDesc(e) {
            const value = $(e).val();

            desc = value;

            $('#error-desc').html("");
        }

        function handleSave() {
            if (title === "") {
                const element = $('#error-title').html("");
                element.append(
                    '<span class="error">Judul harus diisi</span>'
                );
            }

            if (desc === "") {
                const element = $('#error-desc').html("");
                element.append(
                    '<span class="error">Deskripsi harus diisi</span>'
                );
            }

            if (title !== "" && desc !== ""){
                updateData();
            }
         }

         function updateData() {
            const formData = new FormData();
            formData.append('title', title);
            formData.append('desc', desc);

            $.ajax({
                type: 'POST',
                url: '/api/gallery/update/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/publikasi/detail/" + id;
                }
            });
         }
    </script>
@endsection