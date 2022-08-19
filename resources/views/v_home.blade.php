@extends('layout.v_template')
@section('title', 'Home')

@section('content')
	<div class="home__container">
		<div class="home__body">
			<div class="home__body-content">
				<div class="home__card">
					<div class="home__card-left">
						<h4 class="home__title">Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
				<div class="home__card">
					<div class="home__card-left">
						<h4>Jumlah User</h4>
						<h2 style="margin-bottom: 0;">12</h2>
					</div>
					<i class="nav-icon fas fa-user"></i>
				</div>
			</div>
		</div>
	</div>

	@include('js/javascript')
	<script type="text/javascript">
		$("document").ready(function() {
			showAnnoun();
		});

		function showAnnoun() {
			$.ajax({
				type: 'GET',
				url: '/announ/date',
				success: function(result) {
				}
			});
		}
	</script>
@endsection