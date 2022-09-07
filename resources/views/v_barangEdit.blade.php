@extends('layout.v_template')
@section('title', 'Barang')

@section('content')
    <div class="barang-edit__container">
        <div class="barang-edit__card">
            <div style="margin-bottom: 20px; display: block;">
                <input class="input-text" type="text" placeholder="Masukkan nama barang" id="name" onkeyup="handleChangeName(this)">
                <div id="error-name"></div>
            </div>

            <div style="margin-bottom: 20px; display: block;">
                <input class="input-text" type="number" placeholder="Masukkan jumlah barang" id="quantity" onkeyup="handleChangeQuantity(this)">
                <div id="error-quantity"></div>
            </div>

            <div style="margin-bottom: 20px; display: block;">
                <select class="input-select" id="unit" onchange="handleChangeUnit(this)">
                    <option value="" hidden>Pilih satuan barang</option>
                    <option value="buah">Buah</option>
                    <option value="lembar">Lembar</option>
                    <option value="gulung">Gulung</option>
                    <option value="kg">Kg</option>
                    <option value="g">g</option>
                </select>
                <div id="error-unit"></div>
            </div>

            <button class="button-success" type="button" onclick="handleUpdate()">Simpan</button>
            <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';
        let name = {value: "", error: false};
        let quantity = {value: "", error: false};
        let unit = {value: "", error: false};

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/product/' + id,
                success: function(result) {
                    const data = result.data;
                    name.value = data.name;
                    quantity.value = data.quantity;
                    unit.value = data.unit;

                    $('#name').val(data.name);
                    $('#quantity').val(data.quantity);
                    $('#unit').val(data.unit);
                }
            });
        }

        function handleChangeName(e) {
            const value = $(e).val();

            name.value = value;

            $('#error-name').html("");
            name.error = false;
        }
        function handleChangeQuantity(e) {
            const value = $(e).val();

            quantity.value = value;

            $('#error-quantity').html("");
            quantity.error = false;
        }
        function handleChangeUnit(e) {
            const value = $(e).val();

            unit.value = value;

            $('#error-unit').html("");
            unit.error = false;
        }

        function handleUpdate() {
            const nameElement = $('#error-name').html("");
            const quantityElement = $('#error-quantity').html("");
            const unitElement = $('#error-unit').html("");

            if (name.value === "") {
                nameElement.append(
                    '<span class="error">Nama barang harus diisi</span>'
                );
                name.error = true;
s            }

            if (quantity.value === "") {
                quantityElement.append(
                    '<span class="error">Jumlah barang harus diisi</span>'
                );
                quantity.error = true;
            }
            
            if (unit.value === "") {
                unitElement.append(
                    '<span class="error">Unit barang harus diisi</span>'
                );
                unit.error = true;
            }

            if (name.error === false && quantity.error === false && unit.error === false) {
                updateData();
            }
        }

        function updateData() {
            const formData = new FormData();
            formData.append('name', name.value);
            formData.append('quantity', quantity.value);
            formData.append('unit', unit.value);

            $.ajax({
                type: 'POST',
                url: '/api/product/update/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/barang";
                }
            });
        }
    </script>
@endsection