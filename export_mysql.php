<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$file = fopen('database_dump.sql', 'w');

fwrite($file, "SET FOREIGN_KEY_CHECKS=0;\n\n");

// Get all tables
$tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

foreach ($tables as $tableObj) {
    $table = $tableObj->name;
    
    // Get table schema from sqlite
    $schemaQuery = DB::selectOne("SELECT sql FROM sqlite_master WHERE type='table' AND name = ?", [$table]);
    if ($schemaQuery && $schemaQuery->sql) {
        $sql = $schemaQuery->sql;
        // Basic SQLite to MySQL schema conversion (very basic)
        $sql = str_replace('"' . $table . '"', '`' . $table . '`', $sql);
        $sql = preg_replace('/"([^"]+)"/', '`$1`', $sql); // replace double quotes with backticks
        $sql = str_ireplace(' autoincrement', ' AUTO_INCREMENT', $sql);
        $sql = preg_replace('/(integer)\s+primary\s+key\s+auto_increment/i', 'INT PRIMARY KEY AUTO_INCREMENT', $sql);
        // SQLite doesn't require lengths for VARCHAR, MySQL does
        $sql = preg_replace('/\bvarchar\b(?!\()/i', 'VARCHAR(255)', $sql);
        // Remove CHECK constraints (like enums) as they cause issues in basic MySQL imports
        $sql = preg_replace('/check\s*\([^)]+\)(?:\))?/i', '', $sql);
        $sql .= ";\n";
        
        fwrite($file, "DROP TABLE IF EXISTS `$table`;\n");
        fwrite($file, $sql . "\n");
    }

    // Export Data
    $rows = DB::table($table)->get();
    if ($rows->count() > 0) {
        foreach ($rows->chunk(100) as $chunk) {
            foreach ($chunk as $row) {
                $rowArray = (array)$row;
                $columns = implode(', ', array_map(function($col) { return "`$col`"; }, array_keys($rowArray)));
                $values = implode(', ', array_map(function($val) {
                    if (is_null($val)) return 'NULL';
                    return "'" . addslashes((string)$val) . "'";
                }, array_values($rowArray)));
                
                fwrite($file, "INSERT INTO `$table` ($columns) VALUES ($values);\n");
            }
        }
        fwrite($file, "\n");
    }
}

fwrite($file, "SET FOREIGN_KEY_CHECKS=1;\n");
fclose($file);

echo "Database dump generated at database_dump.sql\n";
