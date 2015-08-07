<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function getBoardDevelopersAttribute()
    {
        $boardDevelopers = [];
        $board = $this->board;
        $board = json_decode($board);
        if($board) {
            foreach ($board as $index => $developers) {
                if(property_exists($developers, 'author')) {
                    $boardDevelopers['author'][$index] = Developer::find($developers->author);
                }
                if(property_exists($developers, 'reviewer')) {
                    $boardDevelopers['reviewer'][$index] = Developer::find($developers->reviewer);
                }

            }
        }
        return $boardDevelopers;

    }

    public function getDeveloperCountAttribute()
    {
        $board = $this->board;
        $board = json_decode($board);
        return count((array)$board);
    }

    /** Not too elegant way to calculate where to split the list of developers into two columns
     *
     * @return array
     */
    public function getColumnIndicesAttribute()
    {
        $developerCount = $this->getDeveloperCountAttribute();
        $split = round($developerCount/2, 0, PHP_ROUND_HALF_DOWN);
        return [0 => $split, $split+1 => $developerCount];
    }

}
