<?php

namespace App\Http\Controllers;

use App\Test;
use App\Topic;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $content = collect($request->ans)->toJson();
        // $content=json_encode($request->ans, 256);
        $right_ans = 0;
        $show_num  = collect($request->ans)->count();
        foreach ($request->ans as $topic_id => $ans) {
            $topic = Topic::find($topic_id);
            $right_ans += ($topic->ans == $ans) ? 1 : 0;
        }

        $score = round(100 * ($right_ans / $show_num), 0);

        $test = Test::create([
            'content' => $content,
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'score'   => $score,
        ]);
        // 這此不適合用all的方法
        return redirect()->route('test.show', $test->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
        $topics  = json_decode($test->content, true);
        $content = [];
        $i       = 1;
        foreach ($topics as $topic_id => $ans) {
            $content[$i]['topic'] = Topic::find($topic_id);
            $content[$i]['ans']   = $ans;
        }
        //透過$topic_id的索引，使用Topic::find方法，去將該題目所有的相關內容找出來，放在content[$i]['topic']
        return view('exam.test', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
