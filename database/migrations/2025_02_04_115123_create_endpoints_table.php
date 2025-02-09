<?php

use App\Enums\EndPointFrequency;
use App\Enums\EndpointFrequency as EnumsEndpointFrequency;
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
        Schema::create('endpoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->onDelete('cascade');
            $table->string('location');
            $table->unsignedInteger('frequency')->default(EnumsEndpointFrequency::FIVE_MINUTES->value); //now() + 60
            $table->timestamp('next_check');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endpoints');
    }
};
