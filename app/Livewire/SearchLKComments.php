<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchLKComments extends Component
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

        if (!in_array($sort, ['id', 'title', 'post_id'])) {
            $sort = 'id';
        }

        $order = $request->get('order');

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return view('livewire.search-l-k-comments', [
            'comments' => Comment::query()
                ->where('user_id', $request->user()->id)
                ->where(function ($query) use ($sort, $order) {
                    $query->where('id', 'LIKE', "%$this->search%")
                        ->orWhere('text', 'LIKE', "%$this->search%")
                        ->orWhere('post_id', 'LIKE', "%$this->search%");
                })
                ->orderBy($sort, $order)
                ->paginate(3, ['*'], 'page', ''),
        ]);
    }
}
