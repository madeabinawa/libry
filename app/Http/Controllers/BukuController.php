<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::paginate(5);
        // dd($data);
        return view('buku.index', compact('data'));
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
        try {
            $request->validate([
                'isbn' => 'required',
                'judul' => 'required',
                'tahun_terbit' => 'required',
                'jumlah' => 'required',
                'id_kategori' => 'required',
                'id_penerbit' => 'required',
            ]);

            $buku = $request->all();

            if ($request->has('gambarPath')) {
                //HINT:: PAY ATTENTION AT config/filesystems.php to GET, MOVE, DEL FILE

                // FIND TEMPR FILE RECORD FROM DB
                $temp = TemporaryFile::where('dir', $request->gambarPath)->first();

                // GET FILE IMAGE FROM TEMPORARY DIRECTORY
                $file = Storage::disk('local')->get('/gambar/tmp/' . $temp->dir . '/' . $temp->filename);
                // dd($file);

                // PUT FILE IMAGE TO THE ACTUAL DIRECTORY
                Storage::disk('public')->put('gambar/' . $temp->filename, $file); //This works but error

                // DELETE TEMPORARY FILE DIRECTORY
                Storage::disk('local')->deleteDirectory('/gambar/tmp/' . $temp->dir);

                // ADD GAMBAR KEY WITH VALUE as FILENAME
                $buku['gambar'] = $temp->filename;

                // DELETE TEMPORARY RECORD IN DATABASE
                TemporaryFile::destroy($temp->id);
            }

            Buku::create($buku);

            $response = compact('buku');
        } catch (Exception $e) {
            $response = compact([
                'error' => $e
            ]);
        }

        return redirect()->route('buku.index')->with('success', 'Successfully create new book');
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
            'id_buku' => 'required',
            'isbn' => 'required',
            'judul' => 'required',
            'tahun_terbit' => 'required',
            'jumlah' => 'required',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
        ]);

        $buku = Buku::find($id);
        $buku->update($request->all());


        if ($request->has('gambarPath')) {
            //HINT:: PAY ATTENTION AT config/filesystems.php to GET, MOVE, DEL FILE


            // FIND TEMPR FILE RECORD FROM DB
            $temp = TemporaryFile::where('dir', $request->gambarPath)->first();

            // GET FILE IMAGE FROM TEMPORARY DIRECTORY
            $file = Storage::disk('local')->get('/gambar/tmp/' . $temp->dir . '/' . $temp->filename);
            // dd($file);

            // PUT FILE IMAGE TO THE ACTUAL DIRECTORY
            Storage::disk('public')->put('gambar/' . $temp->filename, $file);

            // DELETE TEMPORARY FILE DIRECTORY
            Storage::disk('local')->deleteDirectory('/gambar/tmp/' . $temp->dir);

            // GET OLD IMAGE PATH
            $oldImagePath = $buku->gambar;

            // UPDATE BUKU IMAGE PATH
            $buku->gambar = $temp->filename;
            $buku->save();

            // DELETE OLD IMAGE
            Storage::disk('public')->delete('gambar/' . $oldImagePath);

            // DELETE TEMPORARY RECORD IN DATABASE
            TemporaryFile::destroy($temp->id);
        }

        return redirect()->route('buku.index')->with('success', 'Successfully update book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE OLD IMAGE
        $buku = Buku::find($id);
        $oldImagePath = $buku->gambar;

        Storage::disk('public')->delete('gambar/' . $oldImagePath);
        Buku::destroy($buku->id_buku);

        return redirect()->route('buku.index')->with('success', 'Successfully delete book');
    }
}
