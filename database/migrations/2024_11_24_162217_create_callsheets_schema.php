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
        Schema::create('callsheets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('instructions')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->float('latitud')->nullable();
            $table->float('longitud')->nullable();
            $table->foreignId('id_provincia')->nullable()->constrained('provincias');
            $table->foreignId('id_canton')->nullable()->constrained('cantones');
            $table->foreignId('id_parroquia')->nullable()->constrained('parroquias');
        });

        Schema::create('callsheets_cast', function (Blueprint $table) {
            $table->id();
            $table->foreignId('callsheet_id')->constrained('callsheets')->onDelete('cascade');
            $table->foreignId('project_role_assignment_id')->constrained('projects_roles_assignments')->onDelete('cascade'); //esta foreighkey se camio
            $table->timestamps();
            $table->string('instructions');
        });

        Schema::create('callsheets_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('start_hour');
            $table->float('stimated_hours');
            $table->enum('status', ['pending', 'resolved']);
            $table->string('description');
            $table->foreignId('callsheet_id')->constrained('callsheets')->onDelete('cascade');
        });


        Schema::create('event_cast', function (Blueprint $table) {
            $table->id();
            $table->foreignId('callsheet_cast_id')->constrained('callsheets_cast')->onDelete('cascade');
            $table->foreignId('callsheet_event_id')->constrained('callsheets_events')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('event_resolution', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('event_id')->constrained('callsheets_events')->onDelete('cascade');
            $table->float('taked_time');
        });
    }

    public function down(): void
    {
        // Orden correcto de eliminación de tablas
        Schema::dropIfExists('event_cast');
        Schema::dropIfExists('event_resolution');
        Schema::dropIfExists('callsheets_events');
        Schema::dropIfExists('callsheets_cast');
        Schema::dropIfExists('callsheets');
    }
};
