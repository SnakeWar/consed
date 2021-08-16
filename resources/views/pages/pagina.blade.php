@extends('pages.layouts.layout')

@section('content')

<section class="section-new" id="Lorem ipsum dolor imet">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="title-section blue">{{ $pagina->title }}</h1>
				<div class="box-new-inner">
					<div class="box-new-inner-header">
						<h2 class="box-new-inner-header-image" style="background-image: url('{{ asset("storage/pages/{$pagina->file}") }}');"></h2>
						<!-- <small class="box-new-inner-header-date">Publicada por: {{$noticia->author}} </small> -->
						<div class="box-new-inner-body">
							<div class="text-area">
								{!! $pagina->content !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	
@endsection