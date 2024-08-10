<?php

namespace App\Traits;


trait ImageUploadTrait
{

    public static function uploadImage($emp_photo_file,$folder)
    {
        try {
            $filename = time() .$emp_photo_file->getClientOriginalName();
            $path= $emp_photo_file->storeAs($folder, $filename, 'public');
            $path='storage/' . $path ;
            } 
            catch (\Throwable $th) {
           $path=$emp_photo_file;
             }

             return  $path;

    }


}
