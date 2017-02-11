<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExploreController extends Controller
{
    public function index()
    {
        return Storage::disk('movies')->allFiles();
    }
}
