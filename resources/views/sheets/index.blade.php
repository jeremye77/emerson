@extends('layouts.app')
@section('content')
    <table class="table table-bordered" id="sheets-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Alt Title</th>
            <th>Composer</th>
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
            dom: 'Bfrtip',
            buttons: [
                   {
                     extend: 'colvis',
                     postfixButtons: [ 'colvisRestore' ]
                   }
                    ],
            columnDefs: [
                  {
                    targets: -1,
                    visible: false
                  }
                        ],
		columns: [
                { data: 'sheet_name', name: 'sheet_name' },
                { data: 'sheet_alternative_name',  name: 'sheet_alternative_name'},
                { data: 'composer.composer', name: 'composer.composer'},
                { data: 'voicing.voicing', name: 'voicing.voicing'},
                { data: 'accompaniment.accompaniment', name: 'accompaniment.accompaniment'},
                { data: 'publisher.publisher', name: 'publisher.publisher'},
                { data: 'publisher_number', name: 'publisher_number'},
                { data: 'copyright_year', name: 'copyright_year'},
                { data: 'quantity', name: 'quantity'},
                { data: 'legal_table.legal', name: 'legal_table.legal'},
                { data: 'action', name: 'action', orderable: false, searchable: false},
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
