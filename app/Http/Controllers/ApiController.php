<?php

namespace App\Http\Controllers;

use App\Models\DmaModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;

class ApiController extends Controller
{
	public function __construct()
	{
		$this->pelanggan = new PelangganModel();
		$this->dma = new DmaModel();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$bbox = $request->query('bbox');
		$pelanggans = $this->pelanggan->pelanggans($bbox);

		$feature = array();

		foreach ($pelanggans as $data) {
			$feature[] = [
				'type' => 'Feature',
				'geometry' => json_decode($data->geom),
				'properties' => [
					'nosamw' => $data->nosamw,
					'nama' => $data->nama,
					'alamat' => $data->alamat,
					'kecamatan' => $data->kecamatan,
					'desa' => $data->desa,
				]
			];
		}

		return response()->json([
			'type' => 'FeatureCollection',
			'features' => $feature,
		])->setEncodingOptions(JSON_NUMERIC_CHECK);
	}

	public function dma(Request $request)
	{
		$bbox = $request->query('bbox');
		$dmas = $this->dma->dmas();

		$feature = array();

		foreach ($dmas as $data) {
			$feature[] = [
				'type' => 'Feature',
				'geometry' => json_decode($data->geom),
				'properties' => [
					'kode_dma' => $data->kode_dma,
					'nama_dma' => $data->nama_dma,
					'cabang' => $data->cabang,
					'sumber_air' => $data->sumber_air ? $data->sumber_air : '-',
					'pelanggan' => $data->jumlah_pelanggan,
					'pemakaian' => $data->pemakaian,
					'tagihan' => $data->tagihan,
				]
			];
		}

		return response()->json([
			'type' => 'FeatureCollection',
			'features' => $feature,
		])->setEncodingOptions(JSON_NUMERIC_CHECK);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
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
