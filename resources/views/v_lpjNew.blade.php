@extends('layout.v_template')
@section('title', 'Lembar Pertanggung Jawaban')

@section('content')
    <div class="lpj-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <label for="date">Judul</label>
            <input class="input-text" type="text" id="title" placeholder="Masukkan judul lembar pertanggung jawaban" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="file">File LPJ</label>
            <input class="input-text" type="file" id="file" accept="application/pdf" onchange="handleChangeFile(this)">
            <div id="error-file"></div>
        </div>

        <button class="button-success" type="button" onclick="handleSave()">Simpan</button>
        <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let title = {value: "", error: false};
        let file = {value: null, error: false};

        function handleChangeTitle(e) {
            const value = $(e).val();

            title.value = value;
            title.error = false;

            $('#error-title').html("");
        }

        function handleChangeFile(e) {
            const value = $(e)[0].files[0];

            file.value = value;
            file.error = false;

            $('#error-file').html("");
        }

        function handleSave() {
            const titleEl = $('#error-title').html("");
            const fileEl = $('#error-file').html("");

            if (title.value === "") {
                titleEl.append(
                    '<span class="error">Judul LPJ harus diisi</span>'
                )
                title.error = true;
            }

            if (file.value === null) {
                fileEl.append(
                    '<span class="error">File LPJ harus diisi</span>'
                )
                file.error = true;
            }

            if (title.error === false && file.error === false) {
                storeData();
            }
        }

        function storeData() {
            const formData = new FormData();
            formData.append('title', title.value);
            formData.append('file', file.value);

            $.ajax({
                type: 'POST',
                url: '/api/report',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = '/lpj';
                }
            });
        }
    </script>
@endsection