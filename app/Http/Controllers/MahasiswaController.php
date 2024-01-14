<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
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
        $mahasiswa = Mahasiswa::all();

        return response()->json([
            'success' => true,
            'message' =>'List Data Mahasiswa',
            'data'    => $mahasiswa
        ], 200);
    }

    public function store(Request $request)
    {
      
            $mahasiswa = Mahasiswa::create([
                'nim' => $request->input('nim'),
                'nama_mahasiswa' => $request->input('nama_mahasiswa'),
                'tahun_angkatan' => $request->input('tahun_angkatan')

            ]);

            if ($mahasiswa) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mahasiswa Berhasil Disimpan!',
                    'data' => $mahasiswa
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa Gagal Disimpan!',
                ], 400);
            }

    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::select("*")
                    ->where("id",$id)
                    ->get();

        if ($mahasiswa) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Mahasiswa',
                'data'      => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa Tidak Ditemukan!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {   

            $mahasiswa = Mahasiswa::where('id',$id)->update([
                'nim' => $request->input('nim'),
                'nama_mahasiswa' => $request->input('nama_mahasiswa'),
                'tahun_angkatan' => $request->input('tahun_angkatan')
            ]);

            if ($mahasiswa) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mahasiswa Berhasil Diupdate!',
                    'data' => $mahasiswa
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa Gagal Diupdate!',
                ], 400);
            }
        
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('id',$id)->delete();

        if ($mahasiswa) {
            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa Berhasil Dihapus!',
            ], 200);
        }

    }
}
