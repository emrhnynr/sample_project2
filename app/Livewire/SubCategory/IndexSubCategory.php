<?php

namespace App\Livewire\SubCategory;

use Livewire\Component;

class IndexSubCategory extends Component
{
    public $search = '';
    public int $perPage = 100;
    public int $page = 1;
    public int $offset;
    public $category_id;

    public function mount($record = null)
    {
        $this->category_id = $record;
    }

    public function render()
    {
        $this->offset = ($this->page * $this->perPage) - $this->perPage;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.webflow.com/v2/collections/655f1f933961e50425197883/items?offset='.$this->offset.'&limit='.$this->perPage, ['headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
        ],
        ]);
        $sub_categories = json_decode($response->getBody(), true);

        $total_pages = ceil($sub_categories['pagination']['total'] / $this->perPage);
        $sub_categories = array_filter($sub_categories['items'], function($item){
            return $item['fieldData']['ana-kategori'] == $this->category_id;
        });

        return view('livewire.sub-category.index-sub-category', compact('sub_categories','total_pages'));
    }

    public function delete($subcategory_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('DELETE', 'https://api.webflow.com/v2/collections/655f1f933961e50425197883/items/'.$subcategory_id, [
            'headers' => [
                'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
            ],
        ]);
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
