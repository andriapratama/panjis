@extends('layout.v_template')
@section('title', 'Peminjaman')

@section('content')
    <div class="peminjaman-new__container">
        <div style="margin-bottom: 20px; display: block;">
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan nama peminjam" id="name" onkeyup="handleChangeName(this)">
            <div id="error-name"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan alamat peminjam" id="address" onkeyup="handleChangeAddress(this)">
            <div id="error-address"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan tanggal mulai" id="address" onkeyup="handleChangeAddress(this)">
            <div id="error-address"></div>
        </div>

        <div style="margin-bottom: 20px; display: block;">
            <input class="peminjaman-new__input-text" type="text" placeholder="Masukkan tanggal akhir" id="address" onkeyup="handleChangeAddress(this)">
            <div id="error-address"></div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        <select name="" id="select-product"></select>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
@endsection