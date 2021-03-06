
    @forelse($exam->topics as $key => $topic)
    <dl>
        <dt class="h3">
            
            @can('建立測驗')
                {{-- <form action="{{route('topic.destroy', $topic->id)}}"  method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form> --}}
                {{-- 以上為原本的用form暗藏@method('delete')
                    以下改用java方式
                --}}
                <button type="button" class="btn btn-danger btn-del-topic" data-id="{{ $topic->id }}">刪除</button>
                <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-xs btn-warning">編輯</a>
                （{{ $topic->ans }}）
            @endcan
            <span class="badge badge-success">{{ $key+1 }}</span>                
            {{ $topic->topic }}
        </dt>
        <dd class="opt">
            {{-- 預設沒填時以hidden為預設，注意先後順序, 如果radio有填則蓋掉，因為同名$topic->id --}}
            {{ bs()->hidden("ans[$topic->id]",0)}}
            {{ bs()->radioGroup("ans[$topic->id]", [
                1 => "&#10102; $topic->opt1", 
                2 => "&#10103; $topic->opt2",  
                3 => "&#10104; $topic->opt3",  
                4 => "&#10105; $topic->opt4", 
                ])
                ->selectedOption((Auth::user() and Auth::user()->can('建立測驗'))?$topic->ans:0)
                ->addRadioClass(['my-1','mx-3'])}}
        </dd>
    </dl>
@empty
    <div class="alert alert-danger">
        尚無題目
    </div>
@endforelse
