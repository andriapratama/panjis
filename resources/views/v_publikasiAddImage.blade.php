@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
    <div class="publikasi-new__container">

        <div id="image-space"></div>

        <div>
            <button class="button-primary-full" type="button" onclick="handleAddImage()">Tambah Gambar</button>
            <button class="button-success-full" type="button" onclick="handleSave()">Simpan</button>
            <a class="button-secondary-full" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';
        let imageFile = [];

        $("document").ready(function() {
            addImageFile();
            renderImageInput();
        });

        function addImageFile() {
            imageFile.push({
                name: "",
                value: null,
                preview: null,
            });
        }

        function renderImageInput() {
            const el = $('#image-space').html("");
            imageFile.forEach((data, index) => {
                el.append(
                    '<div style="margin-bottom: 20px; display: block;">'+
                        '<div style="display: flex; justify-content: space-between; items-content: center;">'+
                            '<input class="input-file" style="width: 90%;" type="file" id="image" accept="image/png, image/gif, image/jpeg, image/jpg" data-index="'+index+'" value="'+data.name+'" onchange="handleChangeImage(this)">'+
                            '<button class="table-button-danger type="button" data-index="'+index+'" onclick="handleDeleteColumn(this)">Hapus</button>'+
                        '</div>'+
                        '<div id="error-image'+index+'"></div>'+
                    '</div>'+

                    '<div id="preview'+index+'" class="publikasi-new__preview-image"></div>'
                );

                if (data.preview === null) {
                    $('#preview'+index+'').html("");
                } else {
                    const el = $('#preview'+index+'').html("");
                    el.append(
                        '<img src="'+data.preview+'" id="preview-image'+index+'" alt="preview'+index+'">'
                    );
                }
            });
        }

        function handleAddImage() {
            imageFile.push({
                name: "",
                value: null,
                preview: null,
            });

            renderImageInput();
        }

        function handleDeleteColumn(e) {
            const index = $(e).data('index');

            if (imageFile.length === 1) {
                imageFile = [{
                    name: "",
                    value: null,
                    preview: null,
                }];

                renderImageInput();
            } else {
                imageFile.splice(index, 1);

                renderImageInput();
            }
        }

        function handleChangeImage(e) {
            const index = $(e).data('index');
            const name = $(e)[0].files[0].name;
            const file = $(e)[0].files[0];

            imageFile[index].name = name;
            imageFile[index].value = file;
            
            const imageURL = URL.createObjectURL(file);
            imageFile[index].preview = imageURL;

            const element = $('#error-image'+index+'');
            element.html("");

            renderImageInput();
        }

        function handleSave() {
            imageFile.forEach((data, index) => {
                if (data.value === null) {
                    const element = $('#error-image'+index+'').html("");
                    element.append(
                        '<span class="error">Image harus diisi</span>'
                    );
                }
            });

            const checkImage = imageFile.findIndex((data) => !data.value);

            if (checkImage === -1){
                updateData();
            }
        }

        function updateData() {
            const formData = new FormData();

            imageFile.forEach((data, index) => {
                formData.append('image['+index+'][value]', data.value);
            });

            $.ajax({
                type: 'POST',
                url: '/api/gallery/image/' + id,
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