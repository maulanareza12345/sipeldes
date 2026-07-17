<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$columns = Illuminate\Support\Facades\DB::select('SHOW COLUMNS FROM users');
$rows = Illuminate\Support\Facades\DB::table('users')->get();

echo "COLUMNS\n";
foreach ($columns as $column) {
    echo $column->Field . "\t" . $column->Type . "\n";
}

echo "\nROWS\n";
foreach ($rows as $row) {
    echo json_encode($row, JSON_UNESCAPED_SLASHES) . "\n";
}
