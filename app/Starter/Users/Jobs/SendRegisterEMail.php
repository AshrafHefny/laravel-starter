<?php

namespace App\Starter\Users\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRegisterEMail implements ShouldQueue {

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

    public function __construct($row) {
        $this->row = $row;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        try {
            $row = $this->row;
            \Mail::send('emails.auth.register', ['row' => $row], function ($mail) use ($row) {
                $subject = trans('email.Welcome to') . " - " . appName();
                $mail->to($row->email, $row->name)
                        ->subject($subject);
            });
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

}
