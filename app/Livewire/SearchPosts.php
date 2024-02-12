<?php

namespace App\Livewire;
use App\Models\Post;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchPosts extends Component
{
    #[Url]
    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        $sort = $request->get('sort');

        if (!in_array($sort, ['id', 'title'])) {
            $sort = 'id';
        }

        $order = $request->get('order');

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return view('livewire.search-posts', [
            'posts' => Post::query()
                ->where('id', 'LIKE', "%$this->search%")
                ->orWhere('title', 'LIKE', "%$this->search%")
                ->orderBy($sort, $order)
                ->paginate(3, ['*'], 'page', ''),
        ]);
    }
}
