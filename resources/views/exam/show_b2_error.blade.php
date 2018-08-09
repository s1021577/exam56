@extends('layouts.app') 


@section('content')
    <h1> 
        {{ $exam->title }}
        @can('建立測驗')
            <a href="{{ route('exam.edit', $exam->id) }}" class="btn btn-warning">編輯</a>            
        @endcan
    </h1>
    @can('建立測驗')
{{--     
    @if(isset($topic))
        {{ bs()->openForm('patch', "/topic/{$topic->id}", ['model' => $topic]) }}        
    @else
        {{ bs()->openForm('post', '/topic') }}
    @endif        --}}
    
    {{ bs()->openForm('post', '/topic') }} 
        
        {{ bs()->formGroup()
                ->label('題目內容', false, 'text-sm-right')
                ->control(bs()->textarea('topic')->placeholder('請輸入題目內容'))
                ->showAsRow() }}
        
        {{ bs()->formGroup()
                ->label('選項1', false, 'text-sm-right')
                ->control(bs()->text('opt1')->placeholder('輸入選項1'))
                ->showAsRow() }}
        {{ bs()->formGroup()
                ->label('選項2', false, 'text-sm-right')
                ->control(bs()->text('opt2')->placeholder('輸入選項2'))
                ->showAsRow() }}
        {{ bs()->formGroup()
                ->label('選項3', false, 'text-sm-right')
                ->control(bs()->text('opt3')->placeholder('輸入選項3'))
                ->showAsRow() }}
        {{ bs()->formGroup()
                ->label('選項4', false, 'text-sm-right')
                ->control(bs()->text('opt4')->placeholder('輸入選項4'))
                ->showAsRow() }}
        {{-- {{ bs()->formGroup()
                ->label('正確解答', false, 'text-sm-right')
                ->control(bs()->select('ans',[1=>1, 2=>2, 3=>3, 4=>4])->placeholder('請設定正確解答'))
                ->showAsRow() }} --}}
        {{ bs()->formGroup()
                ->label('正確解答', false, 'text-sm-right')
                ->control(bs()->radioGroup('ans', [1 => '1', 2 => '2',3 => '3', 4 => '4' ])
                ->inline()
                ->addRadioClass(['mx-3, my-1']))
                ->showAsRow() }}
        {{ bs()->hidden('exam_id', $exam->id) }}
        {{ bs()->formGroup()
                ->label('')
                ->control(bs()->submit('儲存'))
                ->showAsRow() }}
    {{ bs()->closeForm() }}
    @endcan
    
    
        {{-- @forelse ($topics as $key => $topic) //12-8 測驗與題目的關聯  --}}
        @forelse ($exam->topics as $key => $topic) 
        {{-- //12-8 測驗與題目的關聯, 此時$exam已含有Exam本身及Topic所以如果要取用topics則要用$exam->topics --}}
        <dl>
            <dt class="h3">
                @can('建立測驗')
                <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-warning">編輯</a>
                （{{$topic->ans}}）
                @endcan
                <span class="badge badge-success">{{$key+1}}</span>
                {{$topic->topic}}            
            </dt>
            {{-- $topic是物件,$key是由@forelse動作代出的索引值 --}}
            <dd class="opt">
                {{ bs()->radioGroup("ans[$topic->id]", [
                1 => "&#10102; $topic->opt1",
                2 => "&#10103; $topic->opt2",
                3 => "&#10104; $topic->opt3",
                4 => "&#10105; $topic->opt4",
                ])
                ->selectedOption((Auth::user() and Auth::user()->can('建立測驗'))?$topic->ans:0)                
                ->addRadioClass(['mx-3, my-1'])}}
            </dd>
        </dl>        
            
        @empty
            <div class="alert alert-danger">尚無任何題目</div>
        @endforelse
    


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