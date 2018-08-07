@extends('layouts.app') 


@section('content')
    <h1>隨機題庫系統</h1>

    @forelse($exams as $exam)
        <li>{{ $exam->title }}</li>
    @empty
        <div class="alert alert-danger">
            尚無任何測驗
        </div>
    @endforelse

@endsection

{{-- @section('my_menu')
@parent
<li><a class="nav-link" href="/add">新增題庫</a></li>
     --}}
    {{-- 有parent附加 --}}
{{-- @stop --}}