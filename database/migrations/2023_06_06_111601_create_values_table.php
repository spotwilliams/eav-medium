<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();

            // A value belongs to a person
            $table->foreignId('person_id')->constrained();
            // A value is described by a field (EAV field)
            $table->foreignId('custom_attribute_id')->constrained();
            // Add an index to group attributes of one single person close to each other
            $table->index(['person_id', 'custom_attribute_id']);

            // In the same table we store the proper value.
            $table->decimal('money_value')->nullable();
            $table->string('string_value')->nullable();
            $table->boolean('bool_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->date('date_value')->nullable();
            $table->timestamp('timestamp_value')->nullable();
            $table->time('time_value')->nullable();

            // For convenience, we register which column has the stored value
            $table->string('column_name')->default('string_value');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('values');
    }
};
