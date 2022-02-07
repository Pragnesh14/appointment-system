@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-12">
            <div class="row justify-content-center">
                @if (Session::has('message'))
                    <div class="alert bg-success alert-success text-white" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('errMessage'))
                    <div class="alert bg-danger alert-success text-white" role="alert">
                        {{ Session::get('errMessage') }}
                    </div>
                @endif
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            <div class="card">
                <div class="card-header">{{ __('Doctor') }}</div>

                <div class="card-body">
                    <a href="{{ route('doctor.create') }}"
                    class="btn btn-primary">Add New Doctor</a>
                    <br> <br>
                    <table class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="nosort">Avatar</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone number</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <img src="{{ asset('images') }}/{{ $user->image }}" class="table-user-thumb"
                                        alt="" width="100%">
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->department }}</td>
                                <td>
                                    <div>
                                        <a href="#" data-toggle="modal" data-target="#exampleModal{{ $user->id }}">
                                            <i class="btn btn-sm btn-primary">View</i>
                                        </a>

                                        <a href="{{ route('doctor.edit', $user->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    </div>

                                    <form action="{{ route('doctor.destroy', $user->id) }}"
                                          method="POST" style="display:inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                        onclick="return confirm('Are you Sure?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @include('admin.doctor.modal')
                        @empty
                            <tr>
                                <td colspan="4">No Doctors.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
