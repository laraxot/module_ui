<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-6">
			<b>{{ $row->pivot->related->title }}</b>
		</div>
		<!-- end:col -->
		<div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
			<span class="price pull-left">€ {{ $row->pivot->price }}</span>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-4">

		</div>
	</div>
	<!-- end:row -->
{{-- variations --}}
@foreach($row->sons as $son)
<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-6">
			&nbsp;+&nbsp;{{ $son->pivot->related->title }}
		</div>
		<!-- end:col -->
		<div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
			<span class="price pull-left">€ {{ $son->pivot->price }}</span>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-4">

		</div>
</div>
	<!-- end:row -->
@endforeach
