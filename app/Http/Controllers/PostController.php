<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
      //  Gate::Authorize('posts.view');

        $records = Post::paginate(15);
        return view('posts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
       // Gate::Authorize('posts.create');

        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.create', compact('categories'));
    }


    /**
     * @param Request $request
     * @return
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       // Gate::Authorize('posts.create');

        $request->validate(post::rules(),[
            'required' => ' (:attribute) هذا الحقل مطلوب'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->publish_date = $request->input('publish_date');

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('post', $filename, ['disk' => 'uploads']);
            $data['image'] = $path;
        }

        $post = post::create($data);

        return redirect()->route('posts.index')
            ->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
     //   Gate::Authorize('posts.update');

        $model = Post::findOrFail($id);
        return view('posts.edit', compact('model'));
    }


    public function update(Request $request, $id)
    {
      //  Gate::Authorize('posts.update');

        $request->validate(post::rules());

        $records = Post::findOrFail($id);
        $old_image = $records->image;
         $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');  // UploadsFile Object
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('post', $filename, ['disk' => 'uploads']);
            $new_image = $path;
        }
        if ($new_image){
            $data['image'] = $new_image;
        }
        $records->update($data);
        if ($old_image && $new_image) {
            storage::disk('uploads')->delete($old_image);
        }
        flash()->success('تم التحديث بنجاح');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
    //    Gate::Authorize('posts.delete');

        //  post::destroy($id);
        $post = post::findorfail($id);
        $post->delete();
        if ($post->image) {
            storage::disk('uploads')->delete($post->image);
        }
        flash()->success("Successfully Record Deleted");
        return redirect('admin/posts');


        /*- $record = Post::find($id);
         if (!$record) {
             return response()->json([
                     'status'  => 0,
                     'message' => 'تعذر الحصول على البيانات'
                 ]);
         }

         $record->delete();
         return response()->json([
                 'status'  => 1,
                 'message' => 'تم الحذف بنجاح',
                 'id'      => $id
             ]);
        -*/
    }

}
