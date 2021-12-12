@extends('frontend_master')
@section('content')
@if(count($images))
 <ul>
 @foreach($images as $each)
 <li>
 <a href="{{url('snatch/'.$each->id)}}"><img src="{{Config::get('image.thumb_folder').'/'.$each->image}}" alt=""> </a>
 </li>
 @endforeach
 </ul>
 <p>{{$images->links()}}</p>
@else
 {{--If no images are found on the database, we will show
 a no image found error message--}}
 <p>No images uploaded yet, <a href="/">care to upload one?</a></p>
@endif
@stop
