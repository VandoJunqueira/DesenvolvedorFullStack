<?php

namespace App\Http\Controllers;

use App\Services\UploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public UploadServices $services;

    public function __construct(UploadServices $services)
    {
        $this->services = $services;
    }

    public function upload(Request $request)
    {


        return response()->json($this->services->upload($request));
    }
}
