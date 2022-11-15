<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendingDailyPosReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $shift;
    protected $shift_report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$shift,$shift_report)
    {
        $this->data = $data;
        $this->shift = $shift;
        $this->shift_report = $shift_report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('تقرير الشيفت / الوردية الموضحة بياناته')
            ->view('client.emails.daily_pos_report')
            ->with(['data' => $this->data , 'shift' => $this->shift , 'shift_report' => $this->shift_report]);
        return $email;
    }
}

?>
