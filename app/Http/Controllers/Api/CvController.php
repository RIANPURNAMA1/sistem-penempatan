<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cv;

class CvController extends Controller
{
    public function index()
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $cv,
            'messages' => 'Data berhasil diambil',
        ]);
    }

    public function show($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->find($id);

        if (! $cv) {
            return response()->json([
                'success' => false,
                'message' => 'CV tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cv,
        ]);
    }
}
