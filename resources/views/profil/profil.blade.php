@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="/css/profil.css"></link>

    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true">Informations personnelles</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                           role="tab" aria-controls="nav-contact" aria-selected="false">Mes contacts</a>
                        <a class="nav-item nav-link" id="nav-portfolios-tab" data-toggle="tab" href="#nav-portfolios"
                           role="tab" aria-controls="nav-portfolios" aria-selected="false">Mes portfolios</a>
                        <a class="nav-item nav-link" id="nav-groupes-tab" data-toggle="tab" href="#nav-groupes"
                           role="tab" aria-controls="nav-groupes" aria-selected="false">Mes groupes</a>
                        <a class="nav-item nav-link" id="nav-Edit-tab" data-toggle="tab" href="#nav-Edit" role="tab"
                           aria-controls="nav-Edit" aria-selected="false">Editer votre profil</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form method="post" action="#">

                            @php
                                $user = Auth::user();
                            @endphp

                            Nom : {{ $user->name }}<br>
                            Prénom : {{ $user->firstName }}<br>
                            Email : {{ $user->email }}<br>
                            Emploi : {{ $user->job }}<br>
                            Secteur d'activité : {{ $user->businessSegment }}<br>
                            Rue : {{ $user->streetAddress }}<br>
                            Ville : {{ $user->cityAddress }}<br>
                            Code Postal : {{ $user->postCodeAddress }}<br>
                            Pays : {{ $user->country }}<br>
                            Téléphone portable : {{ $user->mobilePhone }}<br>
                            Téléphone de travail : {{ $user->businessPhone }}<br>
                            <div class="form-group">
                                <label for="newDescription">Description : <br></label>
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" name="newDescription" rows="3" placeholder="{{ $user->description }}"  ></textarea>
                            </div>

                        </form>
                    </div>


                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        2
                    </div>


                    <div class="tab-pane fade" id="nav-portfolios" role="tabpanel" aria-labelledby="nav-portfolios-tab">

                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-pages-tab" data-toggle="tab"
                                   href="#nav-pages" role="tab" aria-controls="nav-pages" aria-selected="true">Pages</a>
                                <a class="nav-item nav-link" id="nav-collections-tab" data-toggle="tab"
                                   href="#nav-collections" role="tab" aria-controls="nav-collections"
                                   aria-selected="false">Collections</a>
                            </div>
                        </nav>


                        <div class="tab-pane fade show active" id="nav-pages" role="tabpanel"
                             aria-labelledby="nav-pages-tab">

                        </div>


                        <div class="tab-pane fade show active" id="nav-collections" role="tabpanel"
                             aria-labelledby="nav-collections-tab">

                        </div>

                    </div>


                    <div class="tab-pane fade" id="nav-groupes" role="tabpanel" aria-labelledby="nav-groupes-tab">
                        @if(count($groups) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nom du groupe</th>
                                    <th scope="col">Nombre de personnes dans le groupe</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)

                                    <tr>
                                        <td>{{ $group->group->name }}</td>
                                        <td>{{ $group->members }}</td>
                                        <td><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#exitModal" >Quitter</button></td>
                                    </tr>
                                    <!-- modal exit group  -->
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exitModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Quitter le groupe</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Voulez-vous vraiment quitter le groupe ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('userGroup.destroy', $group->id)}}" type="button" class="btn btn-danger">Supprimer</a>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <td>Vous n'appartenez actuellement à aucun groupe.</td>
                                @endif

                            </table>
                    </div>



                <div class="tab-pane fade" id="nav-Edit" role="tabpanel" aria-labelledby="nav-Edit-tab">


                    <form method="POST" action="{{route('profil.update',$user->id)}}">
                        @csrf
                        @method('PUT')
                        <label for="newName">Nom</label>
                        <input type="text" name="newName" value="{{ $user->name }}"><br>

                        <label for="newFirstname">Prénom</label>
                        <input type="text" name="newFirstname" value="{{ $user->firstName }}"><br>

                        <label for="newEmail">Email</label>
                        <input type="email" id="inputEmail" @error('email') is-invalid @enderror" name="newEmail"
                        value="{{ $user->email }}"  autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                        <label for="newJob">Emploi</label>
                        <input type="text" name="newJob" value="{{ $user->job }}"><br>

                        <label for="newJobSegment">Secteur d'activité</label>
                        <input type="text" name="newJobSegment" value="{{ $user->businessSegment }}"><br>

                        <label for="newStreet">Rue</label>
                        <input type="text" name="newStreet" value="{{ $user->streetAddress }}"><br>

                        <label for="newCity">Ville</label>
                        <input type="text" name="newCity" value="{{ $user->cityAddress }}"><br>

                        <label for="newPostalCode">Code Postal</label>
                        <input type="text" name="newPostalCode" value="{{ $user->postCodeAddress }}"><br>

                        <label for="newCountry">Pays</label>
                        <input type="text" name="newCountry" value="{{ $user->country }}"><br>

                        <label for="newMobilePhone">Téléphone portable</label>
                        <input type="text" name="newMobilePhone" value="{{ $user->mobilePhone }}"><br>

                        <label for="newWorkPhone">Téléphone de travail</label>
                        <input type="text" name="newWorkPhone" value="{{ $user->businessPhone }}"><br>


                        <div class="form-group">
                            <label for="newDescription">Description (255 caractères maximum) :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="newDescription" rows="3" >{{ $user->description }}</textarea>
                        </div>


                        <input type="submit" name="submit" value="Mettre à jour mon profil">
                    </form>


                </div>

            </div>

        </div>
    </div>


@endsection
