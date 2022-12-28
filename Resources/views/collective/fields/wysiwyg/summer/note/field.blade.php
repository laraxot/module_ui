@php
//non funziona, da aggiustare
Theme::add('theme::plugins/summernote/summernote-bs4.css');
Theme::add('theme::plugins/summernote/summernote-bs4.min.js');
@endphp

{{-- <div id=summernote>
	<div class="form-group row ">
		<label for="bio" class="col-3 control-label text-right">Short Biography</label>
		<div class="col-9">
			<textarea class="form-control" placeholder="Short Biography here" name="bio" cols="50" rows="10" id="bio">Faucibus ornare suspendisse sed nisi lacus sed. Pellentesque sit amet porttitor eget dolor morbi non arcu. Eu scelerisque felis imperdiet proin fermentum leo vel orci porta</textarea>
			<div class="form-text text-muted">Insert Biography</div>
		</div>
	</div>
	<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
	</div>
</div> --}}
aaaaaaaaaaaaaaaaaaaaaa
<textarea id="summernote" name="editordata"></textarea>
bbbbbbbbbbbbbbbbb

@push('scripts')


    <script>
        (function($) {
            $.noConflict();
            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }(jQuery));
    </script>
@endpush
