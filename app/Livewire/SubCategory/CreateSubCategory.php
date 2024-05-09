<?php

namespace App\Livewire\SubCategory;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateSubCategory extends Component
{

    public $name;
    public $slug;
    public $category_id;
    public $subcategory_id;
    public $main_category_name;
    public bool $header_mega_menu_display = false;

    public function mount($category_id = null, $subcategory_id = null)
    {
        $this->category_id = $category_id;
        if ($subcategory_id)
        {
            $this->subcategory_id = $subcategory_id;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.webflow.com/v2/collections/655f1f933961e50425197883/items/'.$subcategory_id, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                ],
            ]);

            $subcategory = json_decode($response->getBody(), true);
            $this->name = $subcategory['fieldData']['name'];
            $this->slug = $subcategory['fieldData']['slug'];
            $this->header_mega_menu_display = $subcategory['fieldData']['header-mega-menude-gorunsun'];
            $this->category_id = $subcategory['fieldData']['ana-kategori'];

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items/'.$this->category_id, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                ],
            ]);

            $this->main_category_name = json_decode($response->getBody(), true)['fieldData']['name'];

        }
    }

    public function render()
    {
        return view('livewire.sub-category.create-sub-category');
    }

    protected $submitRules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255',
    ];

    protected $messages = [
        'name.required' => 'Sub-Category name field is required.',
        'name.max' => "Sub-Category name field can't be longer than 255 characters.",
        'slug.required' => 'Slug field is required.',
        'slug.max' => "Slug field can't be longer than 255 characters.",
    ];

    public function submit()
    {
        $this->validate($this->submitRules, $this->messages);
        DB::transaction(function(){
            if ($this->subcategory_id)
            {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('PATCH', 'https://api.webflow.com/v2/collections/655f1f933961e50425197883/items/'.$this->subcategory_id, [
                    'body' => '{"isArchived":false,"isDraft":false,"fieldData":{"name":"'.$this->name.'","slug":"'.$this->slug.'","header-mega-menude-gorunsun":'.json_encode($this->header_mega_menu_display).'}}',
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                        'content-type' => 'application/json',
                    ],
                ]);
                if (json_decode($response->getBody())->id)
                {
                    return redirect()->route('sub-categories.edit', ['subcategory_id' => $this->subcategory_id])->with('success', 'Sub-Category has been updated.');
                }
            } else {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://api.webflow.com/v2/collections/655f1f933961e50425197883/items', [
                    'body' => '{"isArchived":false,"isDraft":false,"fieldData":{"name":"'.$this->name.'","slug":"'.$this->slug.'","ana-kategori":"'.$this->category_id.'","header-mega-menude-gorunsun":'.json_encode($this->header_mega_menu_display).'}}',
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                        'content-type' => 'application/json',
                    ],
                ]);
                if (json_decode($response->getBody())->id)
                {
                    return redirect()->route('sub-categories.create', ['category_id' => $this->category_id])->with('success', 'Sub-Category has been created.');
                }
            }
        });
    }
}
