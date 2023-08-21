<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model')->nullable();
            $table->string('collection')->default('image');

            $table->string("mime_type")->nullable();
            $table->string("custom_properties")->nullable();
            $table->boolean("preview_generated")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            //

        });
    }
};
