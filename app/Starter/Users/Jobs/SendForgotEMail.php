<?php

namespace App\Starter\Users\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendForgotEMail implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $row;
    public $password;

    public function __construct($row, $password) {
        $this->row = $row;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        try {
            $row = $this->row;
            \Mail::send('emails.auth.forgot', ['row' => $row, 'password' => $this->password], function ($mail) use ($row) {
                $subject = trans('email.Reset password') . " - " . appName();
                $mail->to($row->email, $row->name)
                        ->subject($subject);
            });
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

}
