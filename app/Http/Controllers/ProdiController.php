<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Prodi = Prodi::with('fakultas')->get();
        $data['message'] = true;
        $data['result'] = $Prodi;
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
            'nama' => 'required|unique:prodis',
            'fakultas_id' => 'required'

        ]);


        $prodi = Prodi::create($validate);
        if ($prodi) {
            $response['success'] = true;
            $response['message'] = 'Prodi berhasil ditambahkan.';
            $response['result'] = $prodi;
            return response()->json($response, HttpResponse::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'fakultas_id' => 'required'
        ]);

        Prodi::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'Prodi berhasil diperbarui.';
        return response()->json($response, HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prodi = Prodi::where('id', $id);
        if (count($prodi->get())) {
            $prodi->delete();
            $response['success'] = true;
            $response['message'] = 'Prodi berhasil dihapus.';
            return response()->json($response, HttpResponse::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Prodi tidak ditemukan.';
            return response()->json($response, HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
