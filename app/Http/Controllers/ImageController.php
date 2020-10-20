<?php

namespace App\Http\Controllers;

use App\Jobs\ResizeImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create()
    {
        return view('file');
    }


    public function store(Request $request)
    {
        $file = $request->file('file');
        $image = $file->move(public_path("uploads/{$file->getBasename()}", $file->getClientOriginalExtension()));
        $formats = [150, 500, 1000, 1200, 1400];
        echo $image->getBasename();
        $this->dispatch(new ResizeImage($image, $formats));
        return view('file');
    }
}