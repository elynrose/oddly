@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('job_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.jobs.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.job.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Job">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.job.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.attachments') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.budget') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.deadline') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.published') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.job_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $key => $job)
                                    <tr data-entry-id="{{ $job->id }}">
                                        <td>
                                            {{ $job->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $job->category->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($job->attachments as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $job->budget->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $job->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $job->deadline ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $job->published ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $job->published ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $job->job_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $job->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('job_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.jobs.show', $job->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('job_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.jobs.edit', $job->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('job_delete')
                                                <form action="{{ route('frontend.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('job_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.jobs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Job:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection