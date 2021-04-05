<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penerbit::paginate(10);
        return view('penerbit.index', compact('data'));
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
            'nama_penerbit' => 'required',
            'kota' => 'required',
            'telp' => 'required'
        ]);

        try {
            Penerbit::create($request->all());
        } catch (Exception $e) {
            return response([
                'status' => 'Error',
                'message' => $e
            ], 500);
        }
        return redirect()->route('penerbit.index')->with('success', 'Successfully create new publisher');
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
            'id_penerbit' => 'required',
            'nama_penerbit' => 'required',
            'kota' => 'required',
            'telp' => 'required'
        ]);

        try {
            Penerbit::where('id_penerbit', $id)
                ->update([
                    'nama_penerbit' => $request->nama_penerbit,
                    'kota' => $request->kota,
                    'telp' => $request->telp
                ]);

            // $kategori = Penerbit::find($id);

            // $kategori->nama = $request->jenis_kategori;
            // $kategori->save();
        } catch (Exception $e) {
            return response([
                'error' => $e
            ], 501);
        }
        response([
            'success' => 'Successfully created data'
        ]);

        return redirect()->route('penerbit.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penerbit::destroy($id);
        return redirect()->route('penerbit.index')->with('success', 'Successfully deleted');
    }
}
