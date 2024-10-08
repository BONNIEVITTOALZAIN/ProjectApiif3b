<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Mahasiswa = Mahasiswa::with('prodi')->get();
        $data['message'] = true;
        $data['result'] = $Mahasiswa;
        return response()->json($data, HttpResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'tanggal_lahir' => 'date',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'prodi_id' => 'required'

        ]);

        $mahasiswa = Mahasiswa::create($validate);
        if ($mahasiswa) {
            $response['success'] = true;
            $response['message'] = 'Mahasiswa berhasil ditambahkan.';
            $response['result'] = $mahasiswa;
            return response()->json($response, HttpResponse::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'date',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'prodi_id' => 'required'
        ]);

        Mahasiswa::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'Mahasiswa berhasil diperbarui.';
        return response()->json($response, HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('id', $id);
        if (count($mahasiswa->get())) {
            $mahasiswa->delete();
            $response['success'] = true;
            $response['message'] = 'Mahasiswa berhasil dihapus.';
            return response()->json($response, HttpResponse::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Mahasiswa tidak ditemukan.';
            return response()->json($response, HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
