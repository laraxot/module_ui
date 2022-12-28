@php
    //non funziona, da aggiustare


    Theme::add('theme::plugins/dropzone/bootstrap.min.css');
    Theme::add('theme::plugins/dropzone/dropzone.js');
@endphp

<div class="form-group row">
    {!! Form::label('avatar', trans("lang.user_avatar"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        <div style="width: 100%" class="dropzone avatar" id="avatar" data-field="avatar">
            <input type="hidden" name="avatar">
        </div>
        <a href="#loadMediaModal" data-dropzone="avatar" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{-- setting('theme_color','primary') --}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
        <div class="form-text text-muted w-50">
            {{ trans("lang.user_avatar_help") }}
        </div>
    </div>
</div>

@push('scripts')
 <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush

@push('scripts')
    <script type="text/javascript">
        var user_avatar = '';
        @if(isset($user) && $user->hasMedia('avatar'))
            user_avatar = {
            name: "{!! $user->getFirstMedia('avatar')->name !!}",
            size: "{!! $user->getFirstMedia('avatar')->size !!}",
            type: "{!! $user->getFirstMedia('avatar')->mime_type !!}",
            collection_name: "{!! $user->getFirstMedia('avatar')->collection_name !!}"
        };
                @endif
        var dz_user_avatar = $(".dropzone.avatar").dropzone({
                url: "{!!url('uploads/store')!!}",
                addRemoveLinks: true,
                maxFiles: 1,
                init: function () {
                    @if(isset($user) && $user->hasMedia('avatar'))
                    dzInit(this, user_avatar, '{!! url($user->getFirstMediaUrl('avatar','thumb')) !!}')
                    @endif
                },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                },
                sending: function (file, xhr, formData) {
                    dzSending(this, file, formData, '{!! csrf_token() !!}');
                },
                maxfilesexceeded: function (file) {
                    dz_user_avatar[0].mockFile = '';
                    dzMaxfile(this, file);
                },
                complete: function (file) {
                    dzComplete(this, file, user_avatar, dz_user_avatar[0].mockFile);
                    dz_user_avatar[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFile(
                        file, user_avatar, '{!! url("settings/users/remove-media") !!}',
                        'avatar', '{!! isset($user) ? $user->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                    );
                }
            });
        dz_user_avatar[0].mockFile = user_avatar;
        dropzoneFields['avatar'] = dz_user_avatar;
    </script>
@endpush