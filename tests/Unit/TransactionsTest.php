<?php

namespace Tests;

use App\Transactions;

use PHPUnit\Framework\TestCase;

class TransactionsTest extends TestCase
{
    public function testWithdrawalType()
    {
        $sut = new Transactions();
        $sut->amount = 10.12;

        $result = $sut->getTypeAttribute();

        $this->assertEquals('Deposit', $result);
    }

    public function testDepositType()
    {
        $sut = new Transactions();
        $sut->amount = -55.21;

        $result = $sut->getTypeAttribute();

        $this->assertEquals('Withdrawal', $result);
    }
}
