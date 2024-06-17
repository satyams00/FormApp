@extends('layouts.app')


@section('content')
<div class="modal fade" id="appliedForModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title " id="exampleModalLabel"><strong>Edit Application</strong></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='mb-3 ' id="editForm"  method='post'>
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
                        <input type='number' id="height" class='form-control ' name='height' value="" placeholder='Enter your height'>
                        <span class="text-danger" id="heightError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='highSchoolPercentage' class='form-label'>High School Percentage</label>
                        <input type='number' id="highSchool" class='form-control ' name='highSchoolPercentage' value="" placeholder='Enter your high school percentage'>
                        <span class="text-danger" id="highSchoolPercentageError"></span>
                    </div>
                    <div class='mb-3'>
                        <label for='intermediatePercentage' class='form-label'>Intermediate Percentage</label>
                        <input type='number' id="intermediate" class='form-control ' name='intermediatePercentage' value="" placeholder='Enter your intermediate percentage'>
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
                        <input type='text'id="address" class='form-control ' name='address' value="" placeholder='Enter your address'>
                        <span class="text-danger" id="addressError"></span>
                    </div>
                    <div class='mb-3'>
                        <input type="hidden" id="hiddenApplicationId" name="id" value="">
                        <button class='btn btn-primary w-100 waves-effect waves-light ' type="submit" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('form_update_msg'))
    <div class="alert alert-success">{{session('form_update_msg')}}</div>
@endif


<div>
    <table class="table table-bordered" id="appliedFor_table">
        <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Post</th>
            <th>Status</th>
            <th>Apply Date</th>
            <th>Edit</th>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#appliedFor_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('application.show', auth()->user())}}",
            columns: [
                { data: 'DT_RowIndex', searchable: false, orderable: false },
                { data: 'title' ,searchable: false, orderable: false },
                { data: 'post' ,searchable: false, orderable: false },
                { data: 'status' },
                { data: 'created_at',searchable: false, orderable: false },
                { data: 'edit', searchable: false, orderable: false },
            ]
        });
    });
</script>
<script>
    $(document).on('click', '.editBtn' ,function () {
        $id = $(this).val();
        $('#hiddenApplicationId').val($id);
        $.ajax({
            type: "GET",
            url: "/applications/"+$id+"/edit",
            success:function(data){
                $('#title').val(data.title);
                $('#post').val(data.post);
                $('#height').val(data.application.height);
                $('#highSchool').val(data.application.highSchoolPercentage);
                $('#intermediate').val(data.application.intermediatePercentage);
                $('#address').val(data.application.address);
                $('#preferredJobLocation').empty();
                $('#preferredJobLocation').append(new Option('Select',''));
                data.jobLocations.forEach(function(location){
                    if(location.name === data.selectedLocation){
                        $('#preferredJobLocation').append(new Option(location.name, location.id,true,true));
                    }else{
                        $('#preferredJobLocation').append(new Option(location.name, location.id));
                    }
                });
                $('#preferredExamCenter').empty();
                $('#preferredExamCenter').append(new Option('Select',''));
                data.examCenters.forEach(function(center){
                    if(center.name === data.selectedExamCenter){
                        $('#preferredExamCenter').append(new Option(center.name, center.id,true,true));
                    }else{
                        $('#preferredExamCenter').append(new Option(center.name, center.id));
                    }
                });
            }
        });
    });
</script>
<script>
     $(document).ready(function() {
        $('#editForm').on('submit', function(event) {
            let applicationId = $('#hiddenApplicationId').val();
            event.preventDefault();
            let formData = $(this).serialize();
            let url= "{{ route('application.update','__APPLICATION_ID__') }}".replace('__APPLICATION_ID__', applicationId);
            $.ajax({
                url: url,
                type: 'PATCH',
                data: formData,
                success: function(response) {
                    alert(response.msg);
                    $('#appliedForModal').modal('hide');
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                    $('#appliedForModal').modal('show');
                }
            });
        });
    });
</script>

@endsection