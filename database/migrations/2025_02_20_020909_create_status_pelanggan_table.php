<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('status_pelanggan', function (Blueprint $table) {
			$table->id();
			$table->string('status');
			$table->timestamps();
		});

		DB::table('status_pelanggan')->insert([
			['status' => 'Aktif'],
			['status' => 'Cabut Meter'],
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('status_pelanggan');
	}
};
