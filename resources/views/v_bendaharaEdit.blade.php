@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
    <div class="bendahara-edit__container">
        <h3 id="title-page" style="margin-bottom: 20px;"></h3>

        <div style="margin-bottom: 30px; display: block;">
            <input class="input-text" type="text" placeholder="Masukkan Judul" id="title" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>
        
        <div style="margin-bottom: 30px; display: block;">
            <select class="input-select" id="status" onchange="handleChangeStatus(this)">
                <option value="" hidden>Pilih status</option>
                <option value="in">Pemasukan</option>
                <option value="out">Pengeluaran</option>
            </select>
            <div id="error-status"></div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Nama</th>
                    <th style="width: 25%;">Sub Total</th>
                    <th style="width: 5%;">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
            <tbody id="table-body-total"></tbody>
        </table>
    
        <button class="button-primary-full" type="button" onClick="handleAddColumnTable(this)">Tambah</button>

        <button class="button-success-full" type="button" onClick="handleSave(this)">Simpan</button>

        <a class="button-secondary-full" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';
        let transactionList = [];
        let total = 0;
        let status = "";
        let userId = '{{ Auth::user()->id }}';
        let title = "";
		let numberFormat = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR"});

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/transaction/' + id,
                success: function(result) {
                    if (result.data.status === "in") {
                        $('#title-page').html('<span>Pemasukan</span>');
                    } else {
                        $('#title-page').html("<span>Pengeluaran</span>");
                    }

                    $('#title').val(result.data.title);
                    $('#status').val(result.data.status);

                    total = result.data.total;
                    title = result.data.title;
                    status = result.data.status;

                    result.data.transaction_detail.forEach((value, index) => {
                        transactionList.push({
                            name: value.name,
                            subTotal: value.sub_total
                        });
                    });

                    setTimeout(() => {
                        renderTransactionItem();
                        sumTotal();
                    }, 500);
                }
            });
        }

        function renderTransactionItem() {
            const element = $('#table-body').html("");
            transactionList.forEach((value, index) => {
                element.append(
                    '<tr>'+
                        '<td>'+
                            '<span id="no['+ index +']">'+ (index + 1) +'</span>'+
                        '</td>'+
                        '<td>'+
                            '<div style="display: block;">'+
                                '<input class="input-text" type="text" placeholder="Masukkan nama transaksi" id="name['+ index +']" data-index="'+ index +'" onkeyup="handleChangeName(this)" value="'+ value.name +'">'+
                                '<div id="error-name'+index+'"></div>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="flex-align-center">'+
                                '<div class="bendahara-transaksi__rp">Rp</div>'+
                                '<input class="input-number" type="number" id="subTotal['+ index +']" data-index="'+ index +'" onkeyup="handleChangeSubTotal(this)" value="'+ value.subTotal +'">'+
                            '</div>'+
                            '<div id="error-sub-total'+index+'"></div>'+
                        '</td>'+
                        '<td>'+
                            '<button class="table-button-danger" id="button-delete-table['+ index +']" data-index="'+ index +'"  type="button" onClick="handleDeleteColumnTable(this)">Hapus</button>'+
                        '</td>'+
                    '</tr>'
                );
            });
        }

        function handleAddColumnTable(e) {
            transactionList.push({
                name: "",
                subTotal: 0,
            });

            renderTransactionItem();
        }

        function handleDeleteColumnTable(e) {
            const index = $(e).data('index');

            if (transactionList.length === 1) {
                transactionList = [{
                    name: "",
                    subTotal: 0,
                }];

                renderTransactionItem();

                sumTotal();
            } else {
                transactionList.splice(index, 1);

                renderTransactionItem();

                sumTotal();
            }
        }

        function handleChangeTitle(e) {
            const value = $(e).val();

            title = value;

            $('#error-title').html("");
        }

        function handleChangeStatus(e) {
            const value = $(e).val();

            status = value;

            $('#error-status').html("");

            if (value === "in") {
                $('#title-page').html('<span>Pemasukan</span>');
            } else {
                $('#title-page').html("<span>Pengeluaran</span>");
            }
        }

        function handleChangeName(e) {
            const index = $(e).data('index');
            const value = $(e).val();

            transactionList[index].name = value;

            $('#error-name'+index+'').html("");
        }

        function handleChangeSubTotal(e) {
            const index = $(e).data('index');
            const value = $(e).val();

            transactionList[index].subTotal = parseInt(value);

            sumTotal();

            $('#error-sub-total'+index+'').html("");
        }

        function sumTotal() {
            total = transactionList.reduce(
                (prev, curr) => parseInt(prev) + parseInt(curr.subTotal || 0), 0
            );

            const element = $('#table-body-total');
            element.html("");
            element.append(
                '<tr>'+
                    '<th style="text-align: right;" colSpan="2">Total</th>'+
                    '<td style="padding-left: 20px;">Rp '+ numberFormat.format(total) +'</td>'+
                '</tr>'
            );
        }

        function handleSave() {
            if (title == "") {
                const element = $('#error-title').html("");
                element.append(
                    '<span class="error">Judul transaksi harus diisi</span>'
                );
            }

            transactionList.forEach((value, index) => {
                if (value.name === "") {
                    const element = $('#error-name'+index+'').html("");
                    element.append(
                        '<span class="error">Nama transaksi harus diisi</span>'
                    );
                }

                if (value.subTotal === 0) {
                    const element = $('#error-sub-total'+index+'').html("");
                    element.append(
                        '<span class="error">Sub total transaksi tidak boleh 0</span>'
                    );
                }
            });

            const checkName = transactionList.findIndex((value) => !value.name);
            const checkSubTotal = transactionList.findIndex((value) => value.subTotal === 0);
            if (checkName === -1 && checkSubTotal === -1 && title.length > 0) {
                updateData();
            }
        }

        function updateData() {
            const formData = new FormData();
            formData.append("userId", userId);
            formData.append("title", title);
            formData.append("status", status);
            formData.append("total", total);

            transactionList.forEach((value, index) => {
                formData.append('transactionList['+ index +'][name]', value.name);
                formData.append('transactionList['+ index +'][subTotal]', value.subTotal);
            });

            $.ajax({
                type: 'POST',
                url: '/api/transaction/update/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/bendahara/detail/" + id;
                }
            })
        }
    </script>
@endsection