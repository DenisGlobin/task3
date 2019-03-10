<?php

namespace App\Http\Controllers;

use App\Feeds;
use Illuminate\Http\Request;
use App\Feeds\FeedsClass as FeedsClass;

class FeedsController extends Controller
{
    public function __construct()
    {
        $simplePie = $this->parsingFeeds([
            'http://blog.case.edu/news/feed.atom',
            'http://tutorialslodge.com/feed'
        ], 5);
        $data = array(
            'items'     => $simplePie->get_items(),
        );
    }

    public function index()
    {

        $simplePie = $this->parsingFeeds([
            'http://blog.case.edu/news/feed.atom',
            'http://tutorialslodge.com/feed'
        ], 5);

        $items = $simplePie->get_items();
        $feedsData = array();
        foreach ($items as $item) {
            $feedsData['permalink'] = $item->get_link();
            $feedsData['title'] = $item->get_title();
            $feedsData['description'] = $item->get_description();
            $news = $this->saveFeedsInfo($feedsData);
        }
        $data = [
            'items' => $this->getFeeds(),
        ];
        return view('index', $data);
    }

    public function showNews($newsId)
    {
        $newsUrl = $this->getNewsUrl($newsId);
        $simplePie = $this->parsingFeeds($newsUrl);
        $data = array(
            'items'     => $simplePie->get_items(0, 1),
        );

        return view('news', $data);
    }

    private function parsingFeeds($feedUrl = [], $limit = 0)
    {
        $config = config('feeds');
        $feed = new FeedsClass($config);
        return $feed->make($feedUrl, $limit);
    }

    private function getNewsUrl($newsId = 0)
    {
        $news = Feeds::findOrFail($newsId);
        return $news->permalink;
    }

    private function saveFeedsInfo(array $data)
    {
        if (Feeds::where('permalink', $data['permalink'])) {
            return Feeds::where('permalink', $data['permalink'])->latest()->first();
        }
        return Feeds::create([
            'permalink' => $data['permalink'],
            'title' => $data['title'],
            'description' => $data['description'],
            'visited_by' => 0,
        ]);
    }

    private function getFeeds()
    {
        return Feeds::get();
    }
}
