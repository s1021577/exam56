@extends('layouts.app') 


@section('content')
    <h1> {{$exam->title}}</h1>
    <div class="text-center">
        發佈於 {{ $exam->created_at->format("Y年m月d日 H:i:s") }} / 最後更新： {{ $exam->updated_at->format("Y年m月d日 H:i:s") }}
    </div>
@endsection

{{-- @section('my_menu')
@parent
<li><a class="nav-link" href="/add">新增題庫</a></li>
     --}}
    {{-- 有parent附加 --}}
{{-- @stop --}}