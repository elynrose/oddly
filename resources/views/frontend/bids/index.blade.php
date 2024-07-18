@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bid_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bids.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bid.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bid.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bid">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.job') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.job_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.deadline') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.job.fields.published') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.bid_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.points_required') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.featured') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.highlighted') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.free') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bid.fields.selected') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bids as $key => $bid)
                                    <tr data-entry-id="{{ $bid->id }}">
                                        <td>
                                            {{ $bid->job->job_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bid->job->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bid->job->job_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bid->job->deadline ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bid->job->published ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bid->job->published ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $bid->bid_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bid->points_required ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bid->featured ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bid->featured ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bid->highlighted ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bid->highlighted ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bid->free ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bid->free ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $bid->user->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bid->selected ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bid->selected ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('bid_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bids.show', $bid->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bid_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bids.edit', $bid->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bid_delete')
                                                <form action="{{ route('frontend.bids.destroy', $bid->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bid_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bids.massDestroy') }}",
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
  let table = $('.datatable-Bid:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection