<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title></title>
    </head>
    <body>
        <?php
            require_once('includes.php');
            $obj = new Autenticacao();
            $data = Array();
            $data['username'] = "pauloteixeiras";
            $data['password'] = 'paulo0405';

            $r = $obj->AutenticateUsers($data);

            print_r("retorno: " . $r);
        ?>
    </body>
</html>
