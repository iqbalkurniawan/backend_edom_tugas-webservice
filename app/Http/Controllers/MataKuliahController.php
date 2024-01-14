<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
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
        $matakuliah = Matakuliah::all();

        return response()->json([
            'success' => true,
            'message' =>'List Data Matakuliah',
            'data'    => $matakuliah
        ], 200);
    }

    public function store(Request $request)
    {
      
            $matakuliah = Matakuliah::create([
                'kodematkul' => $request->input('kodematkul'),
                'matakuliah' => $request->input('matakuliah')
            ]);

            if ($matakuliah) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mata Kuliah Berhasil Disimpan!',
                    'data' => $matakuliah
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Mata Kuliah Gagal Disimpan!',
                ], 400);
            }

    }

    public function show($id)
    {
        $matakuliah = Matakuliah::select("*")
                    ->where("id",$id)
                    ->get();

        if ($matakuliah) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Mata Kuliah',
                'data'      => $matakuliah
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mata Kuliah Tidak Ditemukan!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {   

            $matakuliah = Matakuliah::where('id',$id)->update([
                'kodematkul' => $request->input('kodematkul'),
                'matakuliah' => $request->input('matakuliah')
            ]);

            if ($matakuliah) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mata Kuliah Berhasil Diupdate!',
                    'data' => $matakuliah
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Mata Kuliah Gagal Diupdate!',
                ], 400);
            }
        
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::where('id',$id)->delete();

        if ($matakuliah) {
            return response()->json([
                'success' => true,
                'message' => 'Mata Kuliah Berhasil Dihapus!',
            ], 200);
        }

    }
}
