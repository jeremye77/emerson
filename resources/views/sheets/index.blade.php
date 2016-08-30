@extends('layouts.app')
@section('content')
    <table class="table table-striped table-bordered" id="sheets-table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Alt Title</th>
            <th>Composer</th>
            <th>Arranger</th>
            <th>Voicing</th>
            <th>Acc.</th>
            <th>Publisher</th>
            <th>Number</th>
            <th>Copyright</th>
            <th>Qty.</th>
            <th>Legal</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')

<script>
    $(function() {
        $('#sheets-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            dom: 'Blfrtip',
            stateSave: true,
            paginate: false,
            buttons: [
                   {
                     extend: 'colvis',
                     postfixButtons: [ 'colvisRestore' ]
                   }
                    ],

		columns: [
                { data: 'name', name: 'sheet_name'},
                { data: 'altname',  name: 'sheet_alternative_name'},
                { data: 'composer', name: 'composer'},
                { data: 'arranger', name: 'arranger'},
                { data: 'voicing', name: 'voicing'},
                { data: 'accompaniment', name: 'accompaniment'},
                { data: 'publisher', name: 'publisher', visible: false},
                { data: 'publisherno', name: 'publisher', visible: false},
                { data: 'copyright', name: 'copyright_year', visible: false},
                { data: 'quantity', name: 'quantity', searchable: false, visible: false},
                { data: 'legal', name: 'legal', searchable: false, visible: false},
                { data: 'action', name: 'action', orderable: false, searchable: false, visible: false}
                         ]
      });
    });
</script>
<script>
    $('#sheets-table').on('click', '.btn-delete[data-remote]', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('id');
        var url = $(this).data('remote');
// confirm then
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: {method: 'DELETE', submit: true,
                "_token": "{{ csrf_token() }}",
                "id": id}
        }).always(function (data) {
            $('#sheets-table').DataTable().draw(false);
        });
    });
</script>
@endpush
