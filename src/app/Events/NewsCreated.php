<?php

namespace App\Events;


use App\Models\News;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log as FacadesLog;

class NewsCreated
{
    use Dispatchable, SerializesModels;

    public News $news;

    /**
     * Create a new event instance.
     */
    public function __construct(News $news)
    {
        //
        $this->news = $news;
        FacadesLog::info('News created event fired');
    }

}
