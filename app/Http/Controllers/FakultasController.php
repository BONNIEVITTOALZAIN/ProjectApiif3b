<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all();
        $data['message'] = true;
        $data['result'] = $fakultas;
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
            'nama' => 'required|unique:fakultas'
        ]);

        $fakultas = Fakultas::create($validate);
        if ($fakultas) {
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil ditambahkan.';
            return response()->json($response, HttpResponse::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakultas)
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
        ]);

        Fakultas::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'Fakultas berhasil diperbarui.';
        return response()->json($response, HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fakultas = Fakultas::where('id', $id);
        if(count($fakultas->get())){
            $fakultas->delete();
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil dihapus.';
            return response()->json($response, HttpResponse::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas tidak ditemukan.';
            return response()->json($response, HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
