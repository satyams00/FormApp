@extends('layouts.app')

@section('content')
@if (session('accept_application_msg'))
    <div class="alert alert-success">{{session('accept_application_msg')}}</div>
@elseif(session('reject_application_msg'))
    <div class="alert alert-danger">{{session('reject_application_msg')}}</div>
@endif
<div>
    <table class="table table-bordered" id="view-request-table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Post</th>
            <th>Title</th>
            <th>Accept</th>
            <th>Reject</th>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#view-request-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('application.viewRequest')}}",
            columns: [
                { data: 'DT_RowIndex', searchable: false, orderable: false },
                { data: 'name', searchable: false, orderable: false },
                { data: 'email', searchable: false, orderable: false },
                { data: 'post', searchable: false, orderable: false },
                { data: 'title', searchable: false, orderable: false },
                { data: 'accept', searchable: false, orderable: false },
                { data: 'reject', searchable: false, orderable: false },
            ]
        });
    });
</script>
@endsection