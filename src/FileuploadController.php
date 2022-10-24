<?php

namespace Emad12\Fileupload;

use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileuploadController extends Controller
{
    public static function upload($base64, $path)
    {

        if (strpos($image_64, 'base64')) {

        $image_64 = $base64; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
      
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
      
        // find substring fro replace here eg: data:image/png;base64,
      
        $image = str_replace($replace, '', $image_64); 
      
        $image = str_replace(' ', '+', $image); 
      
        $imageName = Str::random(10).'.'.$extension;
      
        Storage::disk('public')->put($path.'/'.$imageName, base64_decode($image));
        $filepath = 'storage/'.$path.'/'.$imageName;
        $filename = $imageName;
        return ['filename' => $filename, 'filepath'=>$filepath];
        }else{
            return 'File is not base64';
        }
    }


    public static function getfilebyname($filename)
    {
        return Storage::disk('public')->url($filename);
    }

    public function getallfiles($directory)
    {
        $files = Storage::disk('public')->allFiles($directory);
        return $files;
    }

    public static function detelefile($filename)
    {
        $filepath = Storage::disk('public')->url($filename);
        Storage::disk('public')->delete($filepath.'/'.$filename);
        $feedback->delete();

        return 'File Delete Successfully!';
    }

    public function updatefile($base64, $filename)
    {
        $image_64 = $base64; //your base64 encoded data

        $filepath = Storage::disk('public')->url($filename);

        if (strpos($image_64, 'base64')) {
            
            Storage::disk('public')->delete($filepath.'/'.$filename);

            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
      
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
      
            // find substring fro replace here eg: data:image/png;base64,
      
            $image = str_replace($replace, '', $image_64); 
      
            $image = str_replace(' ', '+', $image); 
      
            $imageName = Str::random(10).'.'.$extension;

            Storage::disk('public')->put($filepath.'/'.$imageName, base64_decode($image));
            $filename = $imageName;
            return ['filename' => $filename, 'filepath'=>$filepath];
        } else {
            return 'File is not base64';
        }
    }
}
