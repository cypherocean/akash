@extends('admin.layout.app')

@section('meta')
@endsection

@section('title')
    Settings
@endsection

@section('styles')
<link href="{{ asset('admin/assets/css/dropify.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/assets/css/sweetalert2.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
    @php
        $tab = 'general';

        if(\Session::has('tab'))
            $tab = \Session::get('tab');

    @endphp

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Settings</div>
                    </div>
                    <ul class="nav nav-tabs nav-fill">
                        <li class="nav-item">
                            <a class="nav-link @if($tab == 'general') active @endif" href="#general" data-toggle="tab" aria-expanded="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($tab == 'smtp') active @endif" href="#smtp" data-toggle="tab" aria-expanded="false">SMTP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($tab == 'logo') active @endif" href="#logo" data-toggle="tab" aria-expanded="false">Logo</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if($tab == 'general') active show @else fade @endif" id="general" aria-expanded="true">
                            <div class="row m-2">
                                <div class="col-sm-12">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @method('post')
                                        @csrf
                                        <input type="hidden" name="tab" value="general">

                                        @if(isset($general) && $general->isNotEmpty())
                                            @foreach($general as $row)
                                                <div class="form-group">
                                                    <label><b>{{ strtoupper(str_replace('_', ' ', $row->key)) }}</b></label>
                                                    <input type="text" name="{{ $row->id }}" class="form-control" value="{{ $row->value }}" placeholder="{{ strtoupper(str_replace('_', ' ', $row->key)) }}" />
                                                </div>
                                            @endforeach
                                        @endif
                                        <input type="submit" value="Save" class="btn btn-primary mb-3">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if($tab == 'smtp') active show @else fade @endif" id="smtp" aria-expanded="false">
                            <div class="row m-2">
                                <div class="col-sm-12">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @method('post')
                                        @csrf
                                        <input type="hidden" name="tab" value="smtp">

                                        @if(isset($smtp) && $smtp->isNotEmpty())
                                            @foreach($smtp as $row)
                                                <div class="form-group">
                                                    <label><b>{{ strtoupper(str_replace('_', ' ', $row->key)) }}</b></label>
                                                    <input type="text" name="{{ $row->id }}" class="form-control" value="{{ $row->value }}" placeholder="{{ strtoupper(str_replace('_', ' ', $row->key)) }}" />
                                                </div>
                                            @endforeach
                                        @endif
                                        <input type="submit" value="Save" class="btn btn-primary mb-3">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if($tab == 'logo') active show @else fade @endif" id="logo" aria-expanded="false">
                            <form action="{{ route('settings.update.logo') }}" method="post" enctype="multipart/form-data">
                                <div class="row m-2">
                                    @method('post')
                                    @csrf
                                    <input type="hidden" name="tab" value="logo">
                                    @if(isset($logo) && $logo->isNotEmpty())
                                        @foreach($logo as $row)
                                        <div class="form-group col-sm-12">
                                            <label><b>{{ strtoupper(str_replace('_', ' ', $row->key)) }}</b></label>
                                            <input type="file" class="form-control dropify" id="{{ $row->key }}" name="{{ $row->key }}" data-default-file="{{ url('uploads/logo').'/'.$row->value ?? '' }}" data-show-remove="false" data-height="200" data-max-file-size="3M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg JPG PNG JPEG" data-max-file-size-preview="3M" />
                                            <span class="kt-form__help error {{ $row->key }}"></span>
                                        </div>
                                        @endforeach
                                    @endif
                                    <input type="submit" value="Save" class="btn waves-effect waves-light btn-rounded btn-outline-primary mb-3 ml-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('admin/assets/js/dropify.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/promise.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/sweetalert2.bundle.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop profile image here or click',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        var drEvent = $('.dropify').dropify();
    });
</script>
@endsection
