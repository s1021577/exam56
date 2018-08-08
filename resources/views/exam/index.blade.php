@extends('layouts.app') 


@section('content')
    <h1>隨機題庫系統<small>（共 {{$exams->total()}} 筆資料）</small></h1>

    <div class="list-group">      

        @forelse($exams as $exam)
            
            <a href="exam/{{$exam->id}}" class="list-group-item list-group-item-action">
                {{$exam->updated_at->format('Y年m月d日')}}{{ $exam->title }}</a>
        @empty
            <div class="alert alert-danger">
                尚無任何測驗
            </div>
        @endforelse
        
    </div>
    <div class="my-3">
        {{ $exams->links() }}
    </div>
    {{-- ->links()使用分頁視圖 --}}
@endsection

{{-- @section('my_menu')
@parent
<li><a class="nav-link" href="/add">新增題庫</a></li>
     --}}
    {{-- 有parent附加 --}}
{{-- @stop --}}