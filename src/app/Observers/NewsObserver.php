<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Facades\Log;

class NewsObserver
{
    public function updating(News $news)
    {
        Log::info('Updating news' . $news);
    }

}
