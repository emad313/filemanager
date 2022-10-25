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
        $file_64 = $base64; //your base64 encoded data

        if (strpos($file_64, 'base64')) {

        

        $extension = explode('/', explode(':', substr($file_64, 0, strpos($file_64, ';')))[1])[1];
      
        $replace = substr($file_64, 0, strpos($file_64, ',')+1);
      
      
        $file1 = str_replace($replace, '', $file_64); 
      
        $file1 = str_replace(' ', '+', $file1);
        
        if ($extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $extension = 'xlsx';
        }elseif($extension == 'vnd.openxmlformats-officedocument.wordprocessingml.document'){
            $extension = 'docx';
        }else {
            $extension = $extension;
        }
      
        $randomFileName = Str::random(10).'.'.$extension;
      
        Storage::disk('public')->put($path.'/'.$randomFileName, base64_decode($file1));
        $filepath = 'storage/'.$path.'/'.$randomFileName;
        $filename = $randomFileName;
        return ['filename' => $filename, 'filepath'=>$filepath];
        }else{
            return 'File is not base64';
        }
    }


    public static function getSingleFile($filepath,$filename)
    {
        return Storage::disk('public')->get($filepath.'/'.$filename);
    }

    public static function getAllFiles($directory)
    {
        $files = Storage::disk('public')->allFiles($directory);
        return $files;
    }

    public static function deleteFiles($filepath, $filename)
    {
        Storage::disk('public')->delete($filepath.'/'.$filename);
        $feedback->delete();
        return 'File Delete Successfully!';
    }

    public static function updateFiles($base64, $filepath, $filename)
    {
        $file_64 = $base64; //your base64 encoded data

        if (strpos($file_64, 'base64')) {
            
            Storage::disk('public')->delete($filepath.'/'.$filename);

            $extension = explode('/', explode(':', substr($file_64, 0, strpos($file_64, ';')))[1])[1];
      
            $replace = substr($file_64, 0, strpos($file_64, ',')+1);
      
            $file1 = str_replace($replace, '', $file_64); 
      
            $file1 = str_replace(' ', '+', $file1);

            if ($extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                $extension = 'xlsx';
            }elseif($extension == 'vnd.openxmlformats-officedocument.wordprocessingml.document'){
                $extension = 'docx';
            }else {
                $extension = $extension;
            }
      
            $randomFileName = Str::random(10).'.'.$extension;

            Storage::disk('public')->put($filepath.'/'.$randomFileName, base64_decode($file1));
            $filename = $randomFileName;
            return ['filename' => $filename, 'filepath'=>$filepath];
        } else {
            return 'File is not base64';
        }
    }
}
