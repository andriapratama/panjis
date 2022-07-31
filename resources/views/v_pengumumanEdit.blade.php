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

        <button class="button-success" type="button" onclick="handleUpdate()">Simpan</button>
        <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';
        let title = {value: "", error: false};
        let announ = {value: "", error: false};
        let date = {value: "", error: false};

        const today = new Date();
        const month = (today.getMonth()+1);
        let dateToday = "";
        if (parseInt(month) < 10) {
            dateToday = today.getFullYear()+'-'+"0"+(today.getMonth()+1)+'-'+today.getDate();
        } else {
            dateToday = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        }

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/announ/' + id,
                success: function(result) {
                    const data = result.data;

                    title.value = data.title;
                    announ.value = data.announ;
                    date.value = data.date;

                    $('#title').val(data.title);
                    $('#announ').val(data.announ);
                    $('#date').val(data.date);
                }
            });
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

        function handleUpdate() {
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
                updateData();
            }
        }

        function updateData() {
            const formData = new FormData();
            formData.append('title', title.value);
            formData.append('announ', announ.value);
            formData.append('date', date.value);

            $.ajax({
                type: 'POST',
                url: '/api/announ/update/' + id,
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