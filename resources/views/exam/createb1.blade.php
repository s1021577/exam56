@extends('layouts.app') 
@section('content')
<h1>建立測驗</h1>
@can('建立測驗')
{{ bs()->openForm('post', '/exam' ) }}

{{ bs()->formGroup()
    ->label('請填入測驗標題', false, 'text-sm-right')
    ->control(bs()->text('title')->placeholder('請填入測驗標題'))
    ->showAsRow() }}
{{-- {{ bs()->text('title')->placeholder('請填入測驗標題') }} --}}

{{ bs()->formGroup()
    ->label('啟用', false, 'text-sm-right')
    ->control(bs()->radioGroup('enable2', [1 => '啟用', 0 => '關閉'])
       ->selectedOption(1)
       ->inline())
    ->showAsRow() }}
{{-- {{ bs()->select('enable1', ['1' => '開啟', '0' => '關閉'], '1') }} --}}
{{-- {{ bs()->checkbox('enable3')->description('啟用')->checked() }} --}}
{{-- {{ bs()->radioGroup('enable2', [1 => '啟用', 0 => '關閉'])
       ->selectedOption(1)
       ->inline() }} --}}
       {{ bs()->formGroup()
        ->label('儲存', false, 'text-sm-right')
        ->control(bs()->submit('儲存') )
        ->showAsRow() }}
{{ bs()->submit('儲存') }}
{{ bs()->closeForm() }}
@else
{{-- 使用component --}}
{{-- @component('bs::alert', ['type' => 'danger'])
@slot('heading')
    沒有操作的權限
@endslot
<p>請先登入，或有相關權限者始能建立測驗</p>
@endcomponent --}}
{{-- 自己寫要記得寫適當的樣式 --}}
<div class="alert alert-danger">
<h2>沒有操作的權限</h2>
<p>請先登入，或有相關權限者始能建立測驗</p>
</div>
@endcan
@endsection