<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,mp4,webm,mkv|max:102400'
          ]);

        if ($request->file('file')) {
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public_uploads')->put('/candy/', $image);
            Files::create([
                'name' => $image->hashName(),
                'file' => '/uploads/candy/'.$image->hashName(),
                'format' => $image->getClientOriginalExtension(),
                'user_id' => Auth::user()->id,
                'business_id' => $request->input('business_id'),
                'active' => true,
                'link' => $image->hashName()
            ]);
            return response([
                "success" => true,
                'token' => $image->hashName(),
            ], 200);
        }
    }
}
