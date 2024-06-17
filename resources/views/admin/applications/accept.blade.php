<form action='{{route('application.accept', $id)}}' method='post'>
    @csrf
    <div class='mb-3'>
        <button class='btn btn-primary' type='submit'>Accept</button>
    </div>
</form>