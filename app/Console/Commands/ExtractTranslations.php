<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\File;

class ExtractTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:extract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выборка всех транскрипций в JSON перевода';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = resource_path();
        $files = $this->getPhpFiles($path);

        $translations = [];

        foreach ($files as $file) {
            $content = File::get($file);
            preg_match_all("/__\(['\"](.+?)['\"]\)/", $content, $matches);

            foreach ($matches[1] as $string) {
                $translations[$string] = $string;
            }
        }

        $this->writeToJson($translations);
        $this->info('Выборка транскрипций завершена!');
    }

    private function getPhpFiles($path)
    {
        $dir = new RecursiveDirectoryIterator($path);
        $iterator = new RecursiveIteratorIterator($dir);

        // Используем массив для хранения найденных файлов
        $files = [];

        // Проходим по каждому элементу итератора
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/\.blade\.php$/i', $file->getFilename())) {
                $files[] = $file->getRealPath();
            }
        }

        return $files;
    }

    private function writeToJson($translations)
    {
        $langPath = base_path('lang/ru.json'); // Замените на нужный язык
        $existingTranslations = [];

        if (File::exists($langPath)) {
            $existingTranslations = json_decode(File::get($langPath), true);
        }

        $translations = array_merge($existingTranslations, $translations);
        File::put($langPath, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
