@php
//Theme::add($comp_ns.'/js/dropzone/dropzone.js'); //messo con npm
//Theme::add($comp_ns.'/js/vendor/dropzone.css');
//Theme::add($comp_ns.'/js/forms-dropzone.js');
Theme::add($comp_ns . '/js/test.js');
@endphp




<div class="form-group">
    <form id="my-awesome-dropzone" action="/upload" class="dropzone">
        <div class="dz-message text-muted">
            <p>Drop files here or click to upload.</p>
            <p><span class="note">(This is just a demo dropzone. Selected files are <STRONG>not</STRONG>
                    actually uploaded.)</span></p>
        </div>
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>
</div>


<div id="dropzoneTemplate" class="d-none">
    <div class="dz-preview dz-file-preview">
        <div class="dz-image"><img data-dz-thumbnail="" alt="" src="{{ asset('img/logo-square.svg') }}"></div>
        <div class="dz-details">
            <div class="dz-filename"><span data-dz-name=""></span></div>
            <div data-dz-size="" class="dz-size"></div>
        </div>
        <div class="dz-progress"><span data-dz-uploadprogress="" class="dz-upload"></span></div>
        <div class="dz-success-mark"><span class="dz-icon"><i class="fa-check fa"></i></span></div>
        <div class="dz-error-mark"><span class="dz-icon"><i class="fa-times fa"></i></span></div>
        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
    </div>
</div>
