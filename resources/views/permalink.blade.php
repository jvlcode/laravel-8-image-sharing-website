@extends('frontend_master')
@section('content')
<table style="width:100%">
    <tr>
        <td width="450" valign="top">
            <p>Title: {{$image->title}}</p>
            <img src="{{url(Config::get('image.thumb_folder').'/'.$image->image)}}" alt="">
        </td>
        <td valign="top">
            <p>Direct Image URL</p>
            <input onclick="this.select()" type="text" width="100percent" value=
            "{{url(Config::get('image.upload_folder').'/'.$image->image)}}" />
            <p>Thumbnail Forum BBCode</p>
            <input onclick="this.select()" type="text"
            width="100percent" value="[url={{url('snatch/'.$image->id)}}][img]{{url(Config::get('image.thumb_folder').'/'.$image->image)}}[/img][/url]" />
            <p>Thumbnail HTML Code</p>
            <input onclick="this.select()" type="text" width="100percent" value="<a href='{{url('snatch/'.$image->id)}}'><img src='{{url(Config::get('image.thumb_folder').'/'.$image->image)}}" />
            <a href="{{url('all')}}">See All Images</a>
        </td>
    </tr>
</table>
@stop
