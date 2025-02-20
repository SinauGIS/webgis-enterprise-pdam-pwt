<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;
use App\Models\StatusPelangganModel;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->statuspelanggan = new StatusPelangganModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Peta Pelanggan PDAM',
            'statuspelanggan' => $this->statuspelanggan->all(),
        ];

        return view('map', $data);
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
        $data = [
            'geom' => $request->geom_point,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status_pelanggan_id' => $request->status,
        ];

        // Insert data to database
        $this->points->create($data);

        // Redirect to halaman peta pelanggan
        return redirect()->route('pelanggan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
