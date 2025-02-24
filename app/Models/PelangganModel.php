<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
	protected $table = 'stagging_cust';

	protected $guarded = ['id'];

	public function pelanggans($bbox)
	{
		$data = $this->selectRaw('ST_AsGeoJSON(geom) as geom, nosamw, nama, alamat, kecamatan, desa, rw, rt, kode_tarif, nama_tarif')
		->when($bbox, function($query, $bbox) {
			return $query->whereRaw('st_contains(st_makeenvelope(' . $bbox . ', 4326), geom)');
		})
		// ->orderby('nosamw', 'asc')
		->limit(200)
		->get();

		return $data;
	}
}
