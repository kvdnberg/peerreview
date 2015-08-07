<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Response;

class GitHubStatsController extends Controller
{

    public function index()
    {
        $stats = [];

        $today = new \DateTime();
        $today->modify('midnight');


        $thisweek = new \DateTime();
        $thisweek->modify('this week');
        $thisweek->modify('midnight');

        $lastweek = new \DateTime();
        $lastweek->modify('last week');
        $lastweek->modify('midnight');

        $stats['openPrCount'] = $this->countPullRequests('open');
        $stats['closedPrCountToday'] = $this->countPullRequests('closed', $today->format('c'));
        $stats['closedPrCountThisWeek'] = $this->countPullRequests('closed', $thisweek->format('c'));
        $stats['closedPrCountLastWeek'] = $this->countPullRequests('closed', $lastweek->format('c')) - $stats['closedPrCountThisWeek'];

        return view('PeerReview.GitHub.index', compact('stats'));
    }

    private function getRepositories($sort = '')
    {
        return GitHub::me()->repositories('private', 'updated', 'desc');
        return GitHub::organizations()->repositories('Netwerven', array('sort' => $sort, 'per_page' => 100));
    }

    private function countPullRequests($state = 'open', $since = '')
    {
        $page = 1;
        //Get the first page of results
        $pullRequestBatch = $this->getPullRequests($state, $since, $page);
        //Initiate the result array
        $pullRequests = [];

        //As long as the page has results, go to the next page and get more results
        while(count($pullRequestBatch) > 0) {
            $page++;
            $pullRequests = array_merge($pullRequests, $pullRequestBatch);
            $pullRequestBatch = $this->getPullRequests($state, $since, $page);
        }
        //final merge
        array_merge($pullRequests, $pullRequestBatch);

        return count($pullRequests);
    }

    private function getPullRequests($state = 'open', $since = '', $page = 1)
    {
        $PRs = GitHub::organizations()->issues('Netwerven', ['filter' => 'all', 'state' => $state, 'per_page' => 100, 'since' => $since], $page);

        $pullRequests = [];
        foreach($PRs as $PR) {
            if(array_key_exists('pull_request', $PR)) {
                $pullRequests[] = $PR;
            }
        }

        return $pullRequests;
    }

    public function sortedRepositoriesCall ($sort = 'updated')
    {
        $repositories = $this->getRepositories($sort);

        return Response::json($repositories);

    }


}
