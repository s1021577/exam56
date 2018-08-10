@extends('layouts.app') 

@section('content')
    <h1>
        {{ $exam->title }}
        @can('建立測驗')
            {{-- <form action="{{route('exam.destroy', $exam->id)}}"  method="post" style="display:inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">刪除</button>
            </form> --}}
            {{-- 以上為form刪測驗，以下改為用ajax刪 --}}            
            <a href="#" class="btn btn-danger btn-del-exam" data-id="{{ $exam->id }}">刪除</a>
            <a href="{{ route('exam.edit', $exam->id) }}" class="btn btn-warning">編輯</a>

        @endcan
    </h1>

    {{-- 題目表單 --}}
    @can('建立測驗')
    @include('exam.form')
    @endcan


    {{-- 題目列表 --}}
    {{-- 也可Auth::check('建立測驗') || Auth::check('進行測驗') --}}
    @if(Auth::check())
    
        @can('進行測驗'')
            {{ bs()->openForm('post', '/test') }}        
            @include('exam.topic')        
            {{ bs()->hidden('user_id', Auth::id()) }}
            {{ bs()->hidden('exam_id', $exam->id) }}
            <div class="text-center my-5">
                {{ bs()->submit('交卷')->sizeLarge() }}
            </div>
        {{ bs()->closeForm() }}
        @else
            @include('exam.topic')
        @endcan
    @else
        <div class="alert alert-info">
            <h3>本測驗共有{{$exam->topics->count()}}題, 登入後始能看見</h3>        
        </div>
    @endif
    <div class="text-center">
    {{$exam->user->name}}({{$exam->user->email}})發佈於 {{ $exam->created_at->format("Y年m月d日 H:i:s") }} / 最後更新： {{ $exam->updated_at->format("Y年m月d日 H:i:s") }}
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('.btn-del-topic').click(function(){
            var topic_id=$(this).data('id');
            // 對應data-id
            swal({
                    title: "確定要刪除題目嗎？",
                    text: "刪除後該題目就消失救不回來囉！",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是！含淚刪除！",
                    cancelButtonText: "不...別刪",
                }).then((result) => {
                    if (result.value) {
                        swal("OK！刪掉題目惹！", "該題目已經隨風而逝了...", "success");
                        axios.delete('/topic/' + topic_id).then(function () {
                            location.reload();
                        });
                    }
                })
        });        
        $('.btn-del-exam').click(function(){
            var exam_id=$(this).data('id');
            swal({
                    title: "確定要刪除測驗嗎？",
                    text: "刪除後該測驗就消失救不回來囉！",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是！含淚刪除！",
                    cancelButtonText: "不...別刪",
                }).then((result) => {
                    if (result.value) {                        
                        axios.delete('/exam/' + exam_id)
                        .then(function(){
                            return swal("OK！刪掉題目惹！", "該題目已經隨風而逝了...", "success");
                        }).then(function () {
                            location.href='/';
                        });
                    }
                })
        });
    });
</script>
@endsection