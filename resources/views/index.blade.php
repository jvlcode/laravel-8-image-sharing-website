
@extends('frontend_master')
@section('content')
 <form action="/" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" id="" placeholder="Please insert your title here">
    <input type="file" name="image" id="">
    <input type="submit" name="send" value="Save">
    @csrf
</form>
@stop
