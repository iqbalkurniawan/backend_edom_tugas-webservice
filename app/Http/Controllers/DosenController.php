<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
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
        $dosen = Dosen::all();

        return response()->json([
            'success' => true,
            'message' =>'List Data Dosen',
            'data'    => $dosen
        ], 200);
    }

    public function store(Request $request)
    {
      
            $dosen = Dosen::create([
                'nidn' => $request->input('nidn'),
                'nama_dosen' => $request->input('nama_dosen'),
            ]);

            if ($dosen) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dosen Berhasil Disimpan!',
                    'data' => $dosen
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Dosen Gagal Disimpan!',
                ], 400);
            }

    }

    public function show($id)
    {
        $dosen = Dosen::select("*")
                    ->where("id",$id)
                    ->get();

        if ($dosen) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Dosen',
                'data'      => $dosen
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Dosen Tidak Ditemukan!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {   

            $dosen = Dosen::where('id',$id)->update([
                'nidn' => $request->input('nidn'),
                'nama_dosen' => $request->input('nama_dosen')
            ]);

            if ($dosen) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dosen Berhasil Diupdate!',
                    'data' => $dosen
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Dosen Gagal Diupdate!',
                ], 400);
            }
        
    }

    public function destroy($id)
    {
        $dosen = Dosen::where('id',$id)->delete();

        if ($dosen) {
            return response()->json([
                'success' => true,
                'message' => 'Dosen Berhasil Dihapus!',
            ], 200);
        }

    }
}
