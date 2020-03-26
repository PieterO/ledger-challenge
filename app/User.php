<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'overdraftLimit' => 250.00,
    ];

    public function getBalanceAttribute(): float
    {
        return Transactions::where('user_id', $this->id)->sum('amount');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the transactions associated with the user.
     */
    public function transactions()
    {
        return $this->hasMany('App\Transactions');
    }

    /**
     * Used to add an opening transaction
     * @TODO figure out how to apply this to only new accounts, this will probably add a transaction on updating details
     */
    public function save(array $options = [])
    {
        parent::save();
        $t = new Transactions();
        $t->amount = 2000.00;
        $t->user_id = $this->id;
        $t->time = now();
        $t->save();
    }

    public function isOverSavingsThreshold(): bool
    {
        if ($this->getBalanceAttribute() > 4000.00)
        {
            return true;
        }
        return false;
    }

    public function isInOverdraft(): bool
    {
        if ($this->getBalanceAttribute() < 0 && abs($this->getBalanceAttribute()) < $this->overdraftLimit)
        {
            return true;
        }
        return false;
    }

    public function isInUnplannedOverdraft(): bool
    {
        if ($this->getBalanceAttribute() < 0 && abs($this->getBalanceAttribute()) > $this->overdraftLimit)
        {
            Log::alert('user is outside our overdraft limit, this will need fixing urgently.');
            return true;
        }
        return false;
    }
}
