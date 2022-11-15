<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send_message(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' =>
                array(
                    'required',
                    'regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'
                ),
            'subject' => 'required',
            'message' => 'required'
        ]);
        Contact::create($request->all());
        return redirect()->back()->with('success','تم ارسال رسالتك الى الادارة');
    }
}