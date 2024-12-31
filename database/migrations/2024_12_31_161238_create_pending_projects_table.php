<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('pending_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('email');
            $table->json('form_data_step_1')->nullable();
            $table->json('form_data_step_2')->nullable();
            $table->json('form_data_step_3')->nullable();
            $table->json('form_data_step_4')->nullable();
            $table->integer('last_completed_step')->default(1);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pending_projects');
    }
}
