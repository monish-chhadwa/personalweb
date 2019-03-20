@extends('app')
@section('content')
    <h1>Customers</h1>
    <hr/>
    @foreach($customers as $customer)
        <h2>{{$customer->cName}}</h2>
        <p>{{$customer->company}}</p>
        <a href="{{ action('CustomersController@show',[$customer->cId])}}">View all details</a>
    @endforeach
@stop