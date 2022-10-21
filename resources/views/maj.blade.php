@extends('Template.template')
@section('vue')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Mise à jour des données</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Données depuis SAGE</h2>
                        </div>
                    </div>
                    <div class="full graph_head">
                        @if ($errors->any())
                        <div class="alert alert-success">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <!-- column price -->
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="table_price full">
                                    <div class="inner_table_price">
                                        <div class="price_table_head blue1_bg">
                                            <h2>Articles</h2>
                                        </div>
                                        <div class="price_table_inner">
                                            <div class="cont_table_price_blog">
                                                <p class="blue1_color">F_ARTICLE</p>
                                            </div>
                                        </div>
                                        <div class="price_table_bottom">
                                            <div class="center"><a class="main_bt" href="{{ route('majExecute', ['table' => 0]) }}">Mettre à jour</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="table_price full">
                                    <div class="inner_table_price">
                                        <div class="price_table_head green_bg">
                                            <h2>Fournisseurs</h2>
                                        </div>
                                        <div class="price_table_inner">
                                            <div class="cont_table_price_blog">
                                                <p class="green_color">F_COMPTET</p>
                                            </div>
                                        </div>
                                        <div class="price_table_bottom">
                                            <div class="center"><a class="main_bt" href="{{ route('majExecute', ['table' => 1]) }}">Mettre à jour</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end column price -->
                            <!-- column price -->
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="table_price full">
                                    <div class="inner_table_price">
                                        <div class="price_table_head red_bg">
                                            <h2>Article emplacement</h2>
                                        </div>
                                        <div class="price_table_inner">
                                            <div class="cont_table_price_blog">
                                                <p class="red_color">F_ARTSTOCKEMPL</p>
                                            </div>
                                        </div>
                                        <div class="price_table_bottom">
                                            <div class="center"><a class="main_bt" href="{{ route('majExecute', ['table' => 2]) }}">Mettre à jour</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end column price -->
                            <!-- column price -->
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="table_price full">
                                    <div class="inner_table_price">
                                        <div class="price_table_head yellow_bg">
                                            <h2>Depot</h2>
                                        </div>
                                        <div class="price_table_inner">
                                            <div class="cont_table_price_blog">
                                                <p class="yellow_color">F_DEPOT</p>
                                            </div>
                                        </div>
                                        <div class="price_table_bottom">
                                            <div class="center"><a class="main_bt" href="{{ route('majExecute', ['table' => 3]) }}">Mettre à jour</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end column price -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
@endsection