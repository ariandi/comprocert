<div class="lvl1 ajavlvl{{ $lvl }}load">
	<div class="h-new-node">
		<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
	</div>
	<div class="h-new-title">
		<a href="{{ route('nodes.create', ['parent' => $parent, 'lvl' => $lvl]) }}">New Node</a>
	</div>

	<div class="clearfix"></div>

	<div class="b-node">
		@foreach($nodes2 as $node2)
		<div class="c-menu-b">
			<div class="h-new-node">
				<a href="{{ route('nodes.index', ['parent' => $node2->node->id, 'lvl' => $lvl]) }}" class="lvl{{ $lvl }}clicked" id="{{ $node2->node->id }}">
  				<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
  			</a>
  		</div>
  		<div class="h-new-title">
  			<a href="{{ route('nodes.edit', ['id' => $node2->node->id, 'parent' => $parent, 'lvl' => $lvl]) }}">
  				{{ $node2->node->title }} ({{ $node2->node->id }})
  			</a>
  		</div>

  		<div class="clearfix"></div>
		</div>
		@endforeach

	</div>
</div>