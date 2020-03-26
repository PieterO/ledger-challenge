<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = new App\Transactions();
        $transaction->amount = 10.00;
        $transaction->time = '2020-03-12 10:00:00';
        $transaction->user_id = 1;
        $transaction->save();

        $transaction = new App\Transactions();
        $transaction->amount = -25.00;
        $transaction->time = '2020-03-12 10:05:00';
        $transaction->user_id = 1;
        $transaction->save();

        $transaction = new App\Transactions();
        $transaction->amount = 30000.00;
        $transaction->time = '2020-03-12 10:05:00';
        $transaction->user_id = 3;
        $transaction->save();
    }
}
