@extends('layout.v_template')
@section('title', 'Pengumuman')

@section('content')
    <div class="pengumuman-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <label for="title">Judul</label>
            <input class="input-text" type="text" placeholder="Masukkan judul" id="title" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="announ">Isi Pengumuman</label>
            <input class="input-text" type="text" placeholder="Masukkan isi pengumuman" id="announ" onkeyup="handleChangeAnnoun(this)">
            <div id="error-announ"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="date">Tanggal</label>
            <input class="input-date" type="date" id="date" onchange="handleChangeDate(this)">
            <div id="error-date"></div>
        </div>

        <button class="button-success" type="button" onclick="handleSave()">Simpan</button>
        <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let title = {value: "", error: false};
        let announ = {value: "", error: false};
        let date = {value: "", error: false};

        const today = new Date();
        const month = (today.getMonth()+1);
        const day = today.getDate();

        let dateToday = "";
        if (parseInt(month) < 10) {
            if (parseInt(day) < 10) {
                dateToday = today.getFullYear()+'-0'+(today.getMonth()+1)+'-0'+today.getDate();
            } else {
                dateToday = today.getFullYear()+'-0'+(today.getMonth()+1)+'-'+today.getDate();
            }
        } else {
            if (parseInt(day) < 10) {
                dateToday = today.getFullYear()+'-'+(today.getMonth()+1)+'-0'+today.getDate();
            } else {
                dateToday = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            }
        }

        function handleChangeTitle(e) {
            const value = $(e).val();

            title.value = value;
            title.error = false;

            $('#error-title').html("");
        }

        function handleChangeAnnoun(e) {
            const value = $(e).val();

            announ.value = value;
            announ.error = false;

            $('#error-announ').html("");
        }

        function handleChangeDate(e) {
            const value = $(e).val();

            if (value < dateToday) {
                const el = $('#error-date').html("");
                el.append(
                    '<span class="error">Tanggal tidak boleh kurang dari hari ini</span>'
                )
                
                date.value = "";
                date.error = true;

                $(e).val("");
            } else {
                date.value = value;
                date.error = false;
    
                $('#error-date').html("");
            }
        }

        function handleSave() {
            const titleEl = $('#error-title').html("");
            const announEl = $('#error-announ').html("");
            const dateEl = $('#error-date').html("");

            if (title.value === "") {
                titleEl.append(
                    '<span class="error">Judul harus diisi</span>'
                );
                title.error = true;
            }

            if (announ.value === "") {
                announEl.append(
                    '<span class="error">Isi pengumuman harus diisi</span>'
                );
                title.error = true;
            }

            if (date.value === "") {
                dateEl.append(
                    '<span class="error">Tanggal harus diisi</span>'
                );
                date.error = true;
            }

            if (title.error === false && announ.error === false && date.error === false) {
                storeData();
            }
        }

        function storeData() {
            const formData = new FormData();
            formData.append('title', title.value);
            formData.append('announ', announ.value);
            formData.append('date', date.value);

            $.ajax({
                type: 'POST',
                url: '/api/announ',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/pengumuman";
                }
            });
        }
    </script>
@endsection