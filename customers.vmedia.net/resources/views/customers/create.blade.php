@extends('app')
@section('content')
    <h1>Add a New Customer</h1>

    <hr/>

    {!! Form::open(['url'=>'customers']) !!}
        @include('customers._form',['submitButtonText'=>'Add Customer'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection