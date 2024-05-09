<?php

namespace App\Livewire\Category;

use Livewire\Component;

class IndexCategory extends Component
{
    public $search = '';
    public int $perPage = 10;
    public int $page = 1;
    public int $offset;

    public function render()
    {
        $this->offset = ($this->page * $this->perPage) - $this->perPage;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items?offset='.$this->offset.'&limit='.$this->perPage, ['headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
        ],
        ]);
        $categories = json_decode($response->getBody());
        $total_pages = ceil($categories->pagination->total / $this->perPage);

        return view('livewire.category.index-category', compact('categories', 'total_pages'));
    }


    public function delete($category_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('DELETE', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items/'.$category_id, [
            'headers' => [
                'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
            ],
        ]);
        //$response = json_decode($response->getBody());
    }

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function changePage(int $page)
    {
        $this->page = $page;
    }
}
