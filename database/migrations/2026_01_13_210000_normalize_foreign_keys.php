<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $relations = [
            // table, column, referenced table, referenced column, onDelete, onUpdate
            ['users','role_id','roles','id','SET NULL','CASCADE'],
            ['territorios','region_id','regiones','id','CASCADE','CASCADE'],
            ['municipios','estado_id','estados','id','CASCADE','CASCADE'],
            ['rutas','territorio_id','territorios','id','CASCADE','CASCADE'],
            ['cacs','ruta_id','rutas','id','CASCADE','CASCADE'],
            ['cacs','municipio_id','municipios','id','CASCADE','CASCADE'],
            ['cacs','representante_id','users','id','SET NULL','CASCADE'],
            ['sembradores','user_id','users','id','SET NULL','CASCADE'],
            ['sembradores','cac_id','cacs','id','CASCADE','CASCADE'],
            ['sembradores','subrol_id','subroles','id','SET NULL','CASCADE'],
            ['cosechas','sembrador_id','sembradores','id','CASCADE','CASCADE'],
            ['cosechas','cultivo_id','cultivos','id','CASCADE','CASCADE'],
            ['cosecha_fechas','cosecha_id','cosechas','id','CASCADE','CASCADE'],
            ['disponibilidades','cosecha_id','cosechas','id','CASCADE','CASCADE'],
            ['semiprocesados','cac_id','cacs','id','CASCADE','CASCADE'],
            ['tianguis','municipio_id','municipios','id','CASCADE','CASCADE'],
            ['tianguis_productos','tianguis_id','tianguis','id','CASCADE','CASCADE'],
            ['tianguis_productos','cultivo_id','cultivos','id','CASCADE','CASCADE'],
            ['subroles','role_id','roles','id','CASCADE','CASCADE'],
        ];

        foreach ($relations as $r) {
            [$table, $column, $refTable, $refCol, $onDelete, $onUpdate] = $r;

            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
                continue;
            }

            // Find existing FK constraint for this column
            $existing = DB::select(
                'SELECT constraint_name AS name FROM information_schema.KEY_COLUMN_USAGE WHERE constraint_schema=DATABASE() AND table_name = ? AND column_name = ? AND referenced_table_name IS NOT NULL',
                [$table, $column]
            );

            if (count($existing) > 0) {
                $cname = $existing[0]->name;
                try {
                    DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$cname}`");
                } catch (\Exception $e) {
                    // ignore drop errors
                }
            }

            $newName = $table.'_'.$column.'_foreign';
            $sql = "ALTER TABLE `{$table}` ADD CONSTRAINT `{$newName}` FOREIGN KEY (`{$column}`) REFERENCES `{$refTable}`(`{$refCol}`) ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = [
            ['cacs','representante_id'],
            ['sembradores','user_id'],
            ['users','role_id'],
            ['territorios','region_id'],
            ['municipios','estado_id'],
            ['rutas','territorio_id'],
            ['cacs','ruta_id'],
            ['cacs','municipio_id'],
            ['sembradores','cac_id'],
            ['sembradores','subrol_id'],
            ['cosechas','sembrador_id'],
            ['cosechas','cultivo_id'],
            ['cosecha_fechas','cosecha_id'],
            ['disponibilidades','cosecha_id'],
            ['semiprocesados','cac_id'],
            ['tianguis','municipio_id'],
            ['tianguis_productos','tianguis_id'],
            ['tianguis_productos','cultivo_id'],
            ['subroles','role_id'],
        ];

        foreach ($columns as $c) {
            [$table, $column] = $c;
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
                continue;
            }

            $existing = DB::select(
                'SELECT constraint_name AS name FROM information_schema.KEY_COLUMN_USAGE WHERE constraint_schema=DATABASE() AND table_name = ? AND column_name = ? AND referenced_table_name IS NOT NULL',
                [$table, $column]
            );

            if (count($existing) > 0) {
                $cname = $existing[0]->name;
                try {
                    DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$cname}`");
                } catch (\Exception $e) {
                    // ignore
                }
            }
        }
    }
};
