<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Moja\MojaInterface;

class SMSController extends Controller
{
    protected $moja;
    public function __construct(MojaInterface $moja) 
    {
        $this->moja = $moja;
    }

    public function index() 
    {
        $smses = SMS::orderBy('id', 'desc')->get();

        return view('pages.index', [
            'smses' => $smses,
        ]);
    }

    public function sendSMS(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10',
            'message' => 'required',
        ]);

        $messageDetails = $this->moja->getToken()->sendSMS($request->input('message'), $request->input('phone'));

        $data = $request->only('phone', 'message');
        $data['sent_at'] = Carbon::now();
        $data['message_id'] = $messageDetails['data']['recipients'][0]['message_id'];

        SMS::create($data);

        return redirect()->back();
    }

    public function deliveryStatus(Request $request)
    {
        Log::info($request->all());
        $sms = SMS::where('message_id', $request->input('id'))->firstOrFail();
        $sms->update(['delivery_status' => $request->input('status'), 'sent_at' => $request->input('sent_at')]);
        
    }
}
