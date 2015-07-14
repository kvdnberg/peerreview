<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubStatsController extends Controller
{

    public function index()
    {
        $stats = [];

        $repos = $this->getRepositories();

        if (is_array($repos)) {
            $stats['openPrCount'] = $this->countPullRequests($repos);
        }

        return view('PeerReview.GitHub.index', compact('stats'));
    }

    private function getRepositories()
    {
        return GitHub::organizations()->repositories('Netwerven');
    }

    private function countPullRequests($repositories = [], $open = true)
    {
        $pr = 0;
        foreach ($repositories as $repository) {
            $PRs = GitHub::pull_requests()->all('Netwerven', $repository['name']);
            $pr = $pr + count($PRs);
        }

        return $pr;
    }


}
