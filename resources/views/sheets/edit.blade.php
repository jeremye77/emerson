@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Entry
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('errors.errors')
                    <form class="form-horizontal" method="post">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Edit Title</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sheet_name">Title</label>
                                <div class="col-md-5">
                                    <input value="{{ $sheet->sheet_name }}" id="sheet_name" name="sheet_name"
                                           type="text" placeholder="" class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sheet_alternative_title">Alternative
                                    Title</label>
                                <div class="col-md-5">
                                    <input value="{{ $sheet->sheet_alternative_name }}" id="sheet_alternative_title"
                                           name="sheet_alternative_title" type="text" placeholder="Optional"
                                           class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="composer_id">Composer</label>
                                <div class="col-md-5">
                                    <input value="{{$sheet['composer']['composer'] }}" id="composer_id"
                                           name="composer_id" type="search" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="arranger_id">Arranger</label>
                                <div class="col-md-5">
                                    <input value="{{$sheet['carranger']['arranger'] }}" id="arranger_id"
                                           name="arranger_id" type="search" placeholder="Optional"
                                           class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="accompaniment_id">Accompaniment</label>
                                <div class="col-md-4">
                                    <input value="{{$sheet['accompaniment']['accompaniment'] }}" id="accompaniment_id"
                                           name="accompaniment_id" type="search" placeholder="Piano"
                                           class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="voicing_id">Voicing</label>
                                <div class="col-md-2">
                                    <input value="{{$sheet['voicing']['voicing'] }}" id="voicing_id" name="voicing_id"
                                           type="search" placeholder="SATB" class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="publisher_number">Publisher's Number</label>
                                <div class="col-md-5">
                                    <input value="{{$sheet->publisher_number }}" id="publisher_number"
                                           name="publisher_number" type="text" placeholder="SING123456"
                                           class="form-control input-md">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="publisher_id">Publisher</label>
                                <div class="col-md-5">
                                    <input value="{{$sheet['publisher']['publisher'] }}" id="publisher_id"
                                           name="publisher_id" type="text" placeholder="" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="copyright_year">Copyright</label>
                                <div class="col-md-2">
                                    <input value="{{$sheet->copyright_year }}" id="copyright_year" name="copyright_year"
                                           type="text" placeholder="2016" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="quantity">Quantity</label>
                                <div class="col-md-2">
                                    <input value="{{$sheet->quantity }}" id="quantity" name="quantity" type="text"
                                           placeholder="0" class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="legal_table_id">Legal Copy?</label>
                                <div class="col-md-4">
                                    <select id="legal_table_id" name="legal_table_id" class="form-control">
                                        <option value="1"
                                                @if ($sheet['legal_table']['legal'] === "Yes")selected="selected"@endif>
                                            Yes
                                        </option>
                                        <option value="2"
                                                @if ($sheet['legal_table']['legal'] ==="NO")selected="selected"@endif>No
                                        </option>
                                        <option value="3"
                                                @if ($sheet['legal_table']['legal'] === "Unknown")selected="selected"@endif>
                                            Unknown
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button type="submit" id="post-sheet" class="btn btn-primary">

                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Save
                                </button>
                            </div>
                </div>

            </div>
        </div>
    </div>
@stop
@push('scripts')
<script>
    $(function () {

        $("#accompaniment_id").autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('searchaccompaniment') }}",
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
        })

    });
    $(function () {
        $("#arranger_id").autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('searcharranger') }}",
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
        })

    });
    $(function () {
        $("#composer_id").autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('searchcomposer') }}",
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
        })

    });
    $(function () {
        $("#publisher_id").autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('searchpublisher') }}",
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
        })

    });
    $(function () {
        $("#voicing_id").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('searchvoicing') }}",
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
        })

    });
</script>
@endpush
