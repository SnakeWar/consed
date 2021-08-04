<!DOCTYPE html>

<html lang="pt-br">

	@include('pages.layouts.blocks._head')

	<body>

		@include('pages.layouts.blocks._header')

		@yield('content')



		@include('pages.layouts.blocks._footer')

		@include('pages.layouts.blocks._scripts')

	</body>

</html>

