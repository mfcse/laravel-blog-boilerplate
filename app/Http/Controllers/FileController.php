<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FileController extends Controller
{
    //
    public function getForm()
    {
        return view('register');
    }
    public function submitForm(Request $request)
    {
        if ($request->file('photo')->isValid()) {
            $file = $request->file('photo');
            $path = $file->path();
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $imageName = date('Y-m-d') . '-' . $name;
            $file->move(public_path('uploads/images'), $imageName);

            //dd($imageName);
            return 'success';
        }
    }
}