<?php

namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class Sendemail
 * @package App\Jobs
 * 通知邮件发送任务
 */
class Sendemail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $title;
    protected $name;
    protected $link;
    protected $from;
    protected $data;

    public function __construct($email, $title, $name, $link, $from, $data)
    {
        $this->email = $email;
        $this->title = $title;
        $this->name = $name;
        $this->link = $link;
        $this->from = $from;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    private $id = 0;

    public function handle()
    {
        echo '邮件发送任务：';
//        try {
        $flag = Mail::send('email.notification', ['name' => $this->name, 'link' => $this->link, 'from' => $this->from, 'data' => $this->data, 'title' => $this->title],
            function ($message) {
                $message->to($this->email)->subject('智慧山大通知邮件');
            });
        if ($flag) {
            Log::info($this->email . '发送成功');
            echo '成功';
        } else {
            Log::info($this->email . '发送失败失败');
            echo '失败';
        }
//        } catch (\Exception $exception) {
//            Log::info($this->email . '发送失败失败');
//        }
        sleep(10);
    }
}
