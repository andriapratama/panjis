@extends('layout.v_template')
@section('title', 'Home')

@section('content')
	<div class="home__container">
		<div class="home__body">
			<div class="home__body-content">
				<div class="home__card">
					<div class="home__card-left">
						<h4 class="home__title">Jumlah Transaksi</h4>
						<h2 style="margin-bottom: 0;" id="transaction"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;" id="user"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah Publikasi</h4>
						<h2 style="margin-bottom: 0;" id="gallery"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah LPJ</h4>
						<h2 style="margin-bottom: 0;" id="report"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah Notulen</h4>
						<h2 style="margin-bottom: 0;" id="note"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah Member</h4>
						<h2 style="margin-bottom: 0;" id="member"></h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
			</div>
		</div>
	</div>

	@include('js/javascript')
	<script type="text/javascript">
		$("document").ready(function() {
			showData();
		});

		function showData() {
			$.ajax({
				type: 'GET',
				url: '/home/data',
				success: function(result) {
					$('#transaction').html("").append(result.transaction);
					$('#user').html("").append(result.user);
					$('#gallery').html("").append(result.gallery);
					$('#report').html("").append(result.report);
					$('#note').html("").append(result.note);
					$('#member').html("").append(result.member);
				}
			});
		}
	</script>
@endsection