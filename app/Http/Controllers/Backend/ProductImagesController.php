<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
public function __construct()
    {
       $this->middleware('auth:admin');
    }

    
}
