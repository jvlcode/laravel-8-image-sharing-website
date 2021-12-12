<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    public function index(){
        return view('index');
    }

    public function upload(Request $request){
        $validation = Validator::make($request->all(),
        Photo::$upload_rules);
        if($validation->fails()) {
            return Redirect::to('/')
            ->withInput()
            ->withErrors($validation);
        } else {

            $image = $request->file('image');
            //This is the original uploaded client name of the

            $filename = $image->getClientOriginalName();

            $filename = pathinfo($filename, PATHINFO_FILENAME);
            //We should salt and make an url-friendly version of
            //the filename
            //(In ideal application, you should check the filename
            //to be unique)
            $fullname = Str::slug(Str::random(8).$filename).'.'.
            $image->getClientOriginalExtension();

            $upload = $image->move(Config::get( 'image.upload_folder'),$fullname);

            Image::make(Config::get( 'image.upload_folder').'/'.$fullname)
            ->resize(Config::get( 'image.thumb_width'),Config::get( 'image.thumb_height'))
            ->save(Config::get( 'image.thumb_folder').'/'.$fullname);

            if($upload) {

                $insert_id = DB::table('photos')->insertGetId(
                array(
                'title' =>  $request->get('title'),
                'image' => $fullname
                )
                );
                //Now we redirect to the image's permalink
                return Redirect::to(URL::to('snatch/'.$insert_id))
                ->with('success','Your image is uploaded
                successfully!');

            } else {
                //image cannot be uploaded
                return Redirect::to('/')->withInput()
                ->with('error','Sorry, the image could not be
                uploaded, please try again later');
            }
        }

    }
    public function snatch($id){

        $image = Photo::find($id);

        if($image) {
            return view('permalink')->with('image',$image);
        } else {
            return Redirect::to('/')->with('error','Image not found');
        }
    }

    public function all(){
                //Let's first take all images with a pagination feature
        $all_images = DB::table('photos')->orderBy('id','desc')->paginate(6);
        return view('all_images')->with('images',$all_images);
    }

    public function delete($id){
         //Let's first find the image
        $image = Photo::find($id);

        if($image) {
            File::delete(Config::get('image.upload_folder').'/'.$image->image);
            File::delete(Config::get('image.thumb_folder').'/'
            .$image->image);
            //Now let's delete the value from database
            $image->delete();
            //Let's return to the main page with a success message
            return Redirect::to('/')
            ->with('success','Image deleted successfully');
            } else {

            return Redirect::to('/')->with('error','No image with given ID found');
        }
    }
}
