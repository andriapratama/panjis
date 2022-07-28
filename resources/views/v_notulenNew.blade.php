@extends('layout.v_template')
@section('title', 'Notulen')

@section('content')
    <div class="notulen-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <label for="date">Tanggal</label>
            <input class="notulen-new__input-date" type="date" id="date" onchange="handleChangeDate(this)">
            <div id="error-date"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="title">Judul</label>
            <input class="notulen-new__input-text" type="text" placeholder="Masukkan judul" id="title" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="total">Total Anggota</label>
            <input class="notulen-new__input-text" type="number" placeholder="Masukkan total kehadiran anggota " id="total" onkeyup="handleChangeTotal(this)">
            <div id="error-total"></div>
        </div>
    </div>

    <div class="notulen-new__container">
        <div id="text-space"></div>
        
        <button class="notulen-new__button-primary" type="button" onclick="handleAddParagraf()">Tambah Paragraf</button>
        <button class="notulen-new__button-primary" type="button" onclick="handleAddList()">Tambah List</button>
        <button class="notulen-new__button-success" type="button" onclick="handleSave()">Simpan</button>
        <a class="notulen-new__button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let textList = [];
        let date = {value: "", error: false};
        let title = {value: "", error: false};
        let total = {value: "", error: false};

        const today = new Date();
        const month = (today.getMonth()+1);
        let dateToday = "";
        if (parseInt(month) < 10) {
            dateToday = today.getFullYear()+'-'+"0"+(today.getMonth()+1)+'-'+today.getDate();
        } else {
            dateToday = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        }

        $("document").ready(function() {
            addTextItem();
            renderTextItem();
        });

        function addTextItem() {
            textList.push({
                status: 0,
                content: "",
            });
        }

        function renderTextItem() {
            const el = $('#text-space').html("");
            textList.forEach((value, index) => {
                if (value.status === 0) {
                    el.append(
                        '<div class="notulen-new__group">'+
                            '<div style="margin-bottom: 20px; display: block; width: 90%;">'+
                                '<label for="paragraf'+index+'">Paragraf</label>'+
                                '<textarea class="notulen-new__input-textarea" id="paragraf'+index+'" placeholder="Masukkan paragraf" data-index="'+index+'" onkeyup="handleChangeParagraf(this)">'+value.content+'</textarea>'+
                                '<div id="error-paragraf'+index+'"></div>'+
                            '</div>'+
                            
                            '<button class="notulen-new__table-button-danger" data-index="'+index+'" onclick="handleDeleteRow(this)">Hapus</button>'+
                        '</div>'
                    );
                } else if (value.status === 1) {
                    el.append(
                        '<div class="notulen-new__group">'+
                            '<div style="margin-bottom: 20px; display: block; width: 90%;">'+
                                '<label for="list'+index+'">List</label>'+
                                '<textarea class="notulen-new__input-textarea" id="list'+index+'" placeholder="Masukkan list" data-index="'+index+'" onkeyup="handleChangeList(this)">'+value.content+'</textarea>'+
                                '<div id="error-list'+index+'"></div>'+
                            '</div>'+
                            
                            '<button class="notulen-new__table-button-danger" data-index="'+index+'" onclick="handleDeleteRow(this)">Hapus</button>'+
                        '</div>'
                    );
                }
            });
        }

        function handleAddParagraf() {
            textList.push({
                status: 0,
                content: ""
            });

            renderTextItem();
        }

        function handleAddList() {
            textList.push({
                status: 1,
                content: ""
            });

            renderTextItem();
        }

        function handleDeleteRow(e) {
            const index = $(e).data('index');

            if (textList.length === 1) {
                textList = [{
                    status: 0,
                    content: "",
                }];

                renderTextItem();
            } else {
                textList.splice(index, 1);

                renderTextItem();
            }
        }

        function handleChangeDate(e) {
            const value = $(e).val();

            date.value = value;
            date.error = false;

            $('#error-date').html("");
        }
        
        function handleChangeTitle(e) {
            const value = $(e).val();

            title.value = value;
            title.error = false;

            $('#error-title').html("");
        }

        function handleChangeTotal(e) {
            const value = $(e).val();

            total.value = value;
            total.error = false;

            $('#error-total').html("");
        }

        function handleChangeParagraf(e) {
            const index = $(e).data('index');
            const value = $(e).val();

            textList[index].content = value;

            $('#error-paragraf'+index+'').html("");
        }

        function handleChangeList(e) {
            const index = $(e).data('index');
            const value = $(e).val();

            textList[index].content = value;

            $('#error-list'+index+'').html("");
        }

        function handleSave() {
            const dateEl = $('#error-date').html("");
            const titleEl = $('#error-title').html("");
            const totalEl = $('#error-total').html("");

            if (date.value === "") {
                dateEl.append(
                    '<span class="error">Tanggal harus diisi</span>'
                );
                date.error = true;
            }

            if (title.value === "") {
                titleEl.append(
                    '<span class="error">Judul harus diisi</span>'
                );
                title.error = true;
            }
            
            if (total.value === "") {
                totalEl.append(
                    '<span class="error">Total kehadiran anggota harus diisi</span>'
                );
                total.error = true;
            }

            textList.forEach((value, index) => {
                if (value.status === 0 && value.content === "") {
                    const el = $('#error-paragraf'+index+'').html("");
                    el.append(
                        '<span class="error">Paragraf harus diisi</span>'
                    );
                } else if (value.status === 1 && value.content === "") {
                    const el = $('#error-list'+index+'').html("");
                    el.append(
                        '<span class="error">List harus diisi</span>'
                    );
                }
            })
            
            const checkText = textList.findIndex((value) => !value.content);

            if (date.error === false && title.error === false && total.error === false && checkText === -1) {
                storeData();
            }
        }

        function storeData() {
            const formData = new FormData();
            formData.append('date', date.value);
            formData.append('title', title.value);
            formData.append('total', total.value);

            textList.forEach((value, index) => {
                formData.append('textList['+ index +'][content]', value.content);
                formData.append('textList['+ index +'][status]', value.status);
            });

            $.ajax({
                type: 'POST',
                url: '/api/note',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/notulen";
                }
            });
        }

    </script>
@endsection