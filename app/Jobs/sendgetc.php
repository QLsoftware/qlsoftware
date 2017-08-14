<?php

namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class sendgetc
 * @package App\Jobs
 * 抢课邮件发送任务
 */
class sendgetc extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $kch;
    protected $kxh;
    protected $name;
    protected $status;

    public function __construct($email, $kch, $kxh, $name, $status)
    {
        $this->email = $email;
        $this->kch = $kch;
        $this->kxh = $kxh;
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        echo '邮件发送任务：';
        try {
            $flag = Mail::send('email.getc', ['name' => $this->name, 'kch' => $this->kch, 'kxh' => $this->kxh, 'status' => $this - status],
                function ($message) {
                    $message->to($this->email)->subject('智慧山大抢课通知');
                });
            if ($flag) {
                Log::info($this->email . '发送成功');
                echo '成功';
            } else {
                Log::info($this->email . '发送失败失败');
                echo '失败';
            }
        } catch (\Exception $exception) {
            Log::info($this->email . '发送失败失败');
        }
        sleep(10);
    }
}
