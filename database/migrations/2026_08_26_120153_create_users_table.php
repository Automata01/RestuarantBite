
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone', 30)
                ->nullable()
                ->after('name');

            $table->string('number', 50)
                ->nullable()
                ->unique()
                ->after('phone');

            $table->enum('role', [
                'client',
                'admin'
            ])
                ->default('client')
                ->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropUnique([
                'number'
            ]);

            $table->dropColumn([
                'phone',
                'number',
                'role'
            ]);
        });
    }
};