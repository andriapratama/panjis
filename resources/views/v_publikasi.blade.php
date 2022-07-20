@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
	<div class="publikasi__container">
		<div class="publikasi__head">
			<a class="publikasi__button-primary" href="/publikasi/new">Tambah Gambar</a>
		</div>

		<div class="publikasi__body"></div>
	</div>

	@include('js/javascript')
	<script type="text/javascript">

		$("document").ready(function() {
			showData();
		});

		function showData() {
			$.ajax({
				type: "GET",
				url: "/gallery",
				success: function(result) {
					const element = $('.publikasi__body');
					element.html();
					result.data.forEach((value, index) => {
						element.append(
							'<div class="publikasi__card">'+
								'<div class="publikasi__image-container">'+
									'<img class="publikasi__image" src="/storage/'+ value.image +'" alt="gallery" onclick="handleClick('+ value.id +')">'+
								'</div>'+
	
								'<div class="publikasi__card-body">'+
									'<h3 style="cursor: pointer;" onclick="handleClick('+ value.id +')">'+ value.title +'</h3>'+
									'<p class="publikasi__card-desc" onclick="handleClick('+ value.id +')">'+ value.desc +'</p>'+
								'</div>'+
							'</div>'
						);
					});
				}
			});
		}

		function handleClick(id) {
			window.location.href = "/publikasi/detail/" + id;
		}
	</script>
@endsection