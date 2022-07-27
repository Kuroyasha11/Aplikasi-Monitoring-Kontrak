<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BirthDayWish;
use App\Models\Contract;
use Illuminate\Support\Facades\Log;

class AutoBirthDayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:birthdaywith';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contracts = Contract::whereDay('tglkonfirmasi', date('d'))
            ->whereMonth('tglkonfirmasi', date('m'))
            ->whereYear('tglkonfirmasi', date('Y'))
            ->get();

        Log::info($contracts);

        if ($contracts->count() > 0) {
            foreach ($contracts as $contract) {
                Mail::to($contract->author->email)->send(new BirthDayWish($contract->author->email));
            }
        }
        return 0;
    }
}
