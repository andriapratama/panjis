@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
    <div class="bendahara-transaksi__container">
        <h3>Pemasukan</h3>

        <div id="table-transaksi"></div>
    
        <div class="bendahara-transaksi__button">
            <button class="bendahara-transaksi__button-primary" type="button" onClick="handleAddColumnTable(this)">Tambah</button>
        </div>

        <div class="bendahara-transaksi__button">
            <button class="bendahara-transaksi__button-success" type="button" onClick="handleSave(this)">Simpan</button>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let transactionList = [];
        let status = '{{$status}}';
        let total = 0;
        let userId = '{{ Auth::user()->id }}';
        let token = null;

        console.log(name);

        $("document").ready(function() {
            renderTableTransaction();
            addTransactionItem();
            renderTransactionItem();
        });

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
                            '<input class="bendahara-transaksi__input-text" type="text" placeholder="Masukkan nama transaksi" id="name['+ index +']" data-index="'+ index +'" onkeyup="handleChangeName(this)" value="'+ value.name +'">'+
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

        function handleChangeName(e) {
            const index = $(e).data('index');
            const value = $(e).val();

            transactionList[index].name = value;
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
                    '<td style="padding-left: 20px;">Rp '+ total +'</td>'+
                '</tr>'
            );
        }

        function handleSave() {
            const formData = new FormData();
            formData.append("userId", userId);
            formData.append("status", status);
            formData.append("total", total);

            transactionList.forEach((value, index) => {
                formData.append('transactionList['+ index +'][name]', value.name);
                formData.append('transactionList['+ index +'][subTotal]', value.subTotal);
            });

            $.ajax({
                type: 'POST',
                url: '/api/transaction',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
