<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function index()
    {
        $penilaian = Penilaian::all();

        return response()->json([
            'success' => true,
            'message' =>'List Data Penilaian',
            'data'    => $penilaian
        ], 200);
    }

    public function store(Request $request)
    {
      
            $penilaian = Penilaian::create([
                'mahasiswa_id' => $request->input('mahasiswa_id'),
                'matkul_id' => $request->input('matkul_id'),
                'nilai' => $request->input('nilai'),
                'dosen_id' => $request->input('dosen_id')
            ]);

            if ($penilaian) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penilaian Berhasil Disimpan!',
                    'data' => $penilaian
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Penilaian Gagal Disimpan!',
                ], 400);
            }

    }

    public function show($id)
    {
        $penilaian = Penilaian::select("*")
                    ->where("id",$id)
                    ->get();

        if ($penilaian) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Penilaian',
                'data'      => $penilaian
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Penilaian Tidak Ditemukan!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {   

            $penilaian = Penilaian::where('id',$id)->update([
                'mahasiswa_id' => $request->input('mahasiswa_id'),
                'matkul_id' => $request->input('matkul_id'),
                'nilai' => $request->input('nilai'),
                'dosen_id' => $request->input('dosen_id')
            ]);

            if ($penilaian) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penilaian Berhasil Diupdate!',
                    'data' => $penilaian
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Penilaian Gagal Diupdate!',
                ], 400);
            }
        
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::where('id',$id)->delete();

        if ($penilaian) {
            return response()->json([
                'success' => true,
                'message' => 'Penilaian Berhasil Dihapus!',
            ], 200);
        }

    }
}
