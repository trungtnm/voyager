<div class="table-responsive">
    <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
            @can('delete',app($dataType->model_name))
                <th>
                    <input type="checkbox" class="select_all">
                </th>
            @endcan
            @foreach($dataType->browseRows as $row)
                <th>
                    @if ($isServerSide)
                    <a href="{{ $row->sortByUrl() }}">
                        {{ $row->display_name }}
                        @if ($row->isCurrentSortField())
                            @if (!isset($_GET['sort_order']) || $_GET['sort_order'] == 'asc')
                                <i class="voyager-angle-up pull-right"></i>
                            @else
                                <i class="voyager-angle-down pull-right"></i>
                            @endif
                        @endif
                    </a>
                    @else
                        {{ $row->display_name }}
                    @endif
                </th>
            @endforeach
            <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dataTypeContent as $data)
            <tr>
                @can('delete',app($dataType->model_name))
                    <td>
                        <input type="checkbox" name="row_id" id="checkbox_{{ $data->getKey() }}" value="{{ $data->getKey() }}">
                    </td>
                @endcan
                @foreach($dataType->browseRows as $row)
                    <td>
                        {!! \Voyager::displayField($dataType, $row, $data) !!}
                    </td>
                @endforeach
                <td class="no-sort no-click" id="bread-actions">
                    @foreach(Voyager::actions() as $action)
                        @include('voyager::bread.partials.actions', ['action' => $action])
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@if ($isServerSide)
    <div class="pull-left">
        <div role="status" class="show-res" aria-live="polite">
            {{ trans_choice(
                'voyager::generic.showing_entries', $dataTypeContent->total(), [
                    'from' => $dataTypeContent->firstItem(),
                    'to' => $dataTypeContent->lastItem(),
                    'all' => $dataTypeContent->total()
                ])
            }}
        </div>
    </div>
    <div class="pull-right">
        {{ $dataTypeContent->appends([
            's' => $search->value,
            'filter' => $search->filter,
            'key' => $search->key,
            'order_by' => $orderBy,
            'sort_order' => $sortOrder
        ])->links() }}
    </div>
@endif
