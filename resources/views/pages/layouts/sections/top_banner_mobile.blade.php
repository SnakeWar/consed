<a href="{{ route('banner_hit', [ 'slug' => $banner->slug ] )}}" target="_blank">
    <img class="w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banner->file_mobile ? $banner->file_mobile : $banner->file)) }}" alt="">
</a>