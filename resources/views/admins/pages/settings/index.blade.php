@extends('layouts.app')

@section('title', "Parametre de l'application")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Settings</h3>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <ul class="preview-btn-list preview-btn-list-fw">
                                        <li class="preview-btn-item  col-sm-4 col-lg-2">
                                            <a href="#" class="btn btn-outline-gray">
                                                <em class="icon ni ni-map-pin-fill"></em>
                                                <span>Seed Country</span>
                                            </a>
                                        </li>
                                        <li class="preview-btn-item ml-2 col-sm-4 col-lg-2">
                                            <a href="#" class="btn btn-outline-primary">
                                                <em class="icon ni ni-map"></em>
                                                <span>Seed City</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
