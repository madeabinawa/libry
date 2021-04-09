<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('gambarPath')) {
            $gambar = $request->file('gambarPath');

            // GENERATE NAMA GAMBAR
            $fileName = now()->timestamp . '_' . $gambar->getClientOriginalName();

            // GENERATE UNIQUE FOLDER (EX: USER ID)
            $uniqDir = uniqid() . '-' . now()->timestamp;

            // GENERATE PATH
            $path = Storage::path($gambar->storeAs('gambar/tmp/' . $uniqDir, $fileName));

            // STORE DIR & PATH TO TEMPORARY TABLES
            TemporaryFile::create([
                'dir' => $uniqDir,
                'filename' => $fileName,
                'path' => $path
            ]);

            return $uniqDir;
        }
        return '';
    }
}
