<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use App\Topic;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $exams = Exam::all();
        // $exams = Exam::where('enable', 1)
        //     ->orderBy('created_at', 'desc')
        //     ->take(2)
        //     ->get(); //取二筆並排序
        $exams = Exam::where('enable', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(2); //使用分頁,但要同時設定view即index
        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        //dd($request);
        // $exam          = new Exam;
        // $exam->title   = $request->title;
        // $exam->enable  = $request->enable;
        // $exam->user_id = $request->user_id;
        // $exam->save();

        //以下二種必須搭配在Exam.php加上fillable設定
        // Exam::create([
        //     'title'   => $request->title,
        //     'user_id' => $request->user_id,
        //     'enable'  => $request->enable,
        // ]);

        Exam::create($request->all());
        return redirect()->route('exam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    //依據12-1路由模型綁定
    public function show(Exam $exam)
    {
        //
        //$exam = Exam::find($id);//12-1路由模型綁定
        //return view('exam.show', compact('exam'));//只有呈現考試，沒有呈現題目
        $topics = Topic::where('exam_id', $exam->id)->get();
        return view('exam.show', compact('exam', 'topics'));
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
    public function update(ExamRequest $request, $id)
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
