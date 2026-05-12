<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hero;
use App\Models\Berita;
use App\Models\Sejarah;
use App\Models\KetuaUmum;
use App\Models\Sekila;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Setting;

class FixImagePaths extends Command
{
    protected $signature = 'fix:image-paths {--dry-run : Tampilkan perubahan tanpa menyimpan}';
    protected $description = 'Memperbaiki path gambar yang tersimpan sebagai URL lengkap menjadi path relatif';

    private int $fixedCount = 0;

    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('MODE DRY-RUN: Tidak ada perubahan yang akan disimpan');
            $this->newLine();
        }

        $this->info('Memperbaiki path gambar...');
        $this->newLine();

        // Daftar model dan kolom image yang akan diperbaiki
        $models = [
            ['model' => Hero::class, 'columns' => ['image']],
            ['model' => Berita::class, 'columns' => ['image']],
            ['model' => Sejarah::class, 'columns' => ['image', 'image_path']],
            ['model' => KetuaUmum::class, 'columns' => ['image', 'image_path']],
            ['model' => Sekila::class, 'columns' => ['image']],
            ['model' => Event::class, 'columns' => ['image']],
            ['model' => Gallery::class, 'columns' => ['image']],
            ['model' => Setting::class, 'columns' => ['site_logo', 'site_favicon']],
        ];

        foreach ($models as $item) {
            $this->fixModel($item['model'], $item['columns'], $isDryRun);
        }

        $this->newLine();
        if ($isDryRun) {
            $this->info("Total record yang akan diperbaiki: {$this->fixedCount}");
            $this->line('Jalankan tanpa --dry-run untuk menyimpan perubahan:');
            $this->line('  php artisan fix:image-paths');
        } else {
            $this->info("Total record yang berhasil diperbaiki: {$this->fixedCount}");
        }

        return 0;
    }

    private function fixModel(string $modelClass, array $columns, bool $isDryRun): void
    {
        $modelName = class_basename($modelClass);
        $records = $modelClass::all();
        $modelFixed = 0;

        foreach ($records as $record) {
            $updated = false;

            foreach ($columns as $column) {
                $value = $record->{$column};

                if (!empty($value) && $this->isLocalUploadUrl($value)) {
                    $relativePath = $this->extractRelativePath($value);

                    if ($isDryRun) {
                        $this->line("  [<fg=yellow>DRY-RUN</>] {$modelName} #{$record->id} -> {$column}: {$value} => {$relativePath}");
                    } else {
                        $record->{$column} = $relativePath;
                        $this->line("  [<fg=green>FIXED</>] {$modelName} #{$record->id} -> {$column}: {$relativePath}");
                    }

                    $updated = true;
                }
            }

            if ($updated) {
                if (!$isDryRun) {
                    $record->save();
                }
                $modelFixed++;
                $this->fixedCount++;
            }
        }

        if ($modelFixed > 0) {
            $this->info("{$modelName}: {$modelFixed} record ditemukan");
        }
    }

    private function isLocalUploadUrl(string $value): bool
    {
        // Hanya proses URL http/https yang path-nya mengandung uploads/ atau storage/
        if (!str_starts_with($value, 'http://') && !str_starts_with($value, 'https://')) {
            return false;
        }

        $parsed = parse_url($value);
        $path = $parsed['path'] ?? '';

        return str_contains($path, 'uploads/') || str_contains($path, 'storage/');
    }

    private function extractRelativePath(string $url): string
    {
        // Hapus base URL, sisakan hanya path relatif
        // Contoh: http://localhost:8000/uploads/heroes/image.jpg -> uploads/heroes/image.jpg
        $parsed = parse_url($url);
        $path = $parsed['path'] ?? '';

        // Hapus leading slash jika ada
        return ltrim($path, '/');
    }
}
