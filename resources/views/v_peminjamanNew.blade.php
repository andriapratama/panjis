@extends('layout.v_template')
@section('title', 'Peminjaman')

@section('content')
    <div class="peminjaman-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <label for="name-humas">Nama Humas</label>
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan nama humas" id="name-humas" onkeyup="handleChangeHumasName(this)">
            <div id="error-humas-name"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="name">Nama Peminjam</label>
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan nama peminjam" id="name" onkeyup="handleChangeName(this)">
            <div id="error-name"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="address">Alamat Peminjam</label>
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan alamat peminjam" id="address" onkeyup="handleChangeAddress(this)">
            <div id="error-address"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="phone">No. Telp</label>
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan no telepon peminjam" id="phone" onkeyup="handleChangePhone(this)">
            <div id="error-phone"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="startDate">Tanggal Mulai</label>
            <input class="peminjaman-new__input-date" type="date" id="startDate" onchange="handleChangesStartDate(this)">
            <div id="error-start-date"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <label for="endDate">Tanggal Akhir</label>
            <input class="peminjaman-new__input-date" type="date" id="endDate" onchange="handleChangeEndDate(this)">
            <div id="error-end-date"></div>
        </div>

        <div id="table"></div>
        
        <div class="peminjaman-new__button">
            <button class="peminjaman-new__button-primary" type="button" onclick="handleAddColumnTable()">Tambah</button>
        </div>

        <div class="peminjaman-new__button">
            <button class="peminjaman-new__button-success" type="button" onclick="handleSave()">Simpan</button>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let transactionList = [];
        let humasName = {value: "", error: false};
        let name = {value: "", error: false};
        let address = {value: "", error: false};
        let phone = {value: "", error: false};
        let startDate = {value: "", error: false};
        let endDate = {value: "", error: false};

        const today = new Date();
        const month = (today.getMonth()+1);
        let dateToday = "";
        if (parseInt(month) < 10) {
            dateToday = today.getFullYear()+'-'+"0"+(today.getMonth()+1)+'-'+today.getDate();
        } else {
            dateToday = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        }

        $("document").ready(function() {
            showProduct();
            renderTableTransaction();
            addTransactionItem();
            renderTransactionItem();
        });

        function addTransactionItem() {
            transactionList.push({
                product: "",
                quantity: 0,
            });
        }

        function renderTableTransaction() {
            const element = $('#table').html("");
            element.append(
                '<table class="table">'+
                    '<thead>'+
                        '<tr>'+
                            '<th style="width: 60%;">Nama Barang</th>'+
                            '<th style="width: 20%;">Jumlah</th>'+
                            '<th>Aksi</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody id="table-body"></tbody>'+
                '</table>'
            )
        }

        function renderTransactionItem() {
            const element = $('#table-body');
            element.html("");
            transactionList.forEach((value, index) => {
                element.append(
                    '<tr>'+
                        '<td>'+
                            '<select class="peminjaman-new__input-select" id="select-product'+index+'" value="1" data-index="'+ index +'" onchange="handleChangeProduct(this)"></select>'+
                            '<div id="error-product'+index+'"></div>'+
                        '</td>'+
                        '<td>'+
                            '<input class="peminjaman-new__input-text" type="number" placeholder="Masukkan Jumlah" data-index="'+ index +'" value="'+ parseInt(value.quantity) +'" onkeyup="handleChangeQuantity(this)">'+
                            '<div id="error-quantity'+index+'"></div>'+
                        '</td>'+
                        '<td>'+
                            '<button class="peminjaman-new__table-button-danger" data-index="'+ index +'" onclick="handleDeleteColumnTable(this)">Hapus</button>'+
                        '</td>'+
                    '</tr>'
                );

                showProduct(index, value.product);
            });
        }

        function showProduct(index, id) {
            $.ajax({
                type: 'GET',
                url: '/product',
                success: function(result) {
                    const element = $('#select-product'+index+'').html("");
                    element.append(
                        '<option value="" hidden>Pilih barang</option>'
                    );
                    result.data.forEach((value, index) => {
                        if (value.id === parseInt(id)) {
                            element.append(
                                '<option value="'+ value.id +'" selected="selected">'+ value.name +'</option>'
                            );
                        } else {
                            element.append(
                                '<option value="'+ value.id +'">'+ value.name +'</option>'
                            );
                        }
                    });
                }
            });
        }

        function handleAddColumnTable() {
            transactionList.push({
                product: "",
                quantity: 0,
            });

            renderTransactionItem();
        }

        function handleDeleteColumnTable(e) {
            const index = $(e).data('index');

            if(transactionList.length === 1) {
                transactionList = [{
                    product: "",
                    quantity: 0,
                }];

                renderTransactionItem();
            } else {
                transactionList.splice(index, 1);

                renderTransactionItem();
            }
        }

        function handleChangeHumasName(e) {
            const value =  $(e).val();

            humasName.value = value;
            humasName.error = false;

            $('#error-humas-name').html("");
        }

        function handleChangeName(e) {
            const value =  $(e).val();

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

        function handleChangesStartDate(e) {
            const value = $(e).val();

            if (value < dateToday) {
                const el = $('#error-start-date').html("");
                el.append(
                    '<span class="error">Tanggal tidak boleh kurang dari hari ini</span>'
                )
                
                startDate.value = "";
                startDate.error = true;

                $(e).val("");
            } else {
                startDate.value = value;
                startDate.error = false;

                $('#error-start-date').html("");
            }
        }

        function handleChangeEndDate(e) {
            const value = $(e).val();

            const el = $('#error-end-date').html("");
            if (value < dateToday) {
                el.append(
                    '<span class="error">Tanggal tidak boleh kurang dari hari ini</span>'
                )
                
                endDate.value = "";
                endDate.error = true;

                $(e).val("");
            } else if (endDate.value < startDate.value) {
                el.append(
                    '<span class="error">Tanggal akhir tidak boleh kurang dari tanggal awal</span>'
                );

                endDate.value = "";
                endDate.error = true;

                $(e).val("");
            } else {
                endDate.value = value;
                endDate.error = false;
    
                $('#error-end-date').html("");
            }

        }

        function handleChangeProduct(e) {
            const value = $(e).val();
            const index = $(e).data('index');

            const check = transactionList.findIndex((values) => values.product === value);

            if (check === -1) {
                transactionList[index].product = value;
                $('#error-product'+index+'').html("");
            } else {
                const element = $('#error-product'+index+'').html("");
                element.append(
                    '<span class="error">Barang sudah dipilih</span>'
                );

                transactionList[index].product = "";

                showProduct(index);
            }

        }

        function handleChangeQuantity(e) {
            const value = $(e).val();
            const index = $(e).data('index');

            transactionList[index].quantity = parseInt(value);

            $('#error-quantity'+index+'').html("");
        }

        function handleSave() {
            const humasNameEl = $('#error-humas-name').html("");
            const nameEl = $('#error-name').html("");
            const addressEl = $('#error-address').html("");
            const phoneEl = $('#error-phone').html("");
            const startDateEl = $('#error-start-date').html("");
            const endDateEl = $('#error-end-date').html("");

            if (humasName.value === "") {
                humasNameEl.append(
                    '<span class="error">Nama Humas harus diisi</span>'
                );
                humasName.error = true;
            }
            
            if (name.value === "") {
                nameEl.append(
                    '<span class="error">Nama peminjam harus diisi</span>'
                );
                name.error = true;
            }

            if (address.value === "") {
                addressEl.append(
                    '<span class="error">Alamat peminjam harus diisi</span>'
                );
                address.error = true;
            }

            if (phone.value === "") {
                phoneEl.append(
                    '<span class="error">No telepon peminjam harus diisi</span>'
                );
                phone.error = true;
            }
            
            if (startDate.value === "") {
                startDateEl.append(
                    '<span class="error">Tanggal awal harus diisi</span>'
                );
                startDate.error = true;
            }

            if (endDate.value === "") {
                endDateEl.append(
                    '<span class="error">Tanggal akhir harus diisi</span>'
                );
                endDate.error = true;
            }

            transactionList.forEach((value, index) => {
                if (value.product === "") {
                    const element = $('#error-product'+index+'').html("");
                    element.append(
                        '<span class="error">Barang harus diisi</span>'
                    );
                }

                if (value.quantity === 0) {
                    const element = $('#error-quantity'+index+'').html("");
                    element.append(
                        '<span class="error">Jumlah tidak boleh 0</span>'
                    );
                }
            });

            const checkProduct = transactionList.findIndex((value) => !value.name && value.quantity === 0);

            if (humasName.error === false && name.error === false && address.error === false && phone.error === false && startDate.error === false && endDate.error === false && checkProduct === -1) {
                storeData();
            }
        }

        function storeData() {
            const formData = new FormData();
            formData.append('humasName', humasName.value);
            formData.append('name', name.value);
            formData.append('address', address.value);
            formData.append('phone', phone.value);
            formData.append('startDate', startDate.value);
            formData.append('endDate', endDate.value);

            transactionList.forEach((value, index) => {
                formData.append('transactionList['+ index +'][product]', value.product);
                formData.append('transactionList['+ index +'][quantity]', value.quantity);
            });

            $.ajax({
                type: 'POST',
                url: '/api/loan',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = '/peminjaman';
                }
            });
        }
    </script>
@endsection