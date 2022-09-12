@extends('Template.template')
@section('vue')
<html>
<form id="selectform" method="POST" action="{{ route('fiche.Store') }}">
    @csrf
    <div class="card">
       <div class="white_shd full margin_bottom_30">
            <div class="full graph_head" id="entete">
                <div class="heading1 margin_0">
                    <h2 style="color: white;"><i class="fa fa-file-text-o"></i> NOUVELLE FICHE DE CONTROLE PHYSIQUE ET CONTROLE CONDITIONNEMENT</h2>
                </div>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            <p>{{session('success')}}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="solidInput">N° Fiche</label>
                                @foreach($details as $fiche)
                                <input type="number" id="idF" name="idF" value="{{$fiche->id_Fiche}}" class="form-control" />
                                @endforeach
                            </div>
                            <label for="email">Designation</label>
                            @foreach($details as $d)
                            <input type="text" value="{{$d->AR_Design}}" autocomplete="off" class="form-control" disabled />
                            <input type="hidden" value="{{$d->AR_Ref}}" autocomplete="off" id="AR_Ref" name="AR_Ref" class="form-control" />
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="squareSelect">Forme</label>
                            @foreach($details as $d)
                            <select class="form-control input-square" id="forme" name="forme">
                                <option value="{{$d->FO_ref}}" selected>{{$d->FO_designation}}</option>
                                @foreach($forme as $forme)
                                <option value="{{$forme->FO_ref}}">{{$forme->FO_designation}}</option>
                                @endforeach
                            </select>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="pillInput">Dosage</label>
                            @foreach($details as $dosage)
                            <input type="text" name="dosage" id="dosage" value="{{$dosage->dosage}}" class="form-control input-pill">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="pillSelect">Presentation</label>
                                    <select class="form-control input-pill" id="presentation" name="presentation">
                                        @foreach($details as $p)
                                        <option value="{{$p->P_ref}}">{{$p->P_Intitule}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="pillSelect">Quantite unitaire</label>
                                    @foreach($details as $p)
                                    <input type="number" min="0" class="form-control input-pill" name="P_quantite" id="P_quantite" value="{{$p->P_quantite}}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="solidInput">N° Lot</label>
                            <input type="text" class="form-control input-solid" id="lot" name="lot" placeholder="N° Lot">
                        </div>
                        <div class="form-group">
                            <label for="solidInput">Date de fabrication</label>
                            @foreach($details as $dt_fab)
                            <input type="date" class="form-control input-solid" id="date_fab" value="{{$dt_fab->date_fab}}" name="date_fab">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Fournisseur</label>
                            @foreach($details as $frns)
                            <input type="text" value="{{$frns->CT_Intitule}}" autocomplete="off" id="popupFrns" class="form-control" disabled />
                            <input type="hidden" value="{{$frns->CT_Num}}" autocomplete="off" id="CT_Num" name="CT_Num" class="form-control" />
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="solidInput">Fabricant</label>
                            @foreach($details as $fab)
                            <input type="text" class="form-control input-solid" id="fabricant" name="fabricant" value="{{$fab->fabricant}}" placeholder="Fabricant">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="solidInput">Quantite</label>
                            @foreach($details as $qte)
                            <input type="Number" class="form-control input-solid" id="quantite" value="{{$qte->quantite}}" name="quantite" placeholder="Quantité">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="pillSelect">Type de stockage</label>
                            @foreach($details as $d)
                            <select class="form-control input-pill" id="t_stockage" name="t_stockage">
                                <option value="{{$d->T_Stockage_ref}}" selected>{{$d->Type_Stockage}}</option>
                                @foreach($stockage as $stockage)
                                <option value="{{$stockage->T_Stockage_ref}}">{{$stockage->Type_Stockage}}</option>
                                @endforeach
                            </select>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="solidInput">Date de Peremption</label>
                            @foreach($details as $peremp)
                            <input type="date" class="form-control input-solid" id="date_peremp" value="{{$peremp->date_peremp}}" name="date_peremp">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="solidInput">Volume</label>
                                    @foreach($details as $volume)
                                    <input type="number" class="form-control input-solid" id="volume" value="{{$volume->volume}}" name="volume">
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <label for="solidInput">Unite</label>
                                    <input type="text" class="form-control input-solid" value="m3" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="solidInput">Poids</label>
                                    @foreach($details as $poids)
                                    <input type="number" class="form-control input-solid" id="poids" value="{{$poids->poids}}" name="poids">
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <label for="solidInput">Unite</label>
                                    <input type="text" class="form-control input-solid" value="Kg" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-end mt-4 col-lg-12">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
            Valider
        </button>
        <button type="submit" onclick="reset()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-danger">
            Reinitialiser
        </button>
    </div>
</form>

</html>
@endsection