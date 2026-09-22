<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database using credentials from .env';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        
        $backupFileName = 'backup-' . $database . '-' . date('Y-m-d-H-i-s') . '.sql';
        $backupPath = storage_path('app/backups/' . $backupFileName);
        
        // Create backups directory if it doesn't exist
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        $command = sprintf(
            'mysqldump -h %s -P %s -u %s -p"%s" %s > %s',
            $host,
            $port,
            $username,
            $password,
            $database,
            $backupPath
        );

        $this->info('Starting database backup...');
        
        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('Database backup completed successfully!');
        $this->info('Backup saved to: ' . $backupPath);
        
        return Command::SUCCESS;
    }
}