<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DatabaseMigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_runs_all_migrations_successfully()
    {
        // Run all migrations
        Artisan::call('migrate');

        // Get the list of all migration files
        $migrations = $this->getAllMigrationFiles();

        // Assert that each migration file was executed successfully
        foreach ($migrations as $migration) {
            $this->assertTrue($this->migrationWasExecuted($migration), "Migration $migration was not executed successfully.");
        }
    }

    /**
     * Get the list of all migration files.
     *
     * @return array
     */
    private function getAllMigrationFiles()
    {
        $migrationPath = database_path('migrations');
        $migrationFiles = scandir($migrationPath);


        // Filter out non-migration files
        $migrationFiles = array_filter($migrationFiles, function ($file) {
            return strpos($file, '.php') !== false;
        });

        return $migrationFiles;
    }

    /**
     * Check if a migration file was executed successfully.
     *
     * @param string $migration
     * @return bool
     */
    private function migrationWasExecuted($migration)
    {
        $status = Artisan::call('migrate:status', ['--path' => 'database/migrations', '--no-interaction' => true]);

        $output = Artisan::output();

        return strpos($output, $migration) !== false && strpos($output, 'ran') !== false;
    }
}
