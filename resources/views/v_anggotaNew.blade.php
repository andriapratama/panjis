@extends('layout.v_template')
@section('title', 'Anggota')

@section('content')
    <div class="anggota-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <input class="anggota-new__input-text" type="number" placeholder="Masukkan nik anggota" id="nik" onkeyup="handleChangeNik(this)">
            <div id="error-nik"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="anggota-new__input-text" type="text" placeholder="Masukkan nama lengkap anggota" id="name" onkeyup="handleChangeName(this)">
            <div id="error-name"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="anggota-new__input-text" type="text" placeholder="Masukkan alamat anggota" id="address" onkeyup="handleChangeAddress(this)">
            <div id="error-address"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="anggota-new__input-text" type="number" placeholder="Masukkan no hp anggota" id="phone" onkeyup="handleChangePhone(this)">
            <div id="error-phone"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <select class="anggota-new__input-select" onchange="handleChangeGender(this)">
                <option value="" hidden>Pilih jenis kelamin</option>
                <option value="laki-laki">Laki-Laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
            <div id="error-gender"></div>
        </div>
        
        <button class="anggota-new__button-success" type="button" onclick="handleSave()">Simpan</button>
        <a class="anggota-new__button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let nik = {value: "", error: false};
        let name = {value: "", error: false};;
        let address = {value: "", error: false};;
        let phone = {value: "", error: false};;
        let gender = {value: "", error: false};;

        function handleChangeNik(e) {
            const value = $(e).val();

            nik.value = value;
            nik.error = false;

           $('#error-nik').html("");
        }
        
        function handleChangeName(e) {
            const value = $(e).val();

            name.value = value;
            name.error = false;

            $('#error-name').html("");
        }
        
        function handleChangeAddress(e) {
            const value = $(e).val();

            address.value = value;
            address.error = false;

            $('#error-address').html("");
        }

        function handleChangePhone(e) {
            const value = $(e).val();

            phone.value = value;
            phone.error = false;

            $('#error-phone').html("");
        }

        function handleChangeGender(e) {
            const value = $(e).val();

            gender.value = value;
            gender.error = false;

            $('#error-gender').html("");
        }

        function handleSave() {
            const elementNik = $('#error-nik').html("");
            const elementName = $('#error-name').html("");
            const elementAddress = $('#error-address').html("");
            const elementPhone = $('#error-phone').html("");
            const elementGender = $('#error-gender').html("");

            if (nik.value === "") {
                elementNik.append(
                    '<span class="error">NIK anggota harus diisi</span>'
                );
                nik.error = true;
            } else if (nik.value.length !== 16) {
                elementNik.append(
                    '<span class="error">NIK anggota tidak valid dan harus 16 karakter</span>'
                );
                nik.error = true;
            }
            
            if (name.value === "") {
                elementName.append(
                    '<span class="error">Nama lengkap anggota harus diisi</span>'
                );
                name.error = true;
            } else if (name.value.ength < 5) {
                elementName.append(
                    '<span class="error">Nama lengkap anggota minimal 5 karakter</span>'
                );
                name.error = true;
            }

            if (address.value === "") {
                elementAddress.append(
                    '<span class="error">Alamat anggota harus diisi</span>'
                );
                address.error = true;
            } else if (address.value.length < 5) {
                elementAddress.append(
                    '<span class="error">Alamat anggota minimal 5 karakter</span>'
                );
                address.error = true;
            }

            if (phone.value === "") {
                elementPhone.append(
                    '<span class="error">No HP anggota harus diisi</span>'
                );
                phone.error = true;
            } else if (phone.value.length < 8) {
                elementPhone.append(
                    '<span class="error">No HP anggota minimal 8 karakter</span>'
                );
                phone.error = true;
            } else if (phone.value.length > 12) {
                elementPhone.append(
                    '<span class="error">No HP anggota maksimal 12 karakter</span>'
                );
                phone.error = true;
            }

            if (gender.value === "") {
                elementGender.append(
                    '<span class="error">Jenis kelamin anggota harus diisi</span>'
                );
                gender.error = true;
            }

            if (nik.error === false && name.error === false && address.error === false && phone.error === false && gender.error === false) {
                storeData();
            }
        }

        function storeData() {
            const formData = new FormData();
            formData.append('nik', nik.value);
            formData.append('name', name.value);
            formData.append('address', address.value);
            formData.append('phone', phone.value);
            formData.append('gender', gender.value);

            $.ajax({
                type: 'POST',
                url: '/api/member',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/anggota"
                }
            });
        }

    </script>
@endsection