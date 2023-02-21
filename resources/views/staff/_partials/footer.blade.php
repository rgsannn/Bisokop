
        </div>
	</div>
	<!-- END: Content-->

	<div class="mb-3 d-md-none">
		<div class="sidenav-overlay"></div>
		<div class="drag-target"></div>
	</div>

	<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
	<!-- END: Footer-->

	<!-- BEGIN: Vendor JS-->
	<script src="{{ url('assets/staff') }}/vendors/js/vendors.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
	<!-- BEGIN Vendor JS-->

	<!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('assets/staff') }}/vendors/js/charts/apexcharts.min.js"></script>
	<script src="{{ url('assets/staff') }}/vendors/js/extensions/swiper.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ url('assets/staff') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
	<script src="{{ url('assets/staff') }}/js/main.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- BEGIN: Theme JS-->
	<script src="{{ url('assets/staff') }}/js/core/app-menu.min.js"></script>
	<script src="{{ url('assets/staff') }}/js/core/app.min.js"></script>
	<!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	<script src="{{ url('assets/staff') }}/js/scripts/extensions/ext-component-swiper.min.js"></script>
	<script src="{{ url('assets/staff') }}/js/scripts/forms/form-wizard.min.js"></script>
	<script src="{{ url('assets/staff') }}/js/scripts/forms/form-select2.min.js"></script>
    <script src="{{ url('assets/staff') }}/js/scripts/forms/pickers/form-pickers.min.js"></script>
	<!-- END: Page JS-->

	@if(session('alertSuccess'))
        <script>Swal.fire('Success!', `{{ session('alertSuccess') }}`, 'success');</script>
    
    @elseif(session('alertError'))
		<script>Swal.fire('Error', `{{ session('alertError') }}`, 'error');</script>
    @endif

	<script>
		function deleteSwal(url) {
			Swal.fire({
				title: "Are you sure?",
				text: "Deleted data cannot be recovered!",
				icon: "warning",
				showCancelButton: !0,
				confirmButtonText: "Yes, Delete!",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-outline-danger ms-1"
				},
				buttonsStyling: !1

			}).then( function(result) {
				if(result.isConfirmed) {
					location.href = url;
				}
			});
		}

		function err(text) {
			return `<div class="modal-content"><div class="modal-body">${text}</div></div>`;
		}
		
		function getModal(link) {
			$.ajax({
				type: "GET",
				url: link,
				dataType: "html",
				beforeSend: function () {
					$("#myModal-content").html(
						err('Loading....')
					);
				},
				success: function (result) {
					setTimeout(function () {
						$("#myModal-content").html(result);
					}, 1000);
				},
				error: function () {
					$("#myModal-content").html(
						err('Failed to get contents....')
					);
				},
			});
			$("#myModal").modal("show");
		}
	</script>

	<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" id="myModal-content">
			</div>
		</div>
	</div>
</body>

</html>