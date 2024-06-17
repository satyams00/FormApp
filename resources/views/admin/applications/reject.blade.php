<form action='{{route('application.reject', $id)}}' method='post'>
    @csrf
    <div class='mb-3'>
        <button class='btn btn-danger' type='submit'>Reject</button>
    </div>
</form>