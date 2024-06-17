@if(auth()->user()->role == 'admin')
    <button class='btn btn-primary'><a class='text-decoration-none text-light'
            href='{{route('job.edit', $id)}}'>Edit</a></button>
@else
    <form action="{{route('job.viewJob', $id)}}">
        <button class="btn btn-primary" type="submit">View</button>
    </form>
@endif