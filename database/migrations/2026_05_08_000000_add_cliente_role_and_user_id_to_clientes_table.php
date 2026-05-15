<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE users MODIFY cargo ENUM('barbeiro', 'administrador', 'cliente') NOT NULL DEFAULT 'cliente'");
        }

        Schema::table('clientes', function (Blueprint $table) {
            if (! Schema::hasColumn('clientes', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->unique()
                    ->after('id')
                    ->constrained()
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (Schema::hasColumn('clientes', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });

        if (DB::connection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE users MODIFY cargo ENUM('barbeiro', 'administrador') NOT NULL DEFAULT 'barbeiro'");
        }
    }
};
