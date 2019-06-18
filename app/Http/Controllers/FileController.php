<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // attach
    public function uploadFile(Request $request)
    {
        $filename = $request->file('file')->getClientOriginalName();

        $request->file('file')->move(
            env('FRONT_FILES_PATH'), $filename
        );

        return 'File attached successfully';
    }
}
