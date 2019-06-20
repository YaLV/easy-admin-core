<?php

namespace App\Console\Commands;

use App\EmailChange;
use App\Mail\SendChangeVerificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailChangeVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:changed {--request=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email, to verify new email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if (!$this->option('request')) {
            $requests = EmailChange::where('state', 'sent')->get();
            if(!$requests) {
                $this->error('There is no Email Change Requests');
                return false;
            }
            foreach($requests as $request) {
                Mail::to($request->changes['email'])->send(new SendChangeVerificationEmail($request));
            }
            $this->info("Emails Sent!");
        } else {
            $request = EmailChange::find($this->option('request'));

            if (!$request) {
                $this->error("Email Change request does not exist");
                return false;
            }

            Mail::to($request->changes['email'])->send(new SendChangeVerificationEmail($request));
            $this->info("Email Sent");
        }
        return true;
    }
}
