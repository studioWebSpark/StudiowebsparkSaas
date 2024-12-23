<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->string('siret')->nullable();

            $table->string('project_type');
            $table->string('budget');
            $table->string('deadline');
            $table->text('description');
            $table->json('selected_features');

            $table->integer('template_id');
            $table->json('template_details');

            $table->json('selected_options');
            $table->string('maintenance_plan')->nullable();

            $table->decimal('total_price', 10, 2);
            $table->decimal('monthly_maintenance', 10, 2)->nullable();

            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
