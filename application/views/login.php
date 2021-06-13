
<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<head>
<title>Login Page</title>
<Made with love by Mutiullah Samim 

<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!--Custom styles-->
<link rel="stylesheet"  href="/CodeIgniterform/css/login.css">

</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Sign In</h3>
            </div>
            <div class="card-body">

                <form id="form">

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input
                        type="text"
                        id="mail"
                        name="mail"
                        class="form-control"
                        placeholder="mail_address"
                        value="">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input
                        type="password"
                        id="pass"
                        name="pass"
                        class="form-control" 
                        placeholder="password"
                        value="">
                    </div>

                    <div class="form-group">
                        <input
                        type="submit"
                        class="btn float-right login_btn"
                        name="login_submit">
                    </div>
					
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Don't have an account?<a href="#"></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="http://localhost/CodeIgniterform/form/index">登録する</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $('#form').on('submit', function() {
            event.preventDefault();
            $.ajax({
                url: 'http://localhost/CodeIgniterform/form/pass_check',
                type: 'POST',
                data: {
                    'mail':$('#mail').val(),
                    'pass':$('#pass').val()
                },
                datatype: 'json'
            }).then(
            function (data) {
                window.location.href = "http://localhost/CodeIgniterform/form/edit";
            },
            function (error) {
                let err_msg = JSON.parse(error.responseText);
                alert(err_msg.message);
            })
        });
    </script>
<!-- <script src="js/main.js"></script> -->
</body>
</html>