<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Repositories\Contracts\AuthContract;

use App\Models\News;


class NewsComposer
{
    public $news;


    public function __construct()
    {
        // $this->news = $news;
    }
    
    /**
     * Bind data to the view.
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {

        // Newsテーブルからreco_flgが1のものを2件取得する
        $news = News::where('reco_flg', 1)->orderBy('created_at', 'desc')->take(2)->get();

        $view->with('top_news', $news);
    }
}