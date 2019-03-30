<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function store () {
        return response()->json(['data' => [
            'id' => uniqid(true)
        ]]);
    }

    public function upload (Request $request) {
//        abort(500);
        if($request->hasFile('file')) {
            Storage::putFileAs('uploads', $request->file('file'),
                "{$request->file('file')->getClientOriginalName()}.{$request->file('file')->getClientOriginalExtension()}");
            return response()->json(['status' => 'finished'], 202);
        }
        return response()->json(['status' => 'no file'], 422);
    }
}
