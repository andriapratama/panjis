@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
    <div class="publikasi-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <input class="publikasi-new__input-text" type="text" placeholder="Masukkan Judul gambar" id="title" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>

        <div style="margin-bottom: 13px; display: block;">
            <textarea class="publikasi-new__textarea" placeholder="Masukkan deskripsi gambar" onkeyup="handleChangeDesc(this)"></textarea>
            <div id="error-desc"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="publikasi-new__input-file" type="file" id="image" accept="image/png, image/gif, image/jpeg, image/jpg" onchange="handleChangeImage(this)">
            <div id="error-image"></div>
        </div>

        <div id="preview" class="publikasi-new__preview-image" ></div>

        <div>
            <button class="publikasi-new__button-success" type="button" onclick="handleSave()">Simpan</button>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let title = "";
        let desc = "";
        let imageFile = null;

         $("document").ready(function() {
            $('#preview').html("");
        });

         function handleChangeTitle(e) {
            const value = $(e).val();

            title = value;

            const element = $('#error-title');
            element.html("");
         }

         function handleChangeDesc(e) {
            const value = $(e).val();

            desc = value;

            const element = $('#error-desc');
            element.html("");
         }

         function handleChangeImage(e) {
            const value = $(e).val();
            const file = $(e)[0].files[0];

            imageFile = file;

            const previewImage = $('#preview').html("");
            previewImage.append(
                '<img src="" id="preview-image" alt="preview">'
            );

            const imageURL = URL.createObjectURL(file);
            $('#preview-image').attr('src', imageURL); 

            const element = $('#error-image');
            element.html("");
         }

         function handleSave() {
            if (title === "") {
                const element = $('#error-title');
                element.html("");
                element.append(
                    '<span class="error">Judul harus diisi</span>'
                );
            }

            if (desc === "") {
                const element = $('#error-desc');
                element.html("");
                element.append(
                    '<span class="error">Deskripsi harus diisi</span>'
                );
            }

            if (imageFile === null) {
                const element = $('#error-image');
                element.html("");
                element.append(
                    '<span class="error">Image harus diisi</span>'
                );
            }

            if (title !== "" && desc !== "" && imageFile !== null){
                storeData();
            }
         }

         function storeData() {
            const formData = new FormData();
            formData.append('title', title);
            formData.append('desc', desc);
            formData.append('image', imageFile);

            $.ajax({
                type: 'POST',
                url: '/api/gallery',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/publikasi";
                }
            });
         }
    </script>
@endsection