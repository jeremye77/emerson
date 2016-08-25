<form action="{{ url('delete/3') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" id="delete-task-3" class="btn btn-danger">
        <i class="fa fa-btn fa-trash"></i>Delete
    </button>
</form>
