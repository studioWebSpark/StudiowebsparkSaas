<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Nouveaux champs pour le suivi
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('progress')->default(0);
            $table->json('milestones')->nullable();
            $table->text('current_step_description')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            // Le status existe déjà dans votre modèle
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn([
                'order_id',
                'progress',
                'milestones',
                'current_step_description',
                'started_at',
                'completed_at'
            ]);
        });
    }
};
