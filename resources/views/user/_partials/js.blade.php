
	</div>
    <script>
	    let baseUrl = `{{ url('') }}/`;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('user/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/script.js?='.time()) }}"></script>

    @if(session('alertSuccess'))
        <script>
            setTimeout( function() {
                Swal.fire('Success!', `{{ session('alertSuccess') }}`, 'success');
            }, 1750);
        </script>
    
    @elseif(session('alertError'))
        <script>
            setTimeout( function() {
                Swal.fire('Error', `{{ session('alertError') }}`, 'error');
            }, 1750);
        </script>
    @endif

    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" id="myModal-content">
				
			</div>
		</div>
	</div>

	<div class="offcanvas offcanvas-end" id="myCanvas" tabindex="-1" id="offcanvasRight" data-bs-scroll="true" data-bs-backdrop="static" aria-labelledby="offcanvasRightLabel">
    </div>

</body>

</html>