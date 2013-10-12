@if ($errs = $errors->all())
		@if (count($errs) > 1)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errs as $message)
					<li>{{ $message }}</li>
				@endforeach
			</ul>
		</div>
		@else
		<div class="alert
		@if (preg_match('/^[a-z]+:/', $errs[0], $matches))
		alert-{{ trim($matches[0], ':') }}
		@else
		alert-danger
		@endif
		">
			{{ preg_replace('/^[a-z]+: ?/', '', $errs[0]) }}
		</div>
		@endif
	</div>
@endif