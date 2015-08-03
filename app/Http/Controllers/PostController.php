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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
            return '保存成功';
        }else{
            return '保存失败';
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
    }
}
