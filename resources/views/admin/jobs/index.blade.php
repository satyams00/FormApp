@extends('layouts.app')


@section('content')
@if (session('job_delete_msg'))
    <div class="alert alert-success">{{session('job_delete_msg')}}</div>
@endif



<table class="table table-bordered" id="jobs-table">
    <thead>
        <th>Id</th>
        <th>Title</th>
        <th>Post</th>
        <th>Registration Start</th>
        <th>Last Date</th>
        <th>Exam Date</th>
        <th>Apply Count</th>
        <th>View</th>
        <th>Action</th>
    </thead>
</table>


<!-- Edit Modal -->
<div class="modal fade " id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title " id="exampleModalLabel"><strong>Apply Job</strong></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='mb-3 ' id="applyForm"  method='post'>
                    @csrf
                    @method('POST')
                    <div class='mb-3'>
                        <label for='name' class='form-label'>Name</label>
                        <input type='text' class='form-control '  name='name' value="{{auth()->user()->name}}"
                            placeholder='Enter your name' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='email' class='form-control ' name='email' value="{{auth()->user()->email}}"
                            placeholder='Enter your email' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='phone' class='form-label'>Phone</label>
                        <input type='number' class='form-control ' name='phone' value="{{auth()->user()->phone}}"
                            placeholder='Enter your phone' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='DOB' class='form-label'>DOB</label>
                        <input type='date' class='form-control ' name='DOB' value="{{auth()->user()->DOB}}"
                            placeholder='Enter your DOB' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='gender' class='form-label'>Gender</label>
                        @php($gender = strtolower(auth()->user()->gender))
                        <input type='radio' name=' gender' @if($gender == "male") checked @endif value="Male" disabled> Male
                        <input type='radio' name=' gender' @if($gender == "female") checked @endif value="Female" disabled> Female
                    </div>
                    <div class='mb-3'>
                        <label for='title' class='form-label'>Job Title</label>
                        <input type='text' class='form-control ' id="title" name='title' value="" placeholder='Enter your title' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='post' class='form-label'>Job Post</label>
                        <input type='text' class='form-control ' id="post" name='post' value="" placeholder='Enter your post' disabled>
                    </div>
                    <div class='mb-3'>
                        <label for='height' class='form-label'>Height</label>
                        <input type='number' class='form-control ' id="height" name='height' value="{{old('height')}}" placeholder='Enter your height'>
                        <span class="text-danger" id="heightError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='highSchoolPercentage' class='form-label'>High School Percentage</label>
                        <input type='number' class='form-control ' id="highSchool"name='highSchoolPercentage' value="" placeholder='Enter your high school percentage'>
                        <span class="text-danger" id="highSchoolPercentageError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='intermediatePercentage' class='form-label'>Intermediate Percentage</label>
                        <input type='number' class='form-control ' id="intermediate" name='intermediatePercentage' value="" placeholder='Enter your intermediate percentage'>
                        <span class="text-danger" id="intermediatePercentageError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='preferredJobLocation' class='form-label'>Prefered Job location</label>
                        <select name="preferredJobLocation" class="form-control" id="preferredJobLocation">
                            
                        </select>
                        <span class="text-danger" id="preferredJobLocationError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='preferredExamCenter' class='form-label'>Prefered Exam Center</label>
                        <select name="preferredExamCenter" class="form-control" id="preferredExamCenter">

                        </select>
                        <span class="text-danger" id="preferredExamCenterError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='address' class='form-label'>Address</label>
                        <input type='text' class='form-control' id="address" name='address' value="" placeholder='Enter your address'>
                        <span class="text-danger" id="addressError"></span>
                    </div>
                    <div class='mb-3'>
                        <input type="hidden" id="hiddenJobId" name="job_id" value="">
                        <button class='btn btn-primary w-100 waves-effect waves-light submitApplication' type="submit" >Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#jobs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('jobs.index')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                { data: 'title' },
                { data: 'post' },
                { data: 'registrationStartDate' },
                { data: 'registrationEndDate' },
                { data: 'examDate' },
                { data: 'apply_count', searchable: false, orderable: false },
                { data: 'view', searchable: false, orderable: false },
                { data: 'action', searchable: false, orderable: false },
            ]
        });
    });

    $(document).on('click', '.applyJob', function(){
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/jobs/"+id+"/apply",
            success:function (data) {
                $('#title').val( data.job.title);
                $('#post').val( data.job.post);
                $('#hiddenJobId').val( data.job.id);
                $('#preferredJobLocation').empty();
                $('#preferredJobLocation').append(new Option('Select',''));
                data.locations.forEach(function(location){
                    $('#preferredJobLocation').append(new Option(location.name, location.id,"select"));
                });
                $('#preferredExamCenter').empty();
                $('#preferredExamCenter').append(new Option("Select",''));
                data.examCenters.forEach(function(center){
                    $('#preferredExamCenter').append(new Option(center.name, center.id,"select"));
                });
            }
        });
    });

</script>

<script>
     $(document).ready(function() {
        $('#applyForm').on('submit', function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route('application.store') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert(response.msg);
                    $('#applyModal').modal('hide');
                },
                error: function(response) {
                    // let errors = response.responseJSON.errors;
                    alert(response.responseJSON.message);
                    $('#applyModal').modal('show');
                }
            });
        });
        });
</script>

@endsection
