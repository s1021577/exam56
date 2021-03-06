<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check() and Auth::user()->can('建立測驗')) {
            $exams = Exam::orderBy('created_at', 'desc')
                ->paginate(2);
        } else {
            $exams = Exam::where('enable', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(2);
        }
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
        //$topics = Topic::where('exam_id', $exam->id)->get();//12-8 測驗與題目的關聯
        //return view('exam.show', compact('exam', 'topics'));//12-8 測驗與題目的關聯
        // $user= Auth::user();
        // if($user and $user->can('進行測驗')){

        // }
        if (Auth::check() and Auth::user()->can('進行測驗')) {
            $show_num = 5;
            if ($exam->topics->count() >= 5) {
                $exam->topics = $exam->topics->random($show_num);
            }
            // 隨機挑5題
        }
        return view('exam.show', compact('exam')); //已在12-8建好關連後，從此$exam已包括題庫Topic及測驗Exam
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('exam.create', compact('exam'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        //
        $exam->update($request->all());
        return redirect()->route('exam.show', $exam->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
        $exam->delete();
        //return redirect()->route('exam.index');
        //以上是給form用的，如果改用ajax時，必須取消，否則會全毀
    }
}
