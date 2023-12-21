<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('user_details_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->integer('netsuite_id');
            $table->string('status', 1)->comment('0 = Pending Status , 1 = Approved Status , 2 = Rejected Status');
            $table->bigInteger('phone');
            $table->string('city', 20);
            $table->text('address');
            $table->string('zip', 8);
            $table->string('state', 20);
            $table->string('country', 20);
            $table->string('is_company', 1)->comment('0 = Individual , 1 = Company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
