<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentTip extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['url'] = 'https://www.baidu.com';
        $data['title'] = 'Jason Tjhfsab dgasb';
        $data['content'] = 'dghasgdkb kjbdk  dahksd  ka dadk k ';
        return $this->from('luoxulx@live.com')
            ->markdown('emails.comment.tip', $data);
    }
}
