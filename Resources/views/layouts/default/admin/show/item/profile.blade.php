<style>
.card-profile {
  width: 340px;
  margin: 50px auto;
  background-color: #e6e5e1;
  border-radius: 0;
  border: 0;
  box-shadow: 1em 1em 2em rgba(0, 0, 0, 0.2);
}
.card-profile .card-img-top {
  border-radius: 0;
}
.card-profile .card-img-profile {
  max-width: 100%;
  border-radius: 50%;
  margin-top: -95px;
  margin-bottom: 35px;
  border: 5px solid #e6e5e1;
}
.card-profile .card-title {
  margin-bottom: 50px;
}
.card-profile .card-title small {
  display: block;
  font-size: .6em;
  margin-top: .2em;
}
.card-profile .card-links {
  margin-bottom: 25px;
}
.card-profile .card-links .fa {
  margin: 0 1em;
  font-size: 1.6em;
}
.card-profile .card-links .fa:focus, .card-profile .card-links .fa:hover {
  text-decoration: none;
}
.card-profile .card-links .fa.fa-dribbble {
  color: #ea4b89;
  font-weight: bold;
}
.card-profile .card-links .fa.fa-dribbble:hover {
  color: #e51d6b;
}
.card-profile .card-links .fa.fa-twitter {
  color: #68aade;
}
.card-profile .card-links .fa.fa-twitter:hover {
  color: #3e92d5;
}
.card-profile .card-links .fa.fa-facebook {
  color: #3b5999;
}
.card-profile .card-links .fa.fa-facebook:hover {
  color: #2d4474;
}
</style>
<div class="col-lg-4">
<div class='card card-profile text-center'>
  <img alt='' class='card-img-top' src='{{ asset('images/background/profile-bg.jpg') }}' width="100%">
  <div class='card-block'>
	<img alt='' class='card-img-profile' src='{{ asset($row->image_src) }}' width="128">
	<h4 class='card-title'>
		{{$row->title}}
		<small>{{$row->subtitle}}</small>
	</h4>
	<div>{!! $row->txt !!}</div>
	<div class='card-links'>
	  <a class='fa fa-dribbble' href='#'></a>
	  <a class='fa fa-twitter' href='#'></a>
	  <a class='fa fa-facebook' href='#'></a>
	</div>
  </div>
</div>
</div>