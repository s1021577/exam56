@extends('layouts.app') 

@section('content')

    @foreach($content as $i => $data)
        <dl>
            <dt class="h3">  
                （{{ $data['ans'] }}）          
                <span class="badge badge-success">{{ $i }}</span>                
                {{ $data['topic']->topic }}
            </dt>
            <dd class="opt">
                {{ bs()->radioGroup("ans[{$data['topic']->id}]", [
                    1 => "&#10102; {$data['topic']->opt1}", 
                    2 => "&#10103; {$data['topic']->opt2}",  
                    3 => "&#10104; {$data['topic']->opt3}",  
                    4 => "&#10105; {$data['topic']->opt4}", 
                    ])
                    ->selectedOption($data['topic']->ans)
                    ->addRadioClass(['my-1','mx-3'])}}
            </dd>
        </dl>
    @endforeach

@endsection