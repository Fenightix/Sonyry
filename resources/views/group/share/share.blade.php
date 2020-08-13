@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="ml-3 w-75">
            <h1>Documents partagés avec le groupe</h1>
            <hr>
            <div class="container-fluid">
                @foreach($group->directories as $directory)
                <button class="btn btn-light text-left h-100 container-fluid border-dark" type="button" data-toggle="collapse" data-target="#{{ $directory->id }}">
                    {{ $directory->name }}
                </button>
                <div class="collapse" id="{{ $directory->id }}">
                    <div class="card card-body">
                        <div class="row">
                            @foreach($directory->user->sharesGroups as $page)
                                @if($page->group_id === $group->id)
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $page->page->title }}</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($page->page->image === 'default_page.png')
                                                <img src="/storage/default/{{ $page->page->image }}" height="100px">
                                            @else
                                                <img src="/storage/pages/{{ $page->page->user_id }}/{{ $page->page->image }}" height="100px">
                                            @endif
                                        </div>
                                        <div class="card-footer text-center">

                                            <div class="btn-group dropup">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('is-page-owner', $page->page )
                                                    <a class="dropdown-item" href="#">
                                                        Consulter
                                                    </a>

                                                    @elsecan('can-read-page-policy', $page)
                                                        <a class="dropdown-item" href="#">
                                                            Consulter
                                                        </a>
                                                    @endcan

                                                    @can('is-page-owner', $page->page)
                                                            <a class="dropdown-item" href="{{ route('page.edit', $page->page->id) }}">
                                                                Editer
                                                            </a>
                                                    @elsecan('can-edit-page-policy', $page)
                                                            <a class="dropdown-item" href="{{ route('page.edit', $page->page->id) }}">
                                                                Editer
                                                            </a>
                                                    @endcan

                                                    @can('is-page-owner', $page->page)
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="{{ route('policies.edit', [
                                                        'page'=>$page->page,
                                                        'id'=>$group->id
                                                         ]) }}" >
                                                                Autorisations de la page
                                                            </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@stop