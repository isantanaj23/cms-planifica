<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/blog', $filename, 'public');

        return response()->json([
            'success' => true,
            'file' => [
                'url' => Storage::url($path),
                'name' => $filename,
                'size' => $file->getSize()
            ]
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        $path = str_replace('/storage/', '', $request->path);
        
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Archivo no encontrado']);
    }
}