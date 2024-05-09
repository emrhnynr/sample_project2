<?php

namespace App\Livewire\Category;

use App\Models\Customers\Customer as PageModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateCategory extends Component
{
    public $name;
    public $slug;
    public $category_id;

    public function mount($record = null)
    {
        if ($record){
            $this->category_id = $record;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items/'.$record, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                ],
            ]);
            $result = json_decode($response->getBody());
            $this->name = $result->fieldData->name;
            $this->slug = $result->fieldData->slug;
        }
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }

    protected $submitRules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255',
    ];

    protected $messages = [
        'name.required' => 'Category name field is required.',
        'name.max' => "Category name field can't be longer than 255 characters.",
        'slug.required' => 'Slug field is required.',
        'slug.max' => "Slug field can't be longer than 255 characters."
    ];

    public function submit()
    {
        $this->validate($this->submitRules, $this->messages);

        DB::transaction(function(){
            if ($this->category_id){
                $client = new \GuzzleHttp\Client();
                $response = $client->request('PATCH', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items/'.$this->category_id, [
                    'body' => '{"isArchived":false,"isDraft":false,"fieldData":{"name":"'.$this->name.'","slug":"'.$this->slug.'"}}',
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                        'content-type' => 'application/json',
                    ],
                ]);
                if (json_decode($response->getBody())->id)
                {
                    return redirect()->route('categories.edit', ['category_id' => $this->category_id])->with('success', 'Category has been updated.');
                }
            } else {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://api.webflow.com/v2/collections/655f1f933961e50425197882/items', [
                    'body' => '{"isArchived":false,"isDraft":false,"fieldData":{"name":"'.$this->name.'","slug":"'.$this->slug.'"}}',
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer b917c5ca6ab706b1929b24a42d3546ab733f8395d5e1a72ad7f2a698170d50ea',
                        'content-type' => 'application/json',

                    ],
                ]);
                if (json_decode($response->getBody())->id)
                {
                    return redirect()->route('categories.create')->with('success', 'Category has been created.');
                }
            }
        });
    }
}
