<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DmaModel extends Model
{
	protected $table = 'dma_super';

	protected $guarded = ['id'];

	public function dmas()
	{
		$query = "
			SELECT ST_AsGeoJSON(ds.geom) as geom, ds.cabang, ds.kode_dma, ds.nama_dma, ds.sumber_air, count(sc.geom) as jumlah_pelanggan, sum(sc.pemakaian) as pemakaian, round(sum(sc.tagihan)) as tagihan from dma_super ds left join stagging_cust sc on ST_CoveredBy(sc.geom, ds.geom) group by ds.geom, ds.kode_dma, ds.nama_dma, ds.cabang, ds.sumber_air ORDER BY ds.cabang ASC;
			";

		$data = DB::select($query);

		return $data;
	}
}
