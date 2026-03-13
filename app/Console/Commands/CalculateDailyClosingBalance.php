<?php

namespace App\Console\Commands;

use App\Dao\DashboardDao;
use App\Models\ClosingBalance;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CalculateDailyClosingBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:calculate-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and store daily closing balance.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $dashboardDao = new DashboardDao();
            $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
            // Today closing balances
            [$incomeTotals, $expenseTotals, $todayOpeningBalance] = $dashboardDao->getTodayClosingBalance();

            // Calaculate closing balance
            $calculatedBalances = $this->calculateDailyBalances($incomeTotals, $expenseTotals, $todayOpeningBalance);

            //Prepare to update today closing balance
            $toUpdateClosingBalance = [
                'total_income_baht' => $calculatedBalances['total_income_baht'],
                'total_income_kyat' => $calculatedBalances['total_income_kyat'],
                'total_expense_baht' => $calculatedBalances['total_expense_baht'],
                'total_expense_kyat' => $calculatedBalances['total_expense_kyat'],
                'closing_balance_baht' => $calculatedBalances['closing_balance_baht'],
                'closing_balance_kyat' => $calculatedBalances['closing_balance_kyat'],
            ];

            //Prepare to create tomorrow opening balance
            $toCreateOpeningBalance = [
                'opening_balance_baht' => $calculatedBalances['closing_balance_baht'],
                'opening_balance_kyat' => $calculatedBalances['closing_balance_kyat'],
            ];

            // Create & Update table
            $dashboardDao->closeDailyTransaction($toUpdateClosingBalance, $toCreateOpeningBalance);

            $this->info('Daily closing balance for ' . $today->toDateString() . ' has been finalized.');
            $this->info('Opening balance for ' . $tomorrow->toDateString() . ' has been set.');
            Log::channel('job')->info('--- Success in creating closing balances for. '.Carbon::today()->format('Y-m-d H:i:s'));
            Log::channel('job')->info('--------------------------------------------------------------------------');
        } catch(Exception $exception) {
            Log::info('Error in creating closing balances. ' .$exception->getMessage());
        }
    }

    /**
     * Calculates the closing balances for the day.
     *
     * @param ?object $incomeTotals
     * @param ?object $expenseTotals
     * @param ?object $todayOpeningBalance
     * @return array
     */
    private function calculateDailyBalances(?object $incomeTotals, ?object $expenseTotals, ?object $todayOpeningBalance)
    {
        $todayTotalIncomeBaht = $incomeTotals?->totalIncomeInBaht ?? 0;
        $todayTotalIncomeKyat = $incomeTotals?->totalIncomeInKyat ?? 0;
        $todayTotalExpenseBaht = $expenseTotals?->totalExpenseInBaht ?? 0;
        $todayTotalExpenseKyat = $expenseTotals?->totalExpenseInKyat ?? 0;

        $closingBalanceBaht = ($todayOpeningBalance?->opening_balance_baht ?? 0) + $todayTotalIncomeBaht - $todayTotalExpenseBaht;
        $closingBalanceKyat = ($todayOpeningBalance?->opening_balance_kyat ?? 0) + $todayTotalIncomeKyat - $todayTotalExpenseKyat;

        Log::channel('job')->info('Daily Balance Calculated at : '.Carbon::today()->format('Y-m-d H:i:s'), [
            'today_total_income_baht' => $todayTotalIncomeBaht,
            'today_total_income_kyat' => $todayTotalIncomeKyat,
            'today_total_expense_baht' => $todayTotalExpenseBaht,
            'today_total_expense_kyat' => $todayTotalExpenseKyat,
            'closing_balance_baht' => $closingBalanceBaht,
            'closing_balance_kyat' => $closingBalanceKyat,
        ]);
        return [
            'closing_balance_baht' => $closingBalanceBaht,
            'closing_balance_kyat' => $closingBalanceKyat,
            'total_income_baht' => $todayTotalIncomeBaht,
            'total_income_kyat' => $todayTotalIncomeKyat,
            'total_expense_baht' => $todayTotalExpenseBaht,
            'total_expense_kyat' => $todayTotalExpenseKyat,
        ];
    }
}
