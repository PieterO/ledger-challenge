<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public function getTypeAttribute(): string
    {
        if ($this->amount < 0) {
            return 'Withdrawal';
        }
        return 'Deposit';
    }
}
