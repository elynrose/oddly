@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.job.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.id') }}
                        </th>
                        <td>
                            {{ $job->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.title') }}
                        </th>
                        <td>
                            {{ $job->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.category') }}
                        </th>
                        <td>
                            {{ $job->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.description') }}
                        </th>
                        <td>
                            {!! $job->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.attachments') }}
                        </th>
                        <td>
                            @foreach($job->attachments as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.budget') }}
                        </th>
                        <td>
                            {{ $job->budget->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.status') }}
                        </th>
                        <td>
                            {{ $job->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.deadline') }}
                        </th>
                        <td>
                            {{ $job->deadline }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.completed_files') }}
                        </th>
                        <td>
                            @foreach($job->completed_files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.completed_link') }}
                        </th>
                        <td>
                            {{ $job->completed_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $job->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.job_code') }}
                        </th>
                        <td>
                            {{ $job->job_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.user') }}
                        </th>
                        <td>
                            {{ $job->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection