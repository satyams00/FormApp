@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-bordered" id="users-table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>DOB</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->DOB}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('users.index')}}",
            columns: [
                { data: 'DT_RowIndex', searchable: false, orderable: false },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'DOB' },
                { data: 'gender' },
            ]
        });
    });

</script>
@endsection