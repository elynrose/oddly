@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.job.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.jobs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.job.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.job.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description') !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="attachments">{{ trans('cruds.job.fields.attachments') }}</label>
                            <div class="needsclick dropzone" id="attachments-dropzone">
                            </div>
                            @if($errors->has('attachments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('attachments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.attachments_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="budget_id">{{ trans('cruds.job.fields.budget') }}</label>
                            <select class="form-control select2" name="budget_id" id="budget_id" required>
                                @foreach($budgets as $id => $entry)
                                    <option value="{{ $id }}" {{ old('budget_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('budget'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('budget') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.budget_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.job.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="deadline">{{ trans('cruds.job.fields.deadline') }}</label>
                            <input class="form-control datetime" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}" required>
                            @if($errors->has('deadline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deadline') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.deadline_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_files">{{ trans('cruds.job.fields.completed_files') }}</label>
                            <div class="needsclick dropzone" id="completed_files-dropzone">
                            </div>
                            @if($errors->has('completed_files'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_files') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.completed_files_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_link">{{ trans('cruds.job.fields.completed_link') }}</label>
                            <input class="form-control" type="text" name="completed_link" id="completed_link" value="{{ old('completed_link', '') }}">
                            @if($errors->has('completed_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.completed_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 ? 'checked' : '' }}>
                                <label for="published">{{ trans('cruds.job.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('published') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="job_code">{{ trans('cruds.job.fields.job_code') }}</label>
                            <input class="form-control" type="text" name="job_code" id="job_code" value="{{ old('job_code', '') }}" required>
                            @if($errors->has('job_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.job_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.job.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.job.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('frontend.jobs.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $job->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedAttachmentsMap = {}
Dropzone.options.attachmentsDropzone = {
    url: '{{ route('frontend.jobs.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
      uploadedAttachmentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentsMap[file.name]
      }
      $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($job) && $job->attachments)
          var files =
            {!! json_encode($job->attachments) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedCompletedFilesMap = {}
Dropzone.options.completedFilesDropzone = {
    url: '{{ route('frontend.jobs.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="completed_files[]" value="' + response.name + '">')
      uploadedCompletedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCompletedFilesMap[file.name]
      }
      $('form').find('input[name="completed_files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($job) && $job->completed_files)
          var files =
            {!! json_encode($job->completed_files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="completed_files[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection