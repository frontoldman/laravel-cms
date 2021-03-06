<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{


    public function __construct(PostRepository $postRepository,Guard $auth)
    {
        $this->middleware('admin');
        $this->postRepository = $postRepository;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAllByUserId($this->auth->user()->id);
        return view('admin.post.list',compact('posts'));
    }


    /**
     *
     *  前台页面bloglist
     *
     */
    public function indexFront()
    {
        $posts = $this->postRepository->getAll();
        return view('front.list',compact('posts'));
    }

    public function link($id)
    {
        return $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = $this->addValidate($inputs);
        if($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $inputs['user_id'] = $this->auth->user()->id;
        $inputs['active'] = isset($inputs['active']);

        $post = $this->postRepository->store($inputs);

        if($post){
            return redirect('/admin/post')->with('ok','添加成功');
        }else{
            return redirect()->to($this->getRedirectUrl())
                ->withInput($request->input())
                ->withErrors([
                    'message' => '添加失败'
                ]);
        }


    }


    /**
     * 创建验证
     *
     * @param $inputs
     * @return mixed
     */
    private function addValidate($inputs)
    {
        return Validator::make($inputs, [
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $result = $this->postRepository->getById($id);

        $post = $result['post'];
        $tags = $result['tags'];

        if(isset($tags)){
            $tags = implode(',',$tags);
        }

        return view('admin.post.edit',compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $inputs = $request->all();

        $validator = $this->addValidate($inputs);
        if($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $inputs['active'] = isset($inputs['active']);

        $post = $this->postRepository->update($id,$inputs);

        if($post){
            return redirect('/admin/post')->with('ok','更新成功');
        }else{
            return redirect()->to($this->getRedirectUrl())
                ->withInput($request->input())
                ->withErrors([
                    'message' => '更新失败'
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $post = $this->postRepository->delete($id);

        if($post){
            return redirect()->to($this->getRedirectUrl())
                ->with('ok','删除成功');
        }else{
            return redirect()->to($this->getRedirectUrl())
                ->withErrors([
                    'message' => '删除失败'
                ]);
        }

    }
}
