@extends('admin.inner.app')

@section('content')
<div class="inner-content">
    <section id="error-page">
        <div class="error-page-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <div class="bg-404">
                                <div class="error-image">       
                                    {{-- <h2>NO PERMISSION !</h2>                          --}}
                                    <img class="img-responsive" src="{{URL::asset('/images/common/errors/notAllow.png')}}" alt="">
                                </div>
                            </div>
                            <h2>SORRY ! YOU HAVE NO PERMISSION !</h2>
                            <p>Sorry! The page you are looking for not allowed, you may need some help for the Administrators.</p>
                            <p>对不起！ 该页面您暂无访问权限，你可能需要找管理员授权！</p>
                            {{-- <a href="javascript:void(0);" onclick="javascript:window.location.reload();" class="btn btn-error">TRY AGAIN</a>
                            <div class="social-link">
                                <span><a href="#" onclick="javascript:window.history.back();">GO BACK</a></span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script-top')
<link href="{{URL::asset('/include/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('/css/admin/sys/errors/404.min.css')}}" rel="stylesheet">
@endsection

@section('script-foot')
<script type="text/javascript" src="{{URL::asset('/include/jquery/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/include/bootstrap/js/bootstrap.min.js')}}"></script>
@endsection