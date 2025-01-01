<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->string('stripe_session_id');
            $table->timestamp('paid_at')->nullable();

            // Informations client
            $table->string('client_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('activity')->nullable();
            $table->string('company_name')->nullable();
            $table->string('siren')->nullable();

            // Informations projet
            $table->string('project_type');
            $table->text('project_description');
            $table->json('selected_features');

            // Forfait et options
            $table->string('selected_forfait');
            $table->decimal('forfait_price', 10, 2);
            $table->json('selected_options')->nullable();
            $table->string('maintenance_plan')->nullable();

            // Template
            $table->string('template_name')->nullable();
            $table->json('template_details')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
