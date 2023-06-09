<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_attributes', function (Blueprint $table) {
            $table->id();
            // The name of the attribute
            $table->string('name');
            // The type, can be Laravel's types or custom ones
            $table->string('type');
            // The name of the column in the values table that is populated with values related to current attribute
            $table->string('column_name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
