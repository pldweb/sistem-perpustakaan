<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    public function listFile()
    {
        // Mendapatkan semua file dari folder 'uploads' di disk 's3'
        $files = Storage::disk('s3')->allFiles();

        // Mendapatkan URL untuk setiap file
        $fileUrl = array_map(function($file) {
            return Storage::disk('s3')->url($file);
        }, $files);

        return view('files', ['fileUrl' => $fileUrl]);
    }
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');

        // Ambil nama asli file
        $originalFileName = $file->getClientOriginalName();

        // Menentukan path penyimpanan
        $filePath = $file->storeAs('uploads/tes/images', $originalFileName, [
            'disk' => 's3',
            'visibility' => 'public'
        ]);

        // Ambil url file
        $url = Storage::disk('s3')->url($filePath);

        return response()->json(['url' => $url]);
    }

    public function downloadFile($filename)
    {
        return Storage::disk('s3')->download('uploads/' . $filename);
    }
    public function deleteFile(Request $request)
    {
        // Mendapatkan URL file dari request
        $fileUrl = $request->input('file');

        // Menghapus domain dan bucket untuk mendapatkan path relatif
        // Misalnya, jika URL adalah "https://s3-jak01.storageraya.com/md37f25580cb73608/uploads/tes/images/sauro.jpg"
        // Maka kita ingin mendapatkan "/uploads/tes/images/sauro.jpg"

        $bucketAndDomain = 'https://s3-jak01.storageraya.com/md37f25580cb73608/';
        $relativePath = str_replace($bucketAndDomain, '', $fileUrl);

        // Cek apakah path valid
        if (empty($relativePath)) {
            return response()->json(['message' => 'Invalid file path.'], 400);
        }

        // Menghapus file dari disk 's3'
        if (Storage::disk('s3')->exists($relativePath)) {
            Storage::disk('s3')->delete($relativePath);
            return response()->json(['message' => 'File deleted successfully.']);
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }



}
