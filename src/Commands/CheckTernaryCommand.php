<?php

namespace Checkternary\CheckTernary\Commands;

use Checkternary\CheckTernary\CheckTernary;
use Illuminate\Console\Command;

/**
 * Summary of CheckTernaryCommand
 */
class CheckTernaryCommand extends Command
{
    protected $signature = 'checkternary:analyse';

    protected $description = 'Check ternary analyse';

    public function handle()
    {
        $checker = new CheckTernary();
        $output = $checker->checkTernaryConditionsInFiles(
            config('checkternary.folderPaths'),
            config('checkternary.ignoredFolders')
        );

        $this->info($output);

        return self::SUCCESS;
    }
}
