<?php

namespace App\Http\Livewire;
use Http;
use Livewire\Component;

class SearchDropdownPeople extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];
        if(strlen($this->search)>2)
        {
            $searchResults = Http::withToken(config('services.tmbd.tokens'))
            ->get('https://api.themoviedb.org/3/search/person?query='.$this->search)
            ->json()['results'];
        }   
    //     dump($searchResults);
        return view('livewire.search-dropdown-people', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
