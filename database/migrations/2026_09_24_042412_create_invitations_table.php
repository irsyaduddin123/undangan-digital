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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('template_id')
                ->constrained('templates')
                ->cascadeOnDelete();

            $table->string('slug')->unique();

            $table->string('groom_name');
            $table->string('bride_name');

            $table->dateTime('wedding_date')->nullable();
            $table->dateTime('akad_date')->nullable();
            $table->dateTime('reception_date')->nullable();

            $table->string('location_name')->nullable();
            $table->text('address')->nullable();
            $table->text('google_maps')->nullable();
            
            $table->string('cover_image')->nullable();
            $table->string('music')->nullable();

            $table->enum('status', [
                'draft',
                'active',
                'expired'
            ])->default('draft');

            $table->timestamp('expired_at')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->index('template_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
