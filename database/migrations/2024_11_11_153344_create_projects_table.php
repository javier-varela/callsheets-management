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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps("created_at");
            $table->string("title");
            $table->timestamp("last_updated");

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        Schema::create('projects_invitations', function (Blueprint $table) {
            $table->id();
            $table->timestamp("created_at");
            $table->enum('status', ['none', 'accepted', 'declined'])->default('none');

            $table->foreignId('project_id')->constrained("projects")->onDelete('cascade');

            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('projects_invitations');
    }
};
