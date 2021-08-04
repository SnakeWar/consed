@extends('adminlte::page')

@section('content_header')
    <h1>Configurações</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Destaque</h3>
                </div>
                <form role="form" id="featured-form" method="POST" action="{{ route('settings.store')}}">
                    @csrf
                    <div data-repeater-list="value" class="box-body">
                        <input type="hidden" name="key" value="featured">

                        <div class="form-group">
                            <label for="input-type-featured">Tipo</label>
                            <select class="form-control select2" name="value[type]" id="input-type-featured" style="width: 100%;">
                                @if(isset($featured->type))
                                    <option value="posts" {{ $featured->type === 'posts' ? 'selected' : '' }}>Posts</option>
                                    <option value="video" {{ $featured->type === 'video' ? 'selected' : '' }}>Video</option>
                                @else
                                    <option value="posts" selected>Posts</option>
                                    <option value="video">Video</option>
                                @endif
                            </select>
                        </div>

                        <div style="display: {{ (isset($featured->type) && $featured->type === 'video') ? 'block' : 'none' }}" class="form-group">
                            <label for="input-video-url">Url do video</label>
                            <input type="text" name="value[url]" class="form-control" id="input-video-url" placeholder="Url do video" value="{{ isset($featured->url) ? $featured->url : '' }}" {{ (isset($featured->type) && $featured->type === 'video') ? '' : 'disabled="disabled"' }}>
                        </div>
                    </div>

                    <div class="box-footer" style="border-top: none">
                        <div class="col-lg-3">
                            <button type="submit" style="margin-bottom: 20px" class="btn-block btn-lg btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Categoria destaque</h3>
                </div>
                <form role="form" id="featured-form" method="POST" action="{{ route('settings.store')}}">
                    @csrf
                    <div data-repeater-list="value" class="box-body">
                        <input type="hidden" name="key" value="category_featured">

                        <div class="form-group">
                            <label for="input-type-featured">Categoria</label>
                            <select class="form-control select2" name="value[category_id]" id="input-type-featured" style="width: 100%;">
                                @if(isset($category_featured->category_id))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $category_featured->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                @else
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="box-footer" style="border-top: none">
                        <div class="col-lg-3">
                            <button type="submit" style="margin-bottom: 20px" class="btn-block btn-lg btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Categoria secundaria</h3>
                </div>
                <form role="form" id="featured-form" method="POST" action="{{ route('settings.store')}}">
                    @csrf
                    <div data-repeater-list="value" class="box-body">
                        <input type="hidden" name="key" value="category_secondary">

                        <div class="form-group">
                            <label for="input-type-secondary">Categoria</label>
                            <select class="form-control select2" name="value[category_id]" id="input-type-secondary" style="width: 100%;">
                                @if(isset($category_secondary->category_id))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $category_secondary->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                @else
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="box-footer" style="border-top: none">
                        <div class="col-lg-3">
                            <button type="submit" style="margin-bottom: 20px" class="btn-block btn-lg btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu</h3>
                </div>
                <form role="form" class="repeater-menu" id="menu-form" method="POST" action="{{ route('settings.store')}}">
                    @csrf
                    <div data-repeater-list="value" class="box-body">

                        <input type="hidden" name="key" value="menu">


                        @forelse($menus as $menu)
                            <div data-repeater-item class="father-element">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-type">Tipo:</label>
                                            <select class="form-control select2 type-input" name="type" id="input-type" style="width: 100%;">
                                                <option value="categories" {{ $menu->type === 'categories' ? 'selected' : '' }}>Categoria</option>
                                                <option value="pages" {{ $menu->type === 'pages' ? 'selected' : '' }}>Pagina</option>
                                                <option value="submenu" {{ $menu->type === 'submenu' ? 'selected' : '' }}>Submenu</option>
                                                <option value="url" {{ $menu->type === 'url' ? 'selected' : '' }}>URL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-open">Abrir em:</label>
                                            <select class="form-control select2" name="open-type" id="input-open" style="width: 100%;">
                                                <option value="_self" {{ $menu->{'open-type'} === '_self' ? 'selected' : '' }}>Mesma aba</option>
                                                <option value="_blank" {{ $menu->{'open-type'} === '_blank' ? 'selected' : '' }}>Nova aba</option>
                                                <option value="popup" {{ $menu->{'open-type'} === 'popup' ? 'selected' : '' }}>Popup</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div style="display: {{ $menu->type === 'url' ? 'block' : 'none' }};" class="form-group url-input-group menu-groups">
                                            <label for="input-title">Titulo</label>
                                            <input type="text" name="title" {{ $menu->type === 'url' ? '' : 'disabled="disabled"' }} class="form-control url-input menu-inputs" id="input-title" placeholder="Titulo" value="{{ isset($menu->title) ? $menu->title : '' }}">
                                        </div>

                                        <div style="display: {{ $menu->type === 'url' ? 'block' : 'none' }};" class="form-group url-input-group menu-groups">
                                            <label for="input-url">URL</label>
                                            <input type="text" name="url" {{ $menu->type === 'url' ? '' : 'disabled="disabled"' }} class="form-control url-input menu-inputs" id="input-url" placeholder="Link" value="{{ isset($menu->url) ? $menu->url : '' }}">
                                        </div>

                                        <div style="display: {{ $menu->type === 'categories' ? 'block' : 'none' }};" class="form-group categories-input-group menu-groups">
                                            <label for="input-url">Categoria</label>
                                            <select class="form-control select2 categories-input menu-inputs" {{ $menu->type === 'categories' ? '' : 'disabled="disabled"' }} name="id" id="input-categories" style="width: 100%;">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == (isset($menu->id) ? $menu->id : '') ? 'selected' : '' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display: {{ $menu->type === 'pages' ? 'block' : 'none' }};" class="form-group pages-input-group menu-groups">
                                            <label for="input-url">Paginas</label>
                                            <select class="form-control select2 pages-input menu-inputs" {{ $menu->type === 'pages' ? '' : 'disabled="disabled"' }} name="id" id="input-pages" style="width: 100%;">
                                                @foreach($pages as $page)
                                                    <option value="{{ $page->slug }}" {{ $page->slug === (isset($menu->id) ? $menu->id : '') ? 'selected' : '' }}>{{ $page->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display: {{ $menu->type === 'submenu' ? 'block' : 'none' }};background-color: #ccd0d6;padding: 20px;margin: 20px 35px;" class="submenu-input-group menu-groups">
                                            <label>Submenus</label>

                                            <div class="form-group submenu-input-group menu-groups">
                                                <label for="input-title">Titulo</label>
                                                <input type="text" name="title" {{ $menu->type === 'submenu' ? '' : 'disabled="disabled"' }} class="form-control submenu-input menu-inputs" id="input-title" placeholder="Titulo" value="{{ isset($menu->title) ? $menu->title : '' }}">
                                            </div>

                                            <div class="repeater-submenu">
                                                <div data-repeater-list="submenus" class="box-body">

                                                    @forelse($menu->submenus as $submenu)
                                                        <div data-repeater-item class="father-element">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="input-type">Tipo:</label>
                                                                        <select class="form-control select2 type-input" name="type" id="input-type" style="width: 100%;">
                                                                            <option value="categories" {{ $submenu->type === 'categories' ? 'selected' : '' }}>Categoria</option>
                                                                            <option value="pages" {{ $submenu->type === 'pages' ? 'selected' : '' }}>Pagina</option>
                                                                            <option value="url" {{ $submenu->type === 'url' ? 'selected' : '' }}>URL</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="input-open">Abrir em:</label>
                                                                        <select class="form-control select2" name="open-type" id="input-open" style="width: 100%;">
                                                                            <option value="_self" {{ $submenu->{'open-type'} === '_self' ? 'selected' : '' }}>Mesma aba</option>
                                                                            <option value="_blank" {{ $submenu->{'open-type'} === '_blank' ? 'selected' : '' }}>Nova aba</option>
                                                                            <option value="popup" {{ $submenu->{'open-type'} === 'popup' ? 'selected' : '' }}>Popup</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div style="display: {{ $submenu->type === 'url' ? 'block' : 'none' }};" class="form-group url-input-group menu-groups">
                                                                        <label for="input-title">Titulo</label>
                                                                        <input type="text" name="title" {{ $submenu->type === 'url' ? '' : 'disabled="disabled"' }} class="form-control url-input menu-inputs" id="input-title" placeholder="Titulo" value="{{ isset($submenu->title) ? $submenu->title : '' }}">
                                                                    </div>

                                                                    <div style="display: {{ $submenu->type === 'url' ? 'block' : 'none' }};" class="form-group url-input-group menu-groups">
                                                                        <label for="input-url">URL</label>
                                                                        <input type="text" name="url" {{ $submenu->type === 'url' ? '' : 'disabled="disabled"' }} class="form-control url-input menu-inputs" id="input-url" placeholder="Link" value="{{ isset($submenu->url) ? $submenu->url : '' }}">
                                                                    </div>

                                                                    <div style="display: {{ $submenu->type === 'categories' ? 'block' : 'none' }};" class="form-group categories-input-group menu-groups">
                                                                        <label for="input-url">Categoria</label>
                                                                        <select class="form-control select2 categories-input menu-inputs" {{ $submenu->type === 'categories' ? '' : 'disabled="disabled"' }} name="id" id="input-categories" style="width: 100%;">
                                                                            @foreach($categories as $category)
                                                                                <option value="{{ $category->id }}" {{ $category->id == (isset($submenu->id) ? $submenu->id : '') ? 'selected' : '' }}>{{ $category->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div style="display: {{ $submenu->type === 'pages' ? 'block' : 'none' }};" class="form-group pages-input-group menu-groups">
                                                                        <label for="input-url">Paginas</label>
                                                                        <select class="form-control select2 pages-input menu-inputs" {{ $submenu->type === 'pages' ? '' : 'disabled="disabled"' }} name="id" id="input-pages" style="width: 100%;">
                                                                            @foreach($pages as $page)
                                                                                <option value="{{ $page->slug }}" {{ $page->slug === (isset($submenu->id) ? $submenu->id : '') ? 'selected' : '' }}>{{ $page->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <button type="button" data-repeater-delete style="display: flex;align-items: center;justify-content: center;" class="btn-block btn-lg btn-danger">
                                                                        <i class="fa fa-minus" style="margin-right: 10px"></i>Remover
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <hr/>

                                                        </div>
                                                    @empty
                                                        <div data-repeater-item class="father-element">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="input-type">Tipo:</label>
                                                                        <select class="form-control select2 type-input" name="type" id="input-type" style="width: 100%;">
                                                                            <option value="categories">Categoria</option>
                                                                            <option value="pages">Pagina</option>
                                                                            <option value="url">URL</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="input-open">Abrir em:</label>
                                                                        <select class="form-control select2" name="open-type" id="input-open" style="width: 100%;">
                                                                            <option value="_self">Mesma aba</option>
                                                                            <option value="_blank">Nova aba</option>
                                                                            <option value="popup">Popup</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div style="display: none;" class="form-group url-input-group menu-groups">
                                                                        <label for="input-title">Titulo</label>
                                                                        <input type="text" name="title" disabled="disabled" class="form-control url-input menu-inputs" id="input-title" placeholder="Titulo">
                                                                    </div>

                                                                    <div style="display: none;" class="form-group url-input-group menu-groups">
                                                                        <label for="input-url">URL</label>
                                                                        <input type="text" name="url" disabled="disabled" class="form-control url-input menu-inputs" id="input-url" placeholder="Link">
                                                                    </div>

                                                                    <div style="display: none;" class="form-group categories-input-group menu-groups">
                                                                        <label for="input-url">Categoria</label>
                                                                        <select class="form-control select2 categories-input menu-inputs" disabled="disabled" name="id" id="input-categories" style="width: 100%;">
                                                                            @foreach($categories as $category)
                                                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div style="display: none;" class="form-group pages-input-group menu-groups">
                                                                        <label for="input-url">Paginas</label>
                                                                        <select class="form-control select2 pages-input menu-inputs" disabled="disabled" name="id" id="input-pages" style="width: 100%;">
                                                                            @foreach($pages as $page)
                                                                                <option value="{{ $page->slug }}">{{ $page->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <button type="button" data-repeater-delete style="display: flex;align-items: center;justify-content: center;" class="btn-block btn-lg btn-danger">
                                                                        <i class="fa fa-minus" style="margin-right: 10px"></i>Remover
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <hr/>

                                                        </div>
                                                    @endforelse

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <button type="button" data-repeater-create style="display: flex;align-items: center;justify-content: center; margin-bottom: 20px" class="btn-block btn-lg btn-success">
                                                            <i class="fa fa-plus" style="margin-right: 10px"></i>Adicionar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2">
                                        <button type="button" data-repeater-delete style="display: flex;align-items: center;justify-content: center;" class="btn-block btn-lg btn-danger">
                                            <i class="fa fa-minus" style="margin-right: 10px"></i>Remover
                                        </button>
                                    </div>
                                </div>

                                <hr/>
                            </div>
                        @empty
                            <div data-repeater-item class="father-element">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-type">Tipo:</label>
                                            <select class="form-control select2 type-input" name="type" id="input-type" style="width: 100%;">
                                                <option value="categories">Categoria</option>
                                                <option value="pages">Pagina</option>
                                                <option value="submenu">Submenu</option>
                                                <option value="url">URL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-open">Abrir em:</label>
                                            <select class="form-control select2" name="open-type" id="input-open" style="width: 100%;">
                                                <option value="_self">Mesma aba</option>
                                                <option value="_blank">Nova aba</option>
                                                <option value="popup">Popup</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div style="display: none;" class="form-group url-input-group menu-groups">
                                            <label for="input-title">Titulo</label>
                                            <input type="text" name="title" disabled="disabled" class="form-control url-input menu-inputs" id="input-title" placeholder="Titulo">
                                        </div>

                                        <div style="display: none;" class="form-group url-input-group menu-groups">
                                            <label for="input-url">URL</label>
                                            <input type="text" name="url" disabled="disabled" class="form-control url-input menu-inputs" id="input-url" placeholder="Link">
                                        </div>

                                        <div style="display: none;" class="form-group categories-input-group menu-groups">
                                            <label for="input-url">Categoria</label>
                                            <select class="form-control select2 categories-input menu-inputs" disabled="disabled" name="id" id="input-categories" style="width: 100%;">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display: none;" class="form-group pages-input-group menu-groups">
                                            <label for="input-url">Paginas</label>
                                            <select class="form-control select2 pages-input menu-inputs" disabled="disabled" name="id" id="input-pages" style="width: 100%;">
                                                @foreach($pages as $page)
                                                    <option value="{{ $page->slug }}">{{ $page->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display: none;background-color: #ccd0d6;padding: 20px;margin: 20px 35px;" class="submenu-input-group menu-groups">
                                            <label>Submenus</label>

                                            <div class="form-group submenu-input-group menu-groups">
                                                <label for="input-title">Titulo</label>
                                                <input type="text" name="title" disabled="disabled" class="form-control submenu-input menu-inputs" id="input-title" placeholder="Titulo">
                                            </div>

                                            <div class="repeater-submenu">
                                                <div data-repeater-list="submenus" class="box-body">

                                                    <div data-repeater-item class="father-element">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="input-type">Tipo:</label>
                                                                    <select class="form-control select2 type-input" name="type" id="input-type" style="width: 100%;">
                                                                        <option value="categories">Categoria</option>
                                                                        <option value="pages">Pagina</option>
                                                                        <option value="url">URL</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="input-open">Abrir em:</label>
                                                                    <select class="form-control select2" name="open-type" id="input-open" style="width: 100%;">
                                                                        <option value="_self">Mesma aba</option>
                                                                        <option value="_blank">Nova aba</option>
                                                                        <option value="popup">Popup</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div style="display: none;" class="form-group url-input-group menu-groups">
                                                                    <label for="input-title">Titulo</label>
                                                                    <input type="text" name="title" disabled="disabled" class="form-control url-input menu-inputs" id="input-title" placeholder="Titulo">
                                                                </div>

                                                                <div style="display: none;" class="form-group url-input-group menu-groups">
                                                                    <label for="input-url">URL</label>
                                                                    <input type="text" name="url" disabled="disabled" class="form-control url-input menu-inputs" id="input-url" placeholder="Link">
                                                                </div>

                                                                <div style="display: none;" class="form-group categories-input-group menu-groups">
                                                                    <label for="input-url">Categoria</label>
                                                                    <select class="form-control select2 categories-input menu-inputs" disabled="disabled" name="id" id="input-categories" style="width: 100%;">
                                                                        @foreach($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div style="display: none;" class="form-group pages-input-group menu-groups">
                                                                    <label for="input-url">Paginas</label>
                                                                    <select class="form-control select2 pages-input menu-inputs" disabled="disabled" name="id" id="input-pages" style="width: 100%;">
                                                                        @foreach($pages as $page)
                                                                            <option value="{{ $page->slug }}">{{ $page->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <button type="button" data-repeater-delete style="display: flex;align-items: center;justify-content: center;" class="btn-block btn-lg btn-danger">
                                                                    <i class="fa fa-minus" style="margin-right: 10px"></i>Remover
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <hr/>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <button type="button" data-repeater-create style="display: flex;align-items: center;justify-content: center; margin-bottom: 20px" class="btn-block btn-lg btn-success">
                                                            <i class="fa fa-plus" style="margin-right: 10px"></i>Adicionar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2">
                                        <button type="button" data-repeater-delete style="display: flex;align-items: center;justify-content: center;" class="btn-block btn-lg btn-danger">
                                            <i class="fa fa-minus" style="margin-right: 10px"></i>Remover
                                        </button>
                                    </div>
                                </div>

                                <hr/>
                            </div>
                        @endforelse

                    </div>

                    <div class="box-footer" style="border-top: none">
                        <div class="col-lg-3">
                            <button type="button" data-repeater-create style="display: flex;align-items: center;justify-content: center; margin-bottom: 20px" class="btn-block btn-lg btn-success">
                                <i class="fa fa-plus" style="margin-right: 10px"></i>Adicionar
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" style="margin-bottom: 20px" class="btn-block btn-lg btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.repeater-menu').repeater({
                initEmpty: false,
                repeaters: [{
                    selector: '.repeater-submenu',
                }],
                show: function () {
                    $(this).slideDown();
                    $(this).find('.menu-inputs').prop('disabled', 'disabled');
                    $(this).find('.menu-groups').css('display', 'none');
                },
                hide: function (deleteElement) {
                    if(confirm('Você deseja deletar este item do menu?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
            })

            $(document.body).on('change select2:select', '.type-input', function() {
                let value = this.value;
                $(this).closest('.father-element').find('.menu-inputs').prop('disabled', 'disabled');
                $(this).closest('.father-element').find('.menu-groups').css('display', 'none');

                $(this).closest('.father-element').find('.' + value + '-input-group').css('display', 'block');
                $(this).closest('.father-element').find('.' + value + '-input').prop('disabled', false);
            });

            $(document.body).on('change select2:select', '#input-type-featured', function() {
                let value = this.value;

                if (value === 'video') {
                    $('#input-video-url').parent('.form-group').css('display', 'block');
                    $('#input-video-url').prop('disabled', false);
                }

                if (value === 'posts') {
                    $('#input-video-url').prop('disabled', 'disabled');
                    $('#input-video-url').parent('.form-group').css('display', 'none');
                }
            });
        });
    </script>
@stop