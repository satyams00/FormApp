@if(auth()->user()->role == 'admin')
    <form action='{{route('jobs.delete', $id)}}' method='post'>
        @csrf
        @method('Delete')
        <div class='mb-3'>
            <button class='btn btn-danger' type='submit' onclick="return confirm('Are you sure?')">Delete</button>
        </div>
    </form>
@elseif(App\Models\Application::where('user_id', auth()->user()->id)->where('job_id', $id)->exists())
    <button class='btn btn-primary' disabled>Applied</button>
@else
    <button class='btn btn-primary applyJob' type='submit' name="jobId" value="{{$id}}" data-bs-toggle="modal"
        data-bs-target="#applyModal">Apply</button>


@endif