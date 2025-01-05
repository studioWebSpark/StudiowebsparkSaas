<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamp('confirmed_at')->nullable();
            $table->string('token')->nullable(); // Pour la confirmation/désinscription
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletters');
    }
};
