@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.review.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.reviews.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="job_id">{{ trans('cruds.review.fields.job') }}</label>
                            <select class="form-control select2" name="job_id" id="job_id" required>
                                @foreach($jobs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.job_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.review.fields.user') }}</label>
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
                            <span class="help-block">{{ trans('cruds.review.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.review.fields.rating') }}</label>
                            @foreach(App\Models\Review::RATING_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="rating_{{ $key }}" name="rating" value="{{ $key }}" {{ old('rating', '0') === (string) $key ? 'checked' : '' }} required>
                                    <label for="rating_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('rating'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rating') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.rating_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.review.fields.comment') }}</label>
                            <textarea class="form-control ckeditor" name="comment" id="comment">{!! old('comment') !!}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.review.fields.category') }}</label>
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
                            <span class="help-block">{{ trans('cruds.review.fields.category_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.reviews.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $review->id ?? 0 }}');
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

@endsection