@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Entry
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('errors.errors')
                    <form action="/create" method="POST" class="form-horizontal">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Add Title to Library</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sheet_name">Title</label>
                                <div class="col-md-5">
				   <input value="{{ old('sheet_name') }}" id="sheet_name" name="sheet_name" type="text" class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sheet_alternative_title">Alternative Title</label>
                                <div class="col-md-5">
                                    <input value="{{ old('sheet_alternative_title') }}" id="sheet_alternative_title" name="sheet_alternative_title" type="text" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="composer_id">Composer</label>
                                <div class="col-md-5">
                                    <input value="{{ old('composer_id') }}" id="composer_id" name="composer_id" type="search" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="arranger_id">Arranger</label>
                                <div class="col-md-5">
                                    <input value="{{ old('arranger_id') }}" id="arranger_id" name="arranger_id" type="search" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="voicing_id">Voicing</label>
                                <div class="col-md-2">
                                    <input value="{{ old('voicing_id') }}" id="voicing_id" name="voicing_id" type="search"  class="form-control input-md">

                                </div>
                            </div>

                            <!-- Search input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="accompaniment_id">Accompaniment</label>
                                <div class="col-md-4">
                                    <input value="{{ old('accompaniment_id') }}" id="accompaniment_id" name="accompaniment_id" type="search" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="publisher_number">Publisher Number</label>
                                <div class="col-md-5">
                                    <input value="{{ old('publisher_number') }}" id="publisher_number" name="publisher_number" type="text" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="publisher_id">Publisher</label>
                                <div class="col-md-5">
                                    <input value="{{ old('publisher_id') }}" id="publisher_id" name="publisher_id" type="text" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="copyright_year">Copyright</label>
                                <div class="col-md-2">
                                    <input value="{{ old('copyright_year') }}" id="copyright_year" name="copyright_year" type="text" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="quantity">Quantity</label>
                                <div class="col-md-2">
                                    <input value="{{ old('quantity') }}" id="quantity" name="quantity" type="text"  class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="legal_table_id">Legal Copy?</label>
                                <div class="col-md-4">
                                    <select id="legal_table_id" name="legal_table_id" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="3">Unknown</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <button type="submit" id="post-sheet" class="btn btn-primary">

                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Save
                                </button>
			</fieldset>
		     </form>
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
            minLength: 2,
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
            minLength: 2,
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
            minLength: 2,
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
            minLength: 2,
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
            minLength: 1,
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
