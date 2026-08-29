<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $roleAssignmentsTable = config('permission.table_names.model_has_roles', 'model_has_roles');

        if (! Schema::hasTable($roleAssignmentsTable)) {
            return;
        }

        DB::table($roleAssignmentsTable)
            ->select('model_id', 'role_id')
            ->where('model_type', User::class)
            ->orderBy('role_id')
            ->get()
            ->unique('model_id')
            ->each(function (object $assignment): void {
                DB::table('users')
                    ->where('id', $assignment->model_id)
                    ->whereNull('role_id')
                    ->update(['role_id' => $assignment->role_id]);
            });
    }

    public function down(): void
    {
        // Nilai role_id dibiarkan agar rollback tidak menghapus data pengguna.
    }
};
