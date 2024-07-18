@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bid.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.job') }}
                        </th>
                        <td>
                            {{ $bid->job->job_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.bid_amount') }}
                        </th>
                        <td>
                            {{ $bid->bid_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.points_required') }}
                        </th>
                        <td>
                            {{ $bid->points_required }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bid->featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.highlighted') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bid->highlighted ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.free') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bid->free ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.user') }}
                        </th>
                        <td>
                            {{ $bid->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bid.fields.selected') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bid->selected ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection