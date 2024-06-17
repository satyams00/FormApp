@extends('layouts.app')



@section('content')
<form class='mb-3 border rounded-2 p-3' action='{{route('job.update', $job)}}' method='post'>
    @csrf
    @method('Patch')
    <div class="text-center">
        <h1><strong>Edit Job</strong></h1>
    </div>
    <hr class="my-4">
    <div class='mb-3'>
        <label for='title' class='form-label'>Title</label>
        <input type='text' class='form-control ' name='title' value="{{$job->title}}" placeholder='Company Name'>
        @error('title') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='post' class='form-label'>Post</label>
        <input type='text' class='form-control ' name='post' value="{{$job->post}}" placeholder='Post name'>
        @error('post') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='registrationStartDate' class='form-label'>Registration Start Date</label>
        <input type='date' class='form-control ' name='registrationStartDate' value="{{$job->registrationStartDate}}">
        @error('registrationStartDate') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='registrationEndDate' class='form-label'>Registration End Date</label>
        <input type='date' class='form-control ' name='registrationEndDate' value="{{$job->registrationEndDate}}">
        @error('registrationEndDate') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='minimumAge' class='form-label'>Minimum Age</label>
        <input type='number' class='form-control ' name='minimumAge' value="{{$job->minimumAge}}"
            placeholder='Minimum Age'>
        @error('minimumAge') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='maximumAge' class='form-label'>Maximum Age</label>
        <input type='number' class='form-control ' name='maximumAge' value="{{$job->maximumAge}}"
            placeholder='Maximum Age'>
        @error('maximumAge') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='minimumHeight' class='form-label'>Minimum Height</label>
        <input type='number' class='form-control ' name='minimumHeight' value="{{$job->minimumHeight}}"
            placeholder='Minimum Height'>
        @error('maximumAge') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='jobLocation' class='form-label'>Job Location</label>
        <select class="js-example-basic-multiple form-control" name="jobLocation[]" multiple="multiple">
            @foreach (App\Models\JobLocations::all() as $jlocation)
            @php($flag = '')
            @foreach ($job->jobLocations as $location)
            @if($jlocation->id == $location->id) @php($flag = 'selected') @endif
            @endforeach
            <option value="{{$jlocation->id}}" {{$flag}}>{{$jlocation->name}}</option>
            @php($flag = '')
            @endforeach

        </select>
        @error('jobLocation') <span class=" text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='examCenter' class='form-label'>Exam Center</label>
        <select class="js-example-basic-multiple form-control" name="examCenter[]" multiple="multiple">
            @foreach (App\Models\ExamCenter::all() as $jcenter)
            @php($select = '')
            @foreach ($job->examCenters as $center)
            @if($jcenter->id == $center->id) @php($select = 'selected') @endif
            @endforeach
            <option value="{{$jcenter->id}}" {{$select}}>{{$jcenter->name}}</option>
            @php($select = '')
            @endforeach
        </select>
        @error('examCenter') <span class=" text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='minimumHighSchoolPercentage' class='form-label'>Minimum High School Percentage</label>
        <input type='number' class='form-control ' name='minimumHighSchoolPercentage'
            value="{{$job->minimumHighSchoolPercentage}}" placeholder='e.g. 78%'>
        @error('minimumHighSchoolPercentage') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='minimumIntermediatePercentage' class='form-label'>Minimum Intermediate
            Percentage</label>
        <input type='number' class='form-control ' name='minimumIntermediatePercentage'
            value="{{$job->minimumIntermediatePercentage}}" placeholder='e.g. 78%'>
        @error('minimumIntermediatePercentage') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='examDate' class='form-label'>Exam Date</label>
        <input type='date' class='form-control ' name='examDate' value="{{$job->examDate}}">
        @error('examDate') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3'>
        <label for='jobDescription' class='form-label'>Job Description</label>
        <textarea class="form-control" name="jobDescription" rows="10" cols="30">{{$job->jobDescription}}</textarea>
        @error('jobDescription') <span class="text-danger">{{$message}}</span> @enderror
    </div>
    <div class='mb-3 text-center'>
        <button class='btn btn-primary' type='submit'>Submit</button>
    </div>
</form>
@endsection



@section('scripts')
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script>
    $(document).ready(function () {
        $('#applyForm').on('submit', function (event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route('application.store') }}',
                method: 'POST',
                data: formData,
                success: function (response) {
                    console.log('Form submitted successfully');
                    alert('Apllication submitted successfully');
                    $('#applyModal').modal('hide');
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;
                    $.each(errors, function (key, message) {
                        let error = $('#' + key + 'Error');
                        error.empty();
                        error.append(message);
                    });
                    $('#applyModal').modal('show');
                }
            });
        });
    });
</script>
@endsection