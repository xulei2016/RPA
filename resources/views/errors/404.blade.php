<div class="inner-content">
    <section id="error-page">
        <div class="error-page-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <div class="bg-404">
                                <div class="error-image">                                
                                    <img class="img-responsive" src="{{URL::asset('/images/common/errors/404.png')}}" alt="">
                                </div>
                            </div>
                            <h2>PAGE NOT FOUND</h2>
                            <p>The page you are looking for might have been removed, had its name changed.</p>
                            <a href="javascript:void(0);" onclick="javascript:window.location.reload();" class="btn btn-error">TRY AGAIN</a>
                            <div class="social-link">
                                <span><a href="#" onclick="javascript:window.history.back();">GO BACK</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link href="{{URL::asset('/css/admin/sys/errors/404.min.css')}}" rel="stylesheet">