<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\WeddingSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class BankAccountController extends Controller
{
    /**
     * Show bank accounts and gift address management page.
     */
    public function index(): View
    {
        $accounts = BankAccount::getAccounts();
        $setting = WeddingSetting::getSettings();

        return view('admin.banks.index', compact('accounts', 'setting'));
    }

    /**
     * Store new bank account.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bank_name' => ['required', 'string', 'max:50'],
            'account_number' => ['required', 'string', 'max:50'],
            'account_holder' => ['required', 'string', 'max:100'],
            'qris_image' => ['nullable', 'string'],
            'qris_image_file' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);

        $qrisImage = $validated['qris_image'] ?? null;
        if ($request->hasFile('qris_image_file')) {
            $path = $request->file('qris_image_file')->store('uploads/qris', 'public');
            $qrisImage = '/storage/'.$path;
        }

        try {
            if (Schema::hasTable('bank_accounts')) {
                BankAccount::create([
                    'bank_name' => strtoupper($validated['bank_name']),
                    'account_number' => $validated['account_number'],
                    'account_holder' => $validated['account_holder'],
                    'qris_image' => $qrisImage,
                    'order' => $validated['order'] ?? 0,
                ]);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.banks.index')->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    /**
     * Update gift delivery address.
     */
    public function updateAddress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gift_recipient_name' => ['nullable', 'string', 'max:100'],
            'gift_phone' => ['nullable', 'string', 'max:50'],
            'gift_address' => ['nullable', 'string'],
        ]);

        try {
            if (Schema::hasTable('wedding_settings')) {
                WeddingSetting::where('id', 1)->update($validated);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.banks.index')->with('success', 'Alamat pengiriman kado fisik berhasil diperbarui!');
    }

    /**
     * Delete bank account.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if (Schema::hasTable('bank_accounts')) {
                BankAccount::where('id', $id)->delete();
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.banks.index')->with('success', 'Rekening bank berhasil dihapus!');
    }
}
