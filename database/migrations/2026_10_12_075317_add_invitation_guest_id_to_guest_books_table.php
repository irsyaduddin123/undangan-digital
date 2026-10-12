
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->foreignId('invitation_guest_id')
                ->nullable()
                ->after('invitation_id')
                ->constrained('invitation_guests')
                ->cascadeOnDelete();

            $table->unique('invitation_guest_id');
        });
    }

    public function down(): void
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->dropForeign(['invitation_guest_id']);
            $table->dropUnique(['invitation_guest_id']);
            $table->dropColumn('invitation_guest_id');
        });
    }
};
