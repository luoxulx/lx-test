<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/11
 * Time: 下午11:59
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;


class InviteUserNotification extends Notification
{
    use Queueable;
    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('这是您的邀请函...')
            ->greeting('您被邀请加入 :app_name 状态页。')
            ->action('接受', 'https://www.baidu.com/')
            ->line('您已被邀请加入 :app_name 状态页。');
    }
}
