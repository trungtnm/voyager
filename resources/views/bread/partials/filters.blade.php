@if ($isServerSide)
    <form method="get" class="form-search">
        <div id="search-input">
            <select id="search_key" name="key">
                @foreach($searchable as $key)
                    @php
                        $found = false;
                    @endphp
                    @foreach($dataType->browseRows as $row)
                        @if($key == $row->field)
                            <option value="{{ $key }}" @if($search->key == $key){{ 'selected' }}@endif>{{ $row->display_name }}</option>
                            @php
                                $found = true;
                            @endphp
                            @break
                        @endif
                    @endforeach
                    @if(!$found)
                        <option value="{{ $key }}" @if($search->key == $key){{ 'selected' }}@endif>{{ ucwords(str_replace('_', ' ', $key)) }}</option>
                    @endif
                @endforeach
            </select>
            <select id="filter" name="filter">
                <option value="contains" @if($search->filter == "contains"){{ 'selected' }}@endif>contains</option>
                <option value="equals" @if($search->filter == "equals"){{ 'selected' }}@endif>=</option>
            </select>
            <div class="input-group col-md-12">
                <input type="text" class="form-control" placeholder="{{ __('voyager::generic.search') }}" name="s" value="{{ $search->value }}">
                <span class="input-group-btn">
                    <button class="btn btn-info btn-lg" type="submit">
                        <i class="voyager-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </form>
@endif
