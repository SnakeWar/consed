<section class="mt-4 d-none d-md-block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('banner_hit', [ 'slug' => $banner->slug ] )}}" target="_blank">
                    <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banner->file}") }}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>