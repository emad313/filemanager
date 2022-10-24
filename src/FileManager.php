<?php

namespace Emad12\Fileupload;

use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function upload($base64, $path)
    {
        $image_64 = $base64; //your base64 encoded data

        if (strpos($image_64, 'base64')) {

        

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


    public static function getfilebyname($filepath,$filename)
    {
        return Storage::disk('public')->get($filepath.'/'.$filename);
    }

    public static function getallfiles($directory)
    {
        $files = Storage::disk('public')->allFiles($directory);
        return $files;
    }

    public static function detelefile($filepath, $filename)
    {
        Storage::disk('public')->delete($filepath.'/'.$filename);
        $feedback->delete();
        return 'File Delete Successfully!';
    }

    public static function updatefile($base64, $filepath, $filename)
    {
        $image_64 = $base64; //your base64 encoded data

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
