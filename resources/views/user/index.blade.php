@include('user._partials.header')

<div class="content-box bg-white">
	<div class="content-page mx-0 px-0">
		<div class="content">
			<section>
				<div class="owl-carousel item-carousel list-banner">
					<div class="items">
						<img src="{{ asset('user/img/banner/26f19ccf-1739-431c-980f-c594020ef050.jpeg') }}" alt="" width="100%">
					</div>
					<div class="items">
						<img src="{{ asset('user/img/banner/f5a0343d-ab9d-4de1-a5b8-4f1eb05749ad.jpeg') }}" alt="" width="100%">
					</div>
				</div>
			</section>

			<section class="pt-5 pb-5">
				<div class="row justify-content-center px-4 mt-4">
					<div class="col-md-10">
						<h5 class="mb-0" style="font-weight: var(--font-extra-bold);">NOW SHOWING IN CINEMAS</h5>
						<div class="strip-primary"></div>

						<div class="owl-carousel item-carousel owl-theme list-film mt-4">
							@foreach($allFilm as $film)
								<a class="items" href="{{ url('film/' . $film->film_id) }}">
									<img src="{{ asset('user/img/film/' . $film->thumbnail) }}" alt="" class="image-film" width="100%">
									<h6 class="mt-3">{{ $film->title }}</h6>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</section>
		</div>

        @include('user._partials.footer')
	</div>
</div>

@include('user._partials.js')

<script>
	$(document).ready(function() {
		$(".list-banner").owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			autoplayTimeout: 3000,
		})
		$('.list-film').owlCarousel({
			margin: 16,
			loop: true,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 3000,
			autoplayHoverPause: true,
			navText: [
				'<ion-icon name="arrow-back-circle-outline" style="font-size: 3rem"></ion-icon>',
				'<ion-icon name="arrow-forward-circle-outline" style="font-size: 3rem"></ion-icon>'
			],
			responsive: {
				0: {
					items: 2
				},
				580: {
					items: 3
				},
				1000: {
					items: 4
				},
			}
		})
	})
</script>