@extends('realtor::layouts.admin')

@section('content')


    <div class="row">
        <div class="md-col-12">

            <transition name="">
                <router-view></router-view>
            </transition>
        </div>
    </div>


@endsection
