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
        Schema::create('parishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('language')->default('tr');
            $table->string('priest_image')->nullable();
            $table->string('parish_name')->nullable();
            $table->string('parish_priest')->nullable();
            $table->string('patron')->nullable();
            $table->unsignedSmallInteger('established_year')->nullable();
            $table->unsignedInteger('tamil_population')->nullable();
            $table->unsignedInteger('malayalam_population')->nullable();
            $table->string('vicariate');
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('history')->nullable();
            $table->text('pious_associations')->nullable();
            $table->text('social_movements')->nullable();
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
        Schema::dropIfExists('parishes');
    }
};
