<?php

namespace PeerReview\Http\Controllers;

use Illuminate\Http\Request;
use PeerReview\Developer;
use PeerReview\PeerReview;

use PeerReview\Http\Requests;
use PeerReview\Http\Controllers\Controller;

class PeerReviewController extends Controller
{
    public function index()
    {
        $developers = Developer::all();

        foreach($developers as $developer) {
            $type = $developer->developerType()->first();
            $bla = 'foo';
        }
        return view('PeerReview.index', compact('developers'));
    }
}
