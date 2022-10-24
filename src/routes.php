<?php

use Illuminate\Support\Facades\Route;
use Emad12\Fileupload\FileuploadController;

Route::get('fileupload', function(){
    echo 'Hello from the fileupload package!';
});