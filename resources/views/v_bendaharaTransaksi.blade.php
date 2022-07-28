@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
    <div class="bendahara-transaksi__container">
        <h3 id="title" style="margin-bottom: 20px;"></h3>

        <div style="margin-bottom: 30px; display: block;">
            <input class="bendahara-transaksi__input-text" type="text" placeholder="Masukkan Judul" id="title" onkeyup="handleChangeTitle(this)">
            <div id="error-title"></div>
        </div>
        
        <div id="table-transaksi"></div>
    
        <button class="bendahara-transaksi__button-primary" type="button" onClick="handleAddColumnTable(this)">Tambah</button>

        <button class="bendahara-transaksi__button-success" type="button" onClick="handleSave(this)">Simpan</button>

        <a class="bendahara-transaksi__button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let transactionList = [];
        let status = '{{$status}}';
        let total = 0;
        let userId = '{{ Auth::user()->id }}';
        let token = null;
        let title = "";
		let numberFormat = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR"});

        $("document").ready(function() {
            renderTableTransaction();
            addTransactionItem();
            renderTransactionItem();
            showTitle();
            sumTotal();
        });

        function showTitle() {
            if (status === "in") {
                $('#title').html('<span>Pemasukan</span>');
            } else {
                $('#title').html("<span>Pengeluaran</span>");
            }
        }

        function renderTableTransaction() {
            const element = $('#table-transaksi');
            element.html("");
            element.append(
                '<table class="table">'+
                    '<thead>'+
                        '<tr>'+
                            '<th style="width: 5%;">No</th>'+
                            '<th>Nama</th>'+
                            '<th style="width: 25%;">Sub Total</th>'+
                            '<th style="width: 5%;">Aksi</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody id="table-body"></tbody>'+
                    '<tbody id="table-body-total"></tbody>'+
                '</table>'
            );
        }

        function addTransactionItem() {
            transactionList.push({
                name: "",
                subTotal: 0,
            })
        }

        function renderTransactionItem() {
            const element = $('#table-body');
            element.html("");
            transactionList.forEach((value, index) => {
                element.append(
                    '<tr>'+
                        '<td>'+
                            '<span id="no['+ index +']">'+ (index + 1) +'</span>'+
                        '</td>'+
                        '<td>'+
                            '<div style="display: block;">'+
                                '<input class="bendahara-transaksi__input-text" type="text" placeholder="Masukkan nama transaksi" id="name['+ index +']" data-index="'+ index +'" onkeyup="handleChangeName(this)" value="'+ value.name +'">'+
                                '<div id="error-name'+index+'"></div>'+
                            '</div>'+
                        '</td>'+
                        '<td class="flex-align-center">'+
                            '<div class="bendahara-transaksi__rp">Rp</div>'+
                            '<input class="bendahara-transaksi__input-number" type="number" id="subTotal['+ index +']" data-index="'+ index +'" onkeyup="handleChangeSubTotal(this)" value="'+ value.subTotal +'">'+
                        '</td>'+
                        '<td>'+
                            '<button class="bendahara-transaksi__button-table-danger" id="button-delete-table['+ index +']" data-index="'+ index +'"  type="button" onClick="handleDeleteColumnTable(this)">Hapus</button>'+
                        '</td>'+
                    '</tr>'
                )
            })
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
                const element = $('#error-title');
                element.html("");
                element.append(
                    '<span style="color: red; font-size: 15px;">Judul transaksi harus diisi</span>'
                )
            }

            transactionList.forEach((value, index) => {
                if (value.name === "") {
                    const element = $('#error-name'+index+'');
                    element.html("");
                    element.append(
                        '<span style="color: red; font-size: 15px;">Nama transaksi harus diisi</span>'
                    )
                }
            })

            const check = transactionList.findIndex((value) => !value.name);

            if (check === -1 && title.length > 0) {
                storeData();
            }
        }

        function storeData() {
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
                url: '/api/transaction',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/bendahara";
                }
            })
        }
    </script>
@endsection
