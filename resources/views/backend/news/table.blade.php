<table class="table table-responsive" id="news-table">
    <thead>
        <th>編號</th>
        <th>標題</th>
        <th>單位/處室</th>
        <th>發佈時間</th>
        <th>操作</th>
    </thead>
    <tbody>
    @foreach($news as $news)
        <tr>
            <td>{{$news->id}}</td>
            <td>{{$news->title}}</td>
            <td>{{$news->department->name}}</td>
            <td>{{$news->created_at}}</td>
            <td>
                {!! Form::open(['route' => ['backend.news.destroy', $news->id], 'method' => 'delete']) !!}
                <a class="btn btn-primary btn-sm" href="{!! route('backend.news.edit', [$news->id]) !!}"><i class="glyphicon glyphicon-edit"></i> 編輯</a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i> 刪除', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm delete']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>