<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchComments extends Component
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

        if (!in_array($sort, ['id', 'title', 'user_id', 'post_id'])) {
            $sort = 'id';
        }

        $order = $request->get('order');

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return view('livewire.search-comments', [
            'comments' => Comment::query()
                ->where('id', 'LIKE', "%$this->search%")
                ->orWhere('text', 'LIKE', "%$this->search%")
                ->orWhere('user_id', 'LIKE', "%$this->search%")
                ->orWhere('post_id', 'LIKE', "%$this->search%")
                ->orderBy($sort, $order)
                ->paginate(3, ['*'], 'page', ''),
        ]);
    }
}
