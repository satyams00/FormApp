@extends('layouts.app')

@section('content')
<div>
    <div class="text-center mb-5">
        <h2><strong>Job Details</strong></h2>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Title</th>
                <td>{{$job->title}}</td>
            </tr>
            <tr>
                <th>Post</th>
                <td>{{$job->post}}</td>
            </tr>
            <tr>
                <th>Registration Start Date</th>
                <td>{{$job->registrationStartDate}}</td>
            </tr>
            <tr>
                <th>Registration End Date</th>
                <td>{{$job->registrationEndDate}}</td>
            </tr>
            <tr>
                <th>Minimum Age</th>
                <td>{{$job->minimumAge}}</td>
            </tr>
            <tr>
                <th>Maximum Age</th>
                <td>{{$job->maximumAge}}</td>
            </tr>
            <tr>
                <th>Minimum Height</th>
                <td>{{$job->minimumHeight}}</td>
            </tr>
            <tr>
                <th>Exam date</th>
                <td>{{$job->examDate}}</td>
            </tr>
            <tr>
                <th>Minimum HighSchool Percentage</th>
                <td>{{$job->minimumHighSchoolPercentage}}</td>
            </tr>
            <tr>
                <th>Minimum Intermediate Percentage</th>
                <td>{{$job->minimumIntermediatePercentage}}</td>
            </tr>
            <tr>
                <th>Job Locations</th>
                @php($loc = $job->load('jobLocations')->jobLocations->pluck('name')->toArray())
                <td>{{implode(', ', $loc)}}</td>
            </tr>
            <tr>
                <th>Exam Centers</th>
                @php($center = $job->load('examCenters')->examCenters->pluck('name')->toArray())
                <td>{{implode(', ', $center)}}</td>
            </tr>
            <tr>
                <th>Job Description</th>
                <td>{{$job->jobDescription}}</td>
            </tr>
            <tr>
                <th>Job Created Date</th>
                <td>{{$job->created_at}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection