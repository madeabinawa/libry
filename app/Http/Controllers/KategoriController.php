<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Exception;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::paginate(10);
        return view('kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kategori' => 'required'
        ]);

        // Kategori::create(['jenis_kategori' => $request->jenis_kategori]);

        try {
            Kategori::create([
                'jenis_kategori' => $request->jenis_kategori
            ]);
        } catch (Exception $e) {
            response([
                'error' => $e
            ], 501);
        }

        response([
            'success' => 'Successfully created data'
        ]);

        return redirect()->route('kategori.index')->with('success', 'New category successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'jenis_kategori' => 'required'
        ]);

        try {

            $kategori = Kategori::find($id);

            $kategori->jenis_kategori = $request->jenis_kategori;
            $kategori->save();
        } catch (Exception $e) {
            return response([
                'error' => $e
            ], 501);
        }
        response([
            'success' => 'Successfully created data'
        ]);

        return redirect()->route('kategori.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect()->route('kategori.index')->with('success', 'Successfully deleted');
    }
}
