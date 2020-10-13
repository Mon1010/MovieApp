<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Http;
class SearchDropdown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];
        if(strlen($this->search)>2)
        {
            $searchResults = Http::withToken(config('services.tmbd.tokens'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];
        }   
    //     dump($searchResults);
        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
 