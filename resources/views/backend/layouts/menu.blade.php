<li class="{{ \Request::is('backend/news*') ? 'active' : '' }} treeview ">
	<a href="#">
		<i class="fa fa-dashboard"></i> <span>公告欄</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ \Request::is('backend/news') ? 'active' : '' }}"><a href="{!! route('backend.news.index') !!}"><i class="fa fa-circle-o"></i> 公告列表</a></li>
		<li class="{{ \Request::is('backend/news/create') ? 'active' : '' }}"><a href="{!! route('backend.news.create') !!}"><i class="fa fa-circle-o"></i> 發佈公告</a></li>
	</ul>
</li>

<li class="{{ \Request::is('backend/department*') ? 'active' : '' }} treeview ">
	<a href="#">
		<i class="fa fa-dashboard"></i> <span>單位/處室</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ \Request::is('backend/department') ? 'active' : '' }}"><a href="{!! route('backend.department.index') !!}"><i class="fa fa-circle-o"></i> 單位/處室列表</a></li>
		<li class="{{ \Request::is('backend/department/create') ? 'active' : '' }}"><a href="{!! route('backend.department.create') !!}"><i class="fa fa-circle-o"></i> 新增單位/處室</a></li>
	</ul>
</li>

