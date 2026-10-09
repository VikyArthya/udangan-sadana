<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Show guest WhatsApp link generator.
     */
    public function index(Request $request): View
    {
        $setting = WeddingSetting::getSettings();
        $guestName = $request->input('guest_name');
        $guestPhone = $request->input('guest_phone');

        $generatedLink = null;
        $generatedMessage = null;
        $whatsappUrl = null;

        if ($guestName) {
            $baseUrl = url('/');
            $generatedLink = $baseUrl.'?to='.urlencode(trim($guestName));

            $groomNick = $setting->groom_nickname ?? 'Habib';
            $brideNick = $setting->bride_nickname ?? 'Adiba';

            $generatedMessage = 'Kepada Yth. Bapak/Ibu/Saudara/i *'.trim($guestName)."*,\n\n"
                ."Tanpa mengurangi rasa hormat, perkenankan kami mengundang Anda untuk hadir dan memberikan doa restu pada acara pernikahan kami:\n\n"
                .'*'.$groomNick.' & '.$brideNick."*\n\n"
                ."Detail acara dan lokasi dapat dilihat melalui tautan undangan elektronik berikut:\n"
                .$generatedLink."\n\n"
                ."Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.\n\n"
                ."Terima kasih atas doa dan perhatiannya.\n"
                ."Kami yang berbahagia,\n"
                .'*'.$groomNick.' & '.$brideNick.'*';

            $cleanPhone = preg_replace('/[^0-9]/', '', (string) $guestPhone);
            if (str_starts_with($cleanPhone, '0')) {
                $cleanPhone = '62'.substr($cleanPhone, 1);
            }

            if ($cleanPhone) {
                $whatsappUrl = 'https://api.whatsapp.com/send?phone='.$cleanPhone.'&text='.urlencode($generatedMessage);
            } else {
                $whatsappUrl = 'https://api.whatsapp.com/send?text='.urlencode($generatedMessage);
            }
        }

        return view('admin.guests.index', compact('setting', 'guestName', 'guestPhone', 'generatedLink', 'generatedMessage', 'whatsappUrl'));
    }
}
