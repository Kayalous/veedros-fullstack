@extends('layout')

@section('content')
    <section class="my-5">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item shadow m-1">
                    <a href="#all-users" class="nav-link active" data-toggle="tab"> <i
                            class="fas iconsize-mine fa-user mr-2"></i>All users</a>
                </li>
                <li class="nav-item shadow m-1">
                    <a href="#instructors" class="nav-link " data-toggle="tab"><i class="fas fa-university mr-2" aria-hidden="true"></i>
                        Instructors</a>
                </li>
            </ul>
            <div class="tab-content mt-5">
                <div id="all-users" class="tab-pane fade in active show">
            <h1>User list</h1>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="@if($user->role_id === 1) table-success @elseif($user->instructor) table-info @else @endif">
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->role_id !== 1)
                                @if(!$user->instructor)
                                    <button type="button" class="btn btn-warning" onclick="makeInstructor({{$user->id}})">Make instructor</button>
                                    @else
                                    <button type="button" class="btn btn-warning" onclick="removeInstructor({{$user->instructor->id}})">Remove instructor</button>
                                @endif
                                <button type="button" class="btn btn-danger"onclick="deleteUser({{$user->id}})">Delete user</button>
                            @else
                                ADMIN
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>
                <div id="instructors" class="tab-pane fade">
                    <h1>Instructors list</h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->instructor)
                            <tr class="@if($user->role_id === 1) table-success @elseif($user->instructor) table-info @else @endif">
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                            <button type="button" class="btn btn-warning" onclick="removeInstructor({{$user->instructor->id}})">Remove instructor</button>
                                        <button type="button" class="btn btn-danger"onclick="deleteUser({{$user->id}})">Delete user</button>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
</div>
        </div>
    </section>
@endsection
@section('libraryJS')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endsection
@section('customJS')
    <script>
        async function removeInstructor(id) {
            let answer = await Swal.fire({
                title: 'Confirm removing instructor.',
                text: `Are you sure you want to remove this instrucor?`,
                icon: 'error',
                confirmButtonText: 'Yes.',
                showCancelButton:true,
                cancelButtonText: "No."
            })
            if(answer.value ===true){
                window.location.href = `{{route('veedros.admin.remove')}}?id=${id}`;
            }

        }
        async function makeInstructor(id) {
            let answer = await Swal.fire({
                title: 'Confirm adding instructor.',
                text: `Are you sure you want to make this user an instructor?`,
                icon: 'warning',
                confirmButtonText: 'Yeah.',
                showCancelButton:true,
                cancelButtonText: "Nope."
            })
            if(answer.value ===true){
                window.location.href = `{{route('veedros.admin.add')}}?id=${id}`;
            }

        }

        async function deleteUser(id) {
            let answer = await Swal.fire({
                title: 'Confirm deleting user.',
                text: `Are you sure you want to delete this user? This action is irreversible.`,
                icon: 'error',
                confirmButtonText: 'Yes.',
                showCancelButton:true,
                cancelButtonText: "No."
            })
            if(answer.value ===true){
                window.location.href = `{{route('veedros.admin.delete')}}?id=${id}`;
            }

        }
    </script>
@endsection
