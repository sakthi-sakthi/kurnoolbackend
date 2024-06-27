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
        Schema::create('religios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('priest_type')->nullable();
            $table->string('name')->nullable();
            $table->string('fathername')->nullable();
            $table->string('mothername')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_ordination')->nullable();
            $table->date('feast_day')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('residence')->nullable();
            $table->string('ministry')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('religios');
    }
};
