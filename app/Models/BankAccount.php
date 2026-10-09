<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class BankAccount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getAccounts(): Collection
    {
        try {
            if (Schema::hasTable('bank_accounts')) {
                $accounts = self::orderBy('order')->get();
                if ($accounts->isNotEmpty()) {
                    return $accounts;
                }
            }
        } catch (Throwable $e) {
            // Fallback
        }

        return self::defaultAccounts();
    }

    public static function defaultAccounts(): Collection
    {
        $bca = new self;
        $bca->forceFill([
            'id' => 1,
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_holder' => 'Habib Yulianto',
            'qris_image' => null,
            'order' => 1,
        ]);

        $mandiri = new self;
        $mandiri->forceFill([
            'id' => 2,
            'bank_name' => 'MANDIRI',
            'account_number' => '9876543210123',
            'account_holder' => 'Adiba Putri Syakila',
            'qris_image' => null,
            'order' => 2,
        ]);

        return new Collection([$bca, $mandiri]);
    }
}
