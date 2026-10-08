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
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('groom_photo')->nullable()->after('bride_name');
            $table->string('bride_photo')->nullable()->after('groom_photo');

            $table->string('groom_profile')->nullable()->after('bride_photo');
            $table->string('bride_profile')->nullable()->after('groom_profile');

            $table->string('love_story')->nullable()->after('bride_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['groom_photo', 'bride_photo', 'groom_profile', 'bride_profile', 'love_story']);
        });
    }
};
