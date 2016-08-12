<table class="table table-responsive">
    <thead>
        <th>編號</th>
        <th>單位/處室名稱</th>
        <th>建立時間</th>
        <th>操作</th>
    </thead>
    <tbody>
    @foreach($departments as $key => $department)
        <tr>
            <td>{{$department->id}}</td>
            <td>{{$department->name}}</td>
            <td>{{$department->created_at}}</td>
            <td>
                {!! Form::open(['route' => ['backend.department.destroy', $department->id], 'method' => 'delete']) !!}
                <a class="btn btn-primary btn-sm" href="{!! route('backend.department.edit', [$department->id]) !!}"><i class="glyphicon glyphicon-edit"></i> 編輯</a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i> 刪除', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm delete']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>