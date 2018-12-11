@php
    $options = json_decode($row->details);
    $display_options = isset($options->display) ? $options->display : NULL;
@endphp
@if ($options && isset($options->legend) && isset($options->legend->text))
<legend class="text-{{isset($options->legend->align) ? $options->legend->align : 'center'}}" style="background-color: {{isset($options->legend->bgcolor) ? $options->legend->bgcolor : '#f0f0f0'}};padding: 5px;">{{$options->legend->text}}</legend>
@endif
@if ($options && isset($options->formfields_custom))
    @include('voyager::formfields.custom.' . $options->formfields_custom)
@else
    <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
        {{ $row->slugify }}
        @if($withLabel)
        @include('voyager::bread.partials.formLabel')
        @endif
        @include('voyager::multilingual.input-hidden-bread-edit-add')
        @if($row->type == 'relationship')
            @include('voyager::formfields.relationship')
        @else
            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
        @endif

        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
        @endforeach
    </div>
@endif
