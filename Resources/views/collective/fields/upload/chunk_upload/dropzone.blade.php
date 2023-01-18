@php
	Theme::add('/theme/bc/dropzone/dist/dropzone.js');
	Theme::add('/theme/bc/dropzone/dist/dropzone.css');
	Theme::add('backend::includes/components/form/chunk_upload/js/dropzone.js');
@endphp

@push('scripts')
	<script>
		Dropzone.autoDiscover = false;
	</script>
@endpush
	<div class="text-center">

		<form action="{{ url('admin/backend/upload') }}"
			  class="dropzone"
			  id="my-awesome-dropzone">
			<input type="file" name="file" >
		</form>
		<small>Works only in Chrome</small>
		<ul id="file-upload-list" class="list-unstyled">

		</ul>
	</div>
