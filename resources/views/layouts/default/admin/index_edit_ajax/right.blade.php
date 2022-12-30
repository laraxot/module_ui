<div class="col-md-4">
	<h4>@lang($view.'.title')</h4>
	<p>@lang($view.'.subtitle')</p>
	<hr>
	{{--
	<img src="{{ Theme::url(__($view.'.image_src')) }}" alt="" class="img-fluid">
	--}}
	<p></p>
	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingTwo" style="background-color:#fff;">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					@lang($view.'.question1')
					</button>
				</h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				<div class="card-body">
					@lang($view.'.answer1')
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingThree" style="background-color:#fff;">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					@lang($view.'.question2')
					</button>
				</h2>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				<div class="card-body">
					@lang($view.'.answer2')
				</div>
			</div>
		</div>
	</div>
	<!-- end:panel -->
	{{--
	@include('pub_theme::widgets.contact_us')
	--}}
</div>