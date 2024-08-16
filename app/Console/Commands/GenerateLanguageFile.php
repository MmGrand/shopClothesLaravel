<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class GenerateLanguageFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:generate {language}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерация нового json файла с ключами для реализации перевода на указанный язык';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $language = $this->argument('language');
        $sourceLang = 'ru'; // Основной файл, на основе которого создаются ключи
        $sourcePath = base_path("lang/{$sourceLang}.json");
        $targetPath = base_path("lang/{$language}.json");

        if (!File::exists($sourcePath)) {
            $this->error("Путь к файлу ({$sourceLang}.json) не существует.");
            return;
        }

        $sourceContent = json_decode(File::get($sourcePath), true);

        $newContent = [];
        foreach ($sourceContent as $key => $value) {
            $newContent[$key] = '';
        }

        File::put($targetPath, json_encode($newContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $this->info("Языковой файл для '{$language}' был создан в {$targetPath}");
    }
}
