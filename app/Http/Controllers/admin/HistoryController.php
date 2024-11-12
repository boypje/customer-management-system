<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $number = DB::connection('mysql')
            ->table('device')
            ->where('number', '628819810368')
            ->value('number');

        $formattedNumber = $number . '@s.whatsapp.net';
        
        $conversations = DB::connection('mysql2')
            ->table('chat')
            ->select(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(messages, '$[0].message.message.conversation')) AS conversation"))
            ->where(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(messages, '$[0].message.userReceipt[0].userJid'))"), '=', $formattedNumber)
            ->orWhere(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(messages, '$[0].message.userReceipt[1].userJid'))"), '=', $formattedNumber)
            ->where(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(messages, '$[0].message.key.fromMe'))"), '=', 'true')
            ->get();
 
        dd($conversations);
    }

}
