<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Controllers\Base\SortController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $paginate;
    protected $sort;

    public function __construct(SortController $sort, PaginateController $paginate)
    {
        $this->paginate = $paginate;
        $this->sort = $sort;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        $admin_users = $query
            ->orderBy($this->sort->getSort($request), $this->sort->getOrder($request))
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request))
            ->withQueryString();

        return view('admin.admin_users.index', ['admin_users' => $admin_users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_users.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserFormRequest $request)
    {
        $admin_user = User::create($request->validated());

        return redirect(route("admin.admin_users.index", ["admin_user" => $admin_user]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin_user)
    {
        return view("admin.admin_users.create", [
            "admin_user" => $admin_user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserFormRequest $request, string $id)
    {
        $admin_user = User::findOrFail($id);

        $data = $request->validated();

        $admin_user->update($data);

        return redirect(route("admin.admin_users.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin_user)
    {
        $admin_user->delete();

        return redirect(route("admin.admin_users.index"));
    }
}
