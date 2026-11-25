<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('permiso_rol', function (Blueprint $table) {
            $table->boolean('puede_visualizar')->default(false)->after('permiso_id');
            $table->boolean('puede_modificar')->default(false)->after('puede_visualizar');
        });
    }

    public function down(): void
    {
        Schema::table('permiso_rol', function (Blueprint $table) {
            $table->dropColumn(['puede_visualizar', 'puede_modificar']);
        });
    }
};
