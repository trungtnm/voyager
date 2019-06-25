@php
    $on = $off = '';
    if($options && property_exists($options, 'on') && property_exists($options, 'off')) {
        $on = $options->on;
        $off = $options->off;
    }
@endphp

@php
    $labelClass = $data->{$row->field} ? 'label-success' : 'label-default';
    $labelIconClass = $data->{$row->field} ? 'voyager-check' : 'voyager-x';
    $text = $data->{$row->field} ? $on : $off;
@endphp

<a href="javascript:;" data-url="{{ route("voyager.{$dataType->slug}.toggle_boolean") }}"
   data-field="{{ $row->field }}"
   data-id="{{ $data->getKey() }}"
   data-on-class="label-success"
   data-off-class="label-default"
   class="toggle-boolean h5 label {{ $labelClass }}">
    <i data-on-class="voyager-check" data-off-class="voyager-x" class="{{ $labelIconClass }}"></i> {{ $text }}
</a>
