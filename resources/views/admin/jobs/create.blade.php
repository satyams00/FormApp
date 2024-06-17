@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('create_job_msg'))
        <div class="alert alert-success">{{session('create_job_msg')}}</div>
    @endif
    <div class="row justify-content-center ">
        <div class="col-8 ">
            <form class='bg-body-secondary mb-3 border rounded-2 p-3' action='{{route('jobs.store')}}' method='post'>
                @csrf
                @method('POST')
                <div class="text-center">
                    <h1><strong>Create Job</strong></h1>
                </div>
                <hr class="my-4">
                <div class='mb-3'>
                    <label for='title' class='form-label'>Title</label>
                    <input type='text' class='form-control ' name='title' value="{{old('title')}}"
                        placeholder='Company Name'>
                    @error('title') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='post' class='form-label'>Post</label>
                    <input type='text' class='form-control ' name='post' value="{{old('post')}}"
                        placeholder='Post name'>
                    @error('post') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='registrationStartDate' class='form-label'>Registration Start Date</label>
                    <input type='date' class='form-control ' name='registrationStartDate'
                        value="{{old('registrationStartDate')}}">
                    @error('registrationStartDate') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='registrationEndDate' class='form-label'>Registration End Date</label>
                    <input type='date' class='form-control ' name='registrationEndDate'
                        value="{{old('registrationEndDate')}}">
                    @error('registrationEndDate') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='minimumAge' class='form-label'>Minimum Age</label>
                    <input type='number' class='form-control ' name='minimumAge' value="{{old('minimumAge')}}"
                        placeholder='Minimum Age'>
                    @error('minimumAge') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='maximumAge' class='form-label'>Maximum Age</label>
                    <input type='number' class='form-control ' name='maximumAge' value="{{old('maximumAge')}}"
                        placeholder='Maximum Age'>
                    @error('maximumAge') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='minimumHeight' class='form-label'>Minimum Height</label>
                    <input type='number' class='form-control ' name='minimumHeight' value="{{old('minimumHeight')}}"
                        placeholder='Minimum Height'>
                    @error('maximumAge') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='jobLocation' class='form-label'>Job Location</label>
                    <select class="js-example-basic-multiple form-control" name="jobLocation[]" multiple="multiple">
                        @foreach (App\Models\JobLocations::all() as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                    @error('jobLocation') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='examCenter' class='form-label'>Exam Center</label>
                    <select class="js-example-basic-multiple form-control" name="examCenter[]" multiple="multiple">
                        @foreach (App\Models\ExamCenter::all() as $center)
                            <option value="{{$center->id}}">{{$center->name}}</option>
                        @endforeach
                    </select>
                    @error('examCenter') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='minimumHighSchoolPercentage' class='form-label'>Minimum High School Percentage</label>
                    <input type='number' class='form-control ' name='minimumHighSchoolPercentage'
                        value="{{old('minimumHighSchoolPercentage')}}" placeholder='e.g. 78%'>
                    @error('minimumHighSchoolPercentage') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='minimumIntermediatePercentage' class='form-label'>Minimum Intermediate
                        Percentage</label>
                    <input type='number' class='form-control ' name='minimumIntermediatePercentage'
                        value="{{old('minimumIntermediatePercentage')}}" placeholder='e.g. 78%'>
                    @error('minimumIntermediatePercentage') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='examDate' class='form-label'>Exam Date</label>
                    <input type='date' class='form-control ' name='examDate' value="{{old('examDate')}}">
                    @error('examDate') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3'>
                    <label for='jobDescription' class='form-label'>Job Description</label>
                    <textarea class="form-control" name="jobDescription" rows="10"
                        cols="30">{{old('jobDescription')}}</textarea>
                    @error('jobDescription') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class='mb-3 text-center'>
                    <button class='btn btn-primary' type='submit'>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection