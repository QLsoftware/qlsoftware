<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Yangqi\Htmldom\Htmldom;
use Illuminate\Support\Facades\Log;

class curl extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $url;

    public function __construct($url)
    {
        //
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $html = new Htmldom($this->url);
            DB::table('article_recorded')->where(['href' => $this->url])->update(['context' => $html->innertext]);
            $html->clear();
        } catch (\Exception $e) {
            Log::info($this->url . '检索失败');
        }

    }
}
