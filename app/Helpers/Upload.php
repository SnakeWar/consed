<?php

/**
 * Upload helper
 *
 */

if(!function_exists('upload')){
    function upload($request, $dir)
    {
        if(valid_image($request))
        {
            $extension = $request->image->extension();
            $title = set_filename_random();
            $nameFile = "{$title}.{$extension}";

            $upload = $request->image->storeAs($dir, $nameFile);

            if($upload){
                return $nameFile;
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('upload_file')){
    function upload_file($request, $dir, $name = 'file')
    {
        if(valid_file($request))
        {
            $extension = $request->{$name}->extension();
            $title = set_filename_random();
            $nameFile = "{$title}.{$extension}";

            $upload = $request->{$name}->storeAs($dir, $nameFile);

            if($upload){
                return $nameFile;
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('upload_file_base64')){
    function upload_file_base64($data, $dir)
    {
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $typeFile = explode(':', $type);
        $extension = explode('/', $typeFile[1]);
        $ext = $extension[1];

        $title = set_filename_random();
        $filename = "{$title}.{$ext}";
        $file_path = "{$dir}/{$filename}";

        Storage::put($file_path, $data);
        
        if(Storage::exists($file_path)) {
            return $filename;
        }
        return false;
    }
}

if(!function_exists('valid_image'))
{
    function valid_image($request)
    {
        if($request != null)
        {
            return ($request->hasFile('image') && $request->file('image')->isValid());
        }
    }
}

if(!function_exists('valid_file'))
{
    function valid_file($request)
    {
        if($request != null)
        {
            return ($request->hasFile('file') && $request->file('file')->isValid()) || ($request->hasFile('file_mobile') && $request->file('file_mobile')->isValid());
        }
    }
}
