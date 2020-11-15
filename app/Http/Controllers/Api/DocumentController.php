<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document_Cate;
class DocumentController extends Controller
{
    public function index()
    {
    	$cate_doc = Document_Cate::all();
    	return response()->json($cate_doc);
    }
}
