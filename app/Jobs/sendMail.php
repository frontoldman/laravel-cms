<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Mail\Mailer;

class sendMail extends Job implements SelfHandling
{

    /**
     * @var user
     */
    protected $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {

        $data = [
            'title'  => trans('这是一封验证邮件'),
            'intro'  => trans('邮件内容是验证码'),
            'link'   => trans('点击链接验证吧，孩子们'),
            'confirm_code' => $this->user->confirm_code
        ];

        $mailer->send('emails.auth.verify', $data, function($message) {
            $message->to($this->user->email, 'daranran')
                ->subject(trans('这是一封验证邮件'));
        });
    }
}
