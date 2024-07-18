@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.budget.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.budgets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.budget.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.budget.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ordering">{{ trans('cruds.budget.fields.ordering') }}</label>
                <input class="form-control {{ $errors->has('ordering') ? 'is-invalid' : '' }}" type="number" name="ordering" id="ordering" value="{{ old('ordering', '') }}" step="1">
                @if($errors->has('ordering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ordering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.budget.fields.ordering_helper') }}</span>
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