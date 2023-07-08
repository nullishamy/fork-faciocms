<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error - FacioCMS | <?php echo $error; ?></title>

        <style id="faciocms-error-styles">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: sans-serif;
            }

            body {
                background: rgb(16, 16, 17);
                height: 100vh;
            }

            .flex {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                color: #fff;
            }

            h1 {
                font-size: 72px;
                color: rgb(252, 51, 51);
            }

            h3 {
                font-size: 36px;
                color: #aaa;
                margin-top: 16px;
            }

            .app-logo {
                margin-top: -192px;
                margin-bottom: 32px;
            }
        </style>
    </head>
    <body>
        <div class="flex">
            <img src="/faciocms.png" alt="" class="app-logo">
            <h1>FacioCMS Error</h1>
            <h3><?php echo $error; ?></h3>
        </div>
    </body>
</html>