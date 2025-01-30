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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->enum('gender',['male','female']);
            $table->string('email',255)->nullable();
            $table->string('phone_number',15)->nullable();
            $table->string('identity_card_number',50);
            $table->string('address',255)->null;
            $table->foreignId('nationalities_id')->constrained('nationalities');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
