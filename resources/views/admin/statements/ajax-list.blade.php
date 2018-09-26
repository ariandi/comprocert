<div class="lvl1 ajavlvl{{ $lvl }}load">
	<div class="h-new-node">
		<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
	</div>
	<div class="h-new-title">
		<a href="{{ route('statements.create', ['parent' => $parent, 'lvl' => $lvl]) }}">New Node</a>
	</div>

	<div class="clearfix"></div>

	<div class="b-node">
		@foreach($statementstr as $s)
			@if($s->statement['id'] != null and $s->statement['active'] == 1)
				<div class="c-menu-b">
					<div class="h-new-node">
						<a href="{{ route('statements.index', ['parent' => $s->statement['id'], 'lvl' => $lvl]) }}" class="lvl{{ $lvl }}clicked" id="{{ $s->statement['id'] }}">
		  				<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
		  			</a>
		  		</div>
		  		<div class="h-new-title">
		  			<a href="{{ route('statements.edit', ['id' => $s->statement['id'], 'parent' => $parent, 'lvl' => $lvl]) }}">
		  				{{ $s->statement['title'] }} ({{ $s->statement['id'] }})
		  			</a>
		  		</div>

		  		<div class="clearfix"></div>
				</div>
			@endif
		@endforeach

	</div>
</div>