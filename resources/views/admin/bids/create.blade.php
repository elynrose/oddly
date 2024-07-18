@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bid.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bids.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="job_id">{{ trans('cruds.bid.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id" required>
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bid_amount">{{ trans('cruds.bid.fields.bid_amount') }}</label>
                <input class="form-control {{ $errors->has('bid_amount') ? 'is-invalid' : '' }}" type="number" name="bid_amount" id="bid_amount" value="{{ old('bid_amount', '') }}" step="0.01">
                @if($errors->has('bid_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bid_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.bid_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points_required">{{ trans('cruds.bid.fields.points_required') }}</label>
                <input class="form-control {{ $errors->has('points_required') ? 'is-invalid' : '' }}" type="number" name="points_required" id="points_required" value="{{ old('points_required', '') }}" step="1">
                @if($errors->has('points_required'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points_required') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.points_required_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">{{ trans('cruds.bid.fields.featured') }}</label>
                </div>
                @if($errors->has('featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.featured_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('highlighted') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="highlighted" value="0">
                    <input class="form-check-input" type="checkbox" name="highlighted" id="highlighted" value="1" {{ old('highlighted', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="highlighted">{{ trans('cruds.bid.fields.highlighted') }}</label>
                </div>
                @if($errors->has('highlighted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('highlighted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.highlighted_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('free') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="free" value="0">
                    <input class="form-check-input" type="checkbox" name="free" id="free" value="1" {{ old('free', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="free">{{ trans('cruds.bid.fields.free') }}</label>
                </div>
                @if($errors->has('free'))
                    <div class="invalid-feedback">
                        {{ $errors->first('free') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.free_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.bid.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('selected') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="selected" value="0">
                    <input class="form-check-input" type="checkbox" name="selected" id="selected" value="1" {{ old('selected', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="selected">{{ trans('cruds.bid.fields.selected') }}</label>
                </div>
                @if($errors->has('selected'))
                    <div class="invalid-feedback">
                        {{ $errors->first('selected') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bid.fields.selected_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection