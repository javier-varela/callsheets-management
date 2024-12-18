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
            $table->id()->autoIncrement();
            $table->timestamps();
            $table->string("title");
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        }); //

        Schema::create('projects_invitations', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->timestamps();
            $table->enum('status', ['none', 'accepted', 'declined'])->default('none');

            $table->foreignId('project_id')->constrained("projects")->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('invited_id')->constrained('users')->references("id")->onDelete('cascade');
        }); //



        // Roles Table
        Schema::create('projects_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->index('name', 'name_index');
        }); //

        // Assignments Table
        Schema::create('projects_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nick_name')->nullable()->index('pa_nick_name');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        }); //

        Schema::create('projects_roles_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('project_assignment_id')->constrained('projects_assignments')->onDelete('cascade');
            $table->foreignId('project_role_id')->constrained('projects_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_roles_assignments');
        Schema::dropIfExists('projects_assignments');
        Schema::dropIfExists('projects_roles');
        Schema::dropIfExists('projects_admins');
        Schema::dropIfExists('projects_invitations');
        Schema::dropIfExists('projects');
    }
};
