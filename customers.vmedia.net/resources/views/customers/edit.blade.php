@extends('app')
@section('content')
    <h1>Edit Customer Id: {{$customer->cId}}</h1>
    <hr/>

    {!! Form::model($customer,['method'=>'PATCH','action'=>['CustomersController@update',$customer->cId]]) !!}
        @include('customers._form',['submitButtonText'=>'Update Customer'])
    {!! Form::close() !!}

    @include('errors.list')
@stop