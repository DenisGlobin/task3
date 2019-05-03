<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeds\FeedsClass as FeedsClass;

class FeedsController extends Controller
{
    protected $simplePie;

    public function __construct()
    {
        $this->simplePie = $this->parsingFeeds([
            'http://blog.case.edu/news/feed.atom',
            'http://tutorialslodge.com/feed',
            'http://simplepie.org/blog/feed/',
            'http://feeds.tuaw.com/weblogsinc/tuaw',
        ]);
    }

    public function index($page = 0)
    {
        $itemPerPage = 5;
        $itemQuantity = $this->simplePie->get_item_quantity();
        $items = $this->simplePie->get_items($page, $itemPerPage);
        $data = [
            'items' => $items,
            'page' => $page,
            'feedsCount' => $itemQuantity,
        ];
        return view('index', $data);
    }

    public function showNews($feedId)
    {
        $items = $this->simplePie->get_items();
        foreach ($items as $item) {
            if ($item->get_id(true) == $feedId) {
                return view('news', ['item' => $item]);
            }
        }

        return redirect()->route('/');
    }

    private function parsingFeeds($feedUrl = [], $limit = 0)
    {
        $config = config('feeds');
        $feed = new FeedsClass($config);
        return $feed->make($feedUrl, $limit);
    }
}
