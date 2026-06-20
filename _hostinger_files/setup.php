<?php
/**
 * ⚠️  SETUP SCRIPT - HAPUS FILE INI SETELAH DIGUNAKAN!
 * Jalankan sekali via browser, lalu hapus untuk keamanan.
 */

// Simple password protection
$secret = $_GET['secret'] ?? '';
if ($secret !== 'vibecoding_setup_2024') {
    die('❌ Akses ditolak. Tambahkan ?secret=vibecoding_setup_2024 di URL');
}

define('LARAVEL_START', microtime(true));

// Path ke folder laravel (satu level di atas public_html)
$laravelPath = __DIR__ . '/../laravel';

// Boot Laravel
require $laravelPath . '/vendor/autoload.php';

$app = require_once $laravelPath . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo '<pre style="background:#1a1a2e;color:#00ff88;padding:20px;font-family:monospace;font-size:14px;">';
echo "🚀 Laravel Setup Script\n";
echo "========================\n\n";

$commands = [
    ['key:generate', ['--force' => true]],
    ['migrate',      ['--force' => true]],
    ['config:cache', []],
    ['route:cache',  []],
    ['view:cache',   []],
];

foreach ($commands as [$cmd, $args]) {
    $label = $cmd . ($args ? ' --force' : '');
    echo "⏳ Running: php artisan {$label}\n";

    try {
        $exitCode = $kernel->call($cmd, $args);

        if ($exitCode === 0) {
            echo "✅ Sukses: php artisan {$label}\n\n";
        } else {
            echo "⚠️  Exit code {$exitCode}: php artisan {$label}\n\n";
        }
    } catch (\Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n\n";
    }
}

// Fix storage permissions
$storagePaths = [
    $laravelPath . '/storage',
    $laravelPath . '/bootstrap/cache',
];

echo "⏳ Setting permissions (775) untuk storage & cache...\n";
foreach ($storagePaths as $path) {
    if (is_dir($path)) {
        chmod($path, 0775);
        // Recursive
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            chmod($item->getPathname(), $item->isDir() ? 0775 : 0664);
        }
    }
}
echo "✅ Permission selesai\n\n";

echo "========================\n";
echo "🎉 SETUP SELESAI!\n\n";
echo "⚠️  PENTING: HAPUS FILE INI SEKARANG!\n";
echo "   Pergi ke File Manager → hapus file setup.php\n";
echo '</pre>';
