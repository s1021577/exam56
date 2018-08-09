@extends('layouts.app') 

@section('content')
    <h1>建立測驗</h1>

    @can('建立測驗')
        @if(isset($exam))
            {{ bs()->openForm('patch', "/exam/{$exam->id}", ['model' => $exam]) }}
            {{-- 修改要將post改為patch，並且要帶id，所以/exam/{$exam->id} --}}
        @else
            {{ bs()->openForm('post', '/exam') }}
        @endif        
        {{-- 以上加入['model' => $exam]用以綁定 參考8-1 => 二、建立表單 => 選項部份 =>
        如此就可在新增及修改時皆可用，修改使用上項，此時有綁定$exam,由exam.edit來，如果沒綁定$exam，由exam.create來
        --}}
            {{ bs()->formGroup()
                ->label('測驗標題', false, 'text-sm-right')
                ->control(bs()->text('title')->placeholder('請填入測驗標題'))
                ->showAsRow() }}

        
            {{-- {{ bs()->select('enable', ['1' => '開啟', '0' => '關閉'], '1') }} --}}
            {{-- {{ bs()->checkbox('enable1')->description('啟用測驗')->checked() }} --}}
            
            {{-- {{ bs()->formGroup()
                ->label('是否啟用', false, 'text-sm-right')
                ->control(bs()->radioGroup('enable', [1 => '啟用', 0 => '關閉'])
                    ->selectedOption(isset($exam)?$exam->enable:1)
                    ->inline())
                ->showAsRow() }} --}}
            {{ bs()->formGroup()
                ->label('是否啟用', false, 'text-sm-right')
                ->control(bs()->radioGroup('enable', [1 => '啟用', 0 => '關閉'])->inline())
                ->showAsRow() }}    
            {{ bs()->hidden('user_id', Auth::id()) }}
            {{ bs()->formGroup()
                ->label('', false, 'text-sm-right')
                ->control(bs()->submit('儲存'))
                ->showAsRow() }}

        {{ bs()->closeForm() }}
    @else    
        {{-- 
        @component('bs::alert', ['type' => 'danger'])
            @slot('heading')
                沒有操作的權限
            @endslot
            <p>請先登入，或有相關權限者始能建立測驗</p>
        @endcomponent 
        --}}

        <div class="alert alert-danger">
            <h2>沒有操作的權限</h2>
            <p>請先登入，或有相關權限者始能建立測驗</p>
        </div>
    @endcan
    
@endsection