<table class="table table-responsive">
    <thead>
        <th>排序</th>
        <th>編號</th>
        <th>單位/處室名稱</th>
        <th>建立時間</th>
        <th>操作</th>
    </thead>
    <tbody class="sortable" data-entityname="departments">
    @foreach($departments as $key => $department)
        <tr data-itemId="{{{ $department->id }}}">
            <td class="sortable-handle"><span class="glyphicon glyphicon-sort"></span></td>
            <td class="id-column">{{$department->id}}</td>
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