<?php
// Load Laravel environment
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->bootstrap();

echo "=== Laravel SMTP Configuration Debug ===\n\n";

// Check what mail config is actually loaded
$config = config('mail');
echo "MAIL_MAILER (default): " . ($config['default'] ?? 'NOT SET') . "\n";
echo "MAIL_SCHEME: " . ($config['mailers']['smtp']['scheme'] ?? 'NOT SET') . "\n";
echo "MAIL_HOST: " . ($config['mailers']['smtp']['host'] ?? 'NOT SET') . "\n";
echo "MAIL_PORT: " . ($config['mailers']['smtp']['port'] ?? 'NOT SET') . "\n";
echo "MAIL_ENCRYPTION: " . ($config['mailers']['smtp']['encryption'] ?? 'NOT SET') . "\n";
echo "MAIL_USERNAME: " . (strlen($config['mailers']['smtp']['username'] ?? '') > 0 ? '***SET***' : 'EMPTY/NOT SET') . "\n";
echo "MAIL_PASSWORD: " . (strlen($config['mailers']['smtp']['password'] ?? '') > 0 ? '***SET***' : 'EMPTY/NOT SET') . "\n";
echo "MAIL_TIMEOUT: " . ($config['mailers']['smtp']['timeout'] ?? 'DEFAULT') . "\n";
echo "MAIL_FROM_ADDRESS: " . ($config['from']['address'] ?? 'NOT SET') . "\n";

echo "\n=== Environment Variables ===\n";
echo "MAIL_MAILER env: " . (getenv('MAIL_MAILER') ?: 'NOT SET') . "\n";
echo "MAIL_HOST env: " . (getenv('MAIL_HOST') ?: 'NOT SET') . "\n";
echo "MAIL_PORT env: " . (getenv('MAIL_PORT') ?: 'NOT SET') . "\n";
echo "MAIL_ENCRYPTION env: " . (getenv('MAIL_ENCRYPTION') ?: 'NOT SET') . "\n";
echo "MAIL_USERNAME env: " . (getenv('MAIL_USERNAME') ? '***SET***' : 'EMPTY/NOT SET') . "\n";
echo "MAIL_PASSWORD env: " . (getenv('MAIL_PASSWORD') ? '***SET***' : 'EMPTY/NOT SET') . "\n";

echo "\n=== Testing SMTP Connection ===\n";

// Try to send a test email using Laravel Mail
try {
    echo "Attempting to use Mail::raw()...\n";
    
    // Use queue to avoid timeout
    Mail::raw('Test email from Railway', function($message) {
        $message->to('test@example.com')
                ->subject('SMTP Test from Railway');
    });
    
    echo "✓ Mail queued/sent successfully\n";
} catch (\Exception $e) {
    echo "✗ Mail Error: " . $e->getMessage() . "\n";
    echo "Class: " . get_class($e) . "\n";
    if (method_exists($e, 'getPrevious') && $e->getPrevious()) {
        echo "Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
}

echo "\n=== Direct Socket Test ===\n";

$host = config('mail.mailers.smtp.host');
$port = config('mail.mailers.smtp.port');
$timeout = 10;

echo "Connecting to $host:$port with {$timeout}s timeout...\n";
$start = microtime(true);
$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
$elapsed = microtime(true) - $start;

if ($fp) {
    echo "✓ Connected in {$elapsed}s\n";
    fclose($fp);
} else {
    echo "✗ Connection failed after {$elapsed}s: $errstr ($errno)\n";
}

