<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipe_id')->constrained('tipes')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solusis');
    }
}
