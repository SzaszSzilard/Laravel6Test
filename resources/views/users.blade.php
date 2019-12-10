@extends('layouts.app')

@section('content')
<div class="container">


    <h2>Dashboard</h2>
    <hr/>
    {!! Form::open(['class' => 'searchForm', 'method' => 'GET', 'url' => '/user_search/']) !!}
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
      </div>
      {{-- <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"> --}}
      <input id="search" class="form-control" placeholder="Search" aria-label="Search" type="text" name="search">
    </div>
    {!! Form::close() !!}
    <hr/>
    <a id="create" class="btn btn-primary" href="/user_create" style="margin-bottom: 15px;">Add New User</a>

    @if(Session::has('message'))
    <div class="alert-custom">
        <p>{!! Session('message') !!}</p>
    </div>
    @endif()

    <div id="searchcontent"></div>

    <table class="defaultContent table table-bordered">
        <thead>
        <tr>
            <th style="padding-left: 15px;">#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="110px;">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td style="padding-left: 15px;">{!! $user->id !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->phone !!}</td>
                <td>{!! $user->email !!}</td>
                <td>
                    <a class="btn btn-success btn-sm" href="user_edit/{!! $user->id !!}">Edit</a>
                    {!! Form::open(['class' => 'deleteForm', 'method' => 'DELETE', 'url' => '/user_delete/' . $user->id]) !!}
                    {!! Form::submit('Delete', ['class' => 'delete btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}

                    {!! Form::open(['class' => 'unverifiyForm', 'method' => 'PUT', 'url' => '/user_unverify/' . $user->id]) !!}
                    {!! Form::submit('Unverify', ['class' => 'unverify btn btn-warning btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->links() }}

</div>
@endsection()
