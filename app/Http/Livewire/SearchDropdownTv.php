<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Http;
class SearchDropdownTv extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];
        if(strlen($this->search)>2)
        {
            $searchResults = Http::withToken(config('services.tmbd.tokens'))
            ->get('https://api.themoviedb.org/3/search/tv?query='.$this->search)
            ->json()['results'];
        }   
    //     dump($searchResults);
        return view('livewire.search-dropdown-tv', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
