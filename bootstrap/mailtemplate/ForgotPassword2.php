<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf8' />
        <style type='text/css'>
            body {
                background-color:#ffffff; 
                color:#000000; 
                font-family:Open Sans; 
                text-align:center;
            }            
            .holder {
                background-color: #f9f9f9;
                border: 1px solid #9a9a9a;
                font-size: 9px;
                height: 99%;
                overflow: hidden;
                text-align: left;
                width: 100%;
            }
            .header {
                font-size:10px; 
                padding:10px 0;
                width:100%;
                text-align: center;
                border-bottom: 2px solid #ccc;
            }
            .content {
                font-size:16px; 
                padding:10px; 
                width:100%;
            }
            .content-line {
                padding:5px;
            }
            .content-line>a:hover{
                color: rgb(228, 25, 33);
            }
            .footer {
                background-color: rgb(228, 25, 33);
                border-top: 2px solid rgb(228, 25, 33);
                bottom: 0;
                color: #fff;
                font-size: 14px;
                height: 20px;
                left: 0;
                overflow: hidden;
                padding: 10px 0;
                position: fixed;
                text-align: center;
                width: 100%;
            }
            .footer > a {
                color: #fff;
                text-decoration: none;
            }

            @media all and (max-width: 420px) {
                img{width: 90%;}
                .content{font-size: 14px;}
                .footer{bottom: 12px;width: 95%}
            }
        </style>
    </head>
    <body>
        <div class='holder'>
            <div class='header'>
                <!--img src='$path/bootstrap/site/images/logo.png' alt='logo' /-->
                <h1>Parklane</h1>
            </div>
            <div class='content'>
                <div class='content-line'>Dear <strong>$name,</strong></div>
                <div class='content-line'>
                    Your credentials are :<br/>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><strong>$username</strong></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><strong>$password</strong></td>
                        </tr>                        
                    </table>
                </div>                
                <div class='content-line'>
                    <hr/>
                    Team <strong>Parklane</strong>
                </div>
            </div>                       
        </div>    
        <div class="footer">
            <a href="$sitename">Parklane</a>
        </div> 
    </body>
</html>