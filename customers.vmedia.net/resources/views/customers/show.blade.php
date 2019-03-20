@extends('app')
@section('content')
    <h1>Details For Customer Id: {{$customer->cId}}</h1>
    <hr/>
    <table>
        <tr><td>Name </td><td>{{$customer->cName}} </td></tr>
        <tr><td>Company </td><td>{{$customer->company}} </td></tr>
        <tr><td>Contact </td><td>{{$customer->contact}} </td></tr>
        <tr><td>Email </td><td>{{$customer->email}} </td></tr>
        <tr><td>Type </td><td>{{$customer->type}} </td></tr>
        <tr><td>Created on </td><td>{{$customer->created_at}} </td></tr>
    </table>
    <a href="/customers/{{$customer->cId}}/edit">Edit Details</a>
@endsection