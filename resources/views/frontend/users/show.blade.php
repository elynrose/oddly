@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.verified') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.free_post_used') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->free_post_used ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.paid_for_first_bid') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->paid_for_first_bid ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.has_first_review') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->has_first_review ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.two_factor') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.country') }}
                                    </th>
                                    <td>
                                        {{ App\Models\User::COUNTRY_SELECT[$user->country] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.state') }}
                                    </th>
                                    <td>
                                        {{ App\Models\User::STATE_SELECT[$user->state] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $user->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.street') }}
                                    </th>
                                    <td>
                                        {{ $user->street }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.zipcode') }}
                                    </th>
                                    <td>
                                        {{ $user->zipcode }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection