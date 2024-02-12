<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactForm;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    protected $paginate;

    public function __construct(PaginateController $paginate)
    {
        $this->paginate = $paginate;
    }

    public function index(Request $request)
    {
        $posts = Post::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request));

        return view('posts.index', ["posts" => $posts]);
    }

    public function showContactForm()
    {
        return view("contact_form");
    }

    public function contactForm(ContactFormRequest $request)
    {
        Mail::to("sem1ngova00@yandex.ru")->send(new ContactForm($request->validated()));

        return redirect(route("contacts"));
    }
}
