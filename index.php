<html lang="en">
<head>
    
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>THIS IS A TEST SITE</title></title>
	<meta name="description" content="THIS IS A TEST SITE">
	<meta name="author" content="S&T">
    <link rel="image_src" href="http://stugl.com/images/otp_logo.svg" />
    <meta property="og:image"content="http://stugl.com/images/otp_logo.svg" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" type="text/css" href="stylesheets/base.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/skeleton.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/layout.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#submit_btn").click(function() { 
            //get input field values
            var user_name       = $('input[name=name]').val(); 
            var user_phone      = $('input[name=phone]').val();

            //simple validation at client's end
            //we simply change border color to red if empty field using .css()
                //data to be sent to server
                post_data = {'userName':user_name, 'userPhone':user_phone};

                //Ajax post data to server
                $.post('user_signup.php', post_data, function(response){  

                    //load json data from server and output message     
                    if(response.type == 'error')
                    {
                        output = '<div class="error">'+response.text+'</div>';
                    }else{
                        output = '<div class="success">'+response.text+'</div>';

                        //reset values in all input fields
                        $('#contact_form input').val(''); 
                        $('#contact_form textarea').val(''); 
                    }

                    $("#result").hide().html(output).slideDown();
                }, 'json');

        });

        //reset previously set border colors and hide all message on .keyup()
        $("#contact_form input, #contact_form textarea").keyup(function() { 
            $("#contact_form input, #contact_form textarea").css('border-color',''); 
            $("#result").slideUp();
        });

    });
    </script>
</head>
<body>
	<div class="container">
        <img id="logo" src="/images/otp_logo.svg" style="padding: 20px 0px" alt="Off Track Planet"/>
        
		<div class="shading sixteen columns">
            <div class="row">
                <div class="offset-by-two twelve columns alpha">
                    <h1 id="landing">
                        The <strong>THIS IS A TESTERRRR SITE</strong> THIS IS A TEST SITE.
                    </h1>
                </div>
            </div>
            
            <div id="signup">
                <fieldset id="contact_form">
                    <div id="result"></div>

                        <div class="row">
                            <h4>What's your mom call you?</h4>
                            <input type="text" name="name" id="name" placeholder="" />
                        </div>

                        <div class="row"> 
                        <h4>What's your cell &#35;?</h4>
                        <input type="text" name="phone" id="phone" placeholder="" />
                        </div>

                        <div class="row">
                        <button class="submit_btn" id="submit_btn">Sign up!</button>
                        </div>
                    
                </fieldset>
            </div>
             
	    </div>
        
    </div><!-- container -->
    
    <div class="bottom">A creation by S&amp;T</div>



<!-- End Document
================================================== -->
</body>
</html>