<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Expense;
use Illuminate\Console\Command;

class CheckIfExpenseDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expense-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if expenses are past due date and mark them as overdue';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $updated = Expense::where('status', Expense::NEW)
            ->whereDate('duedate', '<', now())
            ->update(['status' => Expense::DUEDATE]);

        $this->info("Marked {$updated} expense(s) as overdue.");
    }
}
