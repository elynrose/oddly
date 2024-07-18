@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.users.update", [$user->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="free_post_used" value="0">
                                <input type="checkbox" name="free_post_used" id="free_post_used" value="1" {{ $user->free_post_used || old('free_post_used', 0) === 1 ? 'checked' : '' }}>
                                <label for="free_post_used">{{ trans('cruds.user.fields.free_post_used') }}</label>
                            </div>
                            @if($errors->has('free_post_used'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('free_post_used') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.free_post_used_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="paid_for_first_bid" value="0">
                                <input type="checkbox" name="paid_for_first_bid" id="paid_for_first_bid" value="1" {{ $user->paid_for_first_bid || old('paid_for_first_bid', 0) === 1 ? 'checked' : '' }}>
                                <label for="paid_for_first_bid">{{ trans('cruds.user.fields.paid_for_first_bid') }}</label>
                            </div>
                            @if($errors->has('paid_for_first_bid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid_for_first_bid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.paid_for_first_bid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="has_first_review" value="0">
                                <input type="checkbox" name="has_first_review" id="has_first_review" value="1" {{ $user->has_first_review || old('has_first_review', 0) === 1 ? 'checked' : '' }}>
                                <label for="has_first_review">{{ trans('cruds.user.fields.has_first_review') }}</label>
                            </div>
                            @if($errors->has('has_first_review'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('has_first_review') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.has_first_review_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.user.fields.country') }}</label>
                            <select class="form-control" name="country" id="country">
                                <option value disabled {{ old('country', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\User::COUNTRY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('country', $user->country) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.user.fields.state') }}</label>
                            <select class="form-control" name="state" id="state">
                                <option value disabled {{ old('state', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\User::STATE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('state', $user->state) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city">{{ trans('cruds.user.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', $user->city) }}">
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="street">{{ trans('cruds.user.fields.street') }}</label>
                            <input class="form-control" type="text" name="street" id="street" value="{{ old('street', $user->street) }}">
                            @if($errors->has('street'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('street') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.street_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="zipcode">{{ trans('cruds.user.fields.zipcode') }}</label>
                            <input class="form-control" type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', $user->zipcode) }}">
                            @if($errors->has('zipcode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('zipcode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.zipcode_helper') }}</span>
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