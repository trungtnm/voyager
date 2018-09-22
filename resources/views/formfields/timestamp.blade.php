@php
    if (isset($dataTypeContent->{$row->field})) {
        $value = \Carbon\Carbon::parse(old($row->field, $dataTypeContent->{$row->field}))->format('m/d/Y g:i A');
    } else {
        $value = old($row->field);
    }
@endphp
<div class="form-group">
    <div class="input-group datepicker">
        <input @if($row->required == 1) required @endif type="datetime" class="form-control"
               name="{{ $row->field }}"
               value="{{ $value }}">
        <span class="input-group-addon">
            <span class="icon voyager-calendar"></span>
        </span>
    </div>
</div>
