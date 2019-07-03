<?php

namespace App\Http\Controllers;

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

    /**
     * Get the news list
     *
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $page = 0)
    {
        $itemPerPage = 5;
        $itemQuantity = $this->simplePie->get_item_quantity();
        $items = $this->simplePie->get_items($page, $itemPerPage);
        $newsData = array();
        foreach ($items as $item) {
            $hashID = $item->get_id(true);
            $newsData[$hashID]['id'] = $hashID;
            $newsData[$hashID]['title'] = $item->get_title();
            $newsData[$hashID]['descr'] = $item->get_description();
            $newsData[$hashID]['date'] = $item->get_date('j F Y | g:i a');
            $mySqlCache = new \MySimplePie_Cache_MySQL($this->simplePie->cache_location, $hashID, 'spc');
            $newsData[$hashID]['visited'] = $mySqlCache->getReaderCount($item->get_id());
        }
        $data = [
            'items' => $newsData,
            'page' => $page,
            'feedsCount' => $itemQuantity,
        ];
        return view('index', $data);
    }

    /**
     * Get the news
     *
     * @param string $feedId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showNews(string $feedId)
    {
        $items = $this->simplePie->get_items();
        foreach ($items as $item) {
            if ($item->get_id(true) == $feedId) {
                $id = $item->get_id();
                $mySqlCache = new \MySimplePie_Cache_MySQL($this->simplePie->cache_location, $feedId, 'spc');
                $visited = $mySqlCache->getReaderCount($id);
                $visited++;
                $mySqlCache->countNewReader($id, $visited);
                return view('news', ['item' => $item, 'visited' => $visited]);
            }
        }
        return redirect()->route('/');
    }

    /**
     * Parsing feed from url
     *
     * @param array $feedUrl
     * @param int $limit
     * @return \SimplePie
     */
    private function parsingFeeds($feedUrl = [], $limit = 0)
    {
        $config = config('feeds');
        $feed = new FeedsClass($config);
        return $feed->make($feedUrl, $limit);
    }
}
