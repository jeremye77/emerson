@if (count($errors) > 0)
    <!-- Error List -->
    <div class="alert alert-danger">
        <strong>Oh Bother!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
