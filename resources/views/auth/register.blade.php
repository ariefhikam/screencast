<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | ScreenCasters</title>

<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/admin/css/datepicker3.css" rel="stylesheet">
<link href="/assets/admin/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <h1>ScreenCasters</h1>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Sign Up</div>
                <div class="panel-body">
                    <form role="form" role="form" method="POST" action="{{ url('/register') }}">
                    	{{ csrf_field() }}
                        <fieldset>
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"">
                                <input class="form-control" placeholder="Full Name" name="name" type="email" autofocus="" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" placeholder="Re-Type Password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i> Sign Up</button>
                            <a class="btn btn-link" href="{{ url('/login') }}">Have an account?</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    
    
        

    <script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <!-- <script src="/assets/admin/js/chart.min.js"></script>
    <script src="/assets/admin/js/chart-data.js"></script>
    <script src="/assets/admin/js/easypiechart.js"></script>
    <script src="/assets/admin/js/easypiechart-data.js"></script>
    <script src="/assets/admin/js/bootstrap-datepicker.js"></script> -->
    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){        
                $(this).find('em:first').toggleClass("glyphicon-minus");      
            }); 
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
          if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
          if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>   
</body>

</html>
