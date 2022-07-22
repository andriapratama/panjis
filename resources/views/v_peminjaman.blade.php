@extends('layout.v_template')
@section('title', 'Peminjaman')

@section('content')
    <div class="peminjaman__container">
        <div class="peminjaman__head">
            <a class="peminjaman__button-primary" href="/peminjaman/new">Tambah</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Wowok</td>
                    <td>28-07-2022</td>
                    <td>30-07-2022</td>
                    <td>
                        <a class="peminjaman__table-button-secondary" href="">Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection