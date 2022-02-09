<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_codes', function (Blueprint $table) {
            $table->id();
            $table->string('office_name')->nullable();
            $table->integer('pin_code')->unique()->notNullable();
            $table->string('office_type')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('division_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('circle_name')->nullable();
            $table->string('taluk')->nullable();
            $table->string('district_name')->nullable();
            $table->string('state_name')->nullable();
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
        Schema::dropIfExists('pin_codes');
    }
}
