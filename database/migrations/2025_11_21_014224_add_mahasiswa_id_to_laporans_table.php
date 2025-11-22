<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->foreignId('mahasiswa_id')->nullable()->constrained('mahasiswas')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->dropForeign(['mahasiswa_id']);
        $table->dropColumn('mahasiswa_id');
    });
}
};
