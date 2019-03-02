<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeds\Feeds as Feeds;

class FeedsController extends Controller
{
    public function index()
    {

        $config = config('feeds');
        $feed = new Feeds($config);
        $simplePie = $feed->make([
            'http://blog.case.edu/news/feed.atom',
            'http://tutorialslodge.com/feed'
        ], 5);
        $data = array(
            'title'     => $simplePie->get_title(),
            'permalink' => $simplePie->get_permalink(),
            'items'     => $simplePie->get_items(),
        );

        return view('index', $data);
    }
}
