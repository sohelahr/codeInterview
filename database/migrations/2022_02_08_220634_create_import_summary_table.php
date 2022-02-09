<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_summary', function (Blueprint $table) {
            $table->id();
            $table->string('import_type')->nullable();
            $table->enum('import_status',['0','1','2'])->default('0')->comment("['0' => 'Processing','1' => 'Success','2' => 'Failed']");
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
        Schema::dropIfExists('import_summary');
    }
}
