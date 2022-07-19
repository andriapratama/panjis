@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
	<div class="bendahara__component">
		<div class="bendahara__button">
			<a href="/bendahara/new/in" class="bendahara__button-primary">Pemasukan</a>
			<a href="/bendahara/new/out" class="bendahara__button-primary">Pengeluaran</a>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>17-07-2022</td>
					<td>Pemasukan</td>
					<td>Rp 250.000</td>
					<td>
						<button class="bendahara__button-table-secondary">Detail</button>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>17-07-2022</td>
					<td>Pengeluaran</td>
					<td>Rp 250.000</td>
					<td>
						<button class="bendahara__button-table-secondary">Detail</button>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>17-07-2022</td>
					<td>Pengeluaran</td>
					<td>Rp 250.000</td>
					<td>
						<button class="bendahara__button-table-secondary">Detail</button>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>17-07-2022</td>
					<td>Pemasukan</td>
					<td>Rp 250.000</td>
					<td>
						<button class="bendahara__button-table-secondary">Detail</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection