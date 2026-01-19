<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: border-box;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left {
            flex: 1;
            background-image: url('/img/bg-logreg.jpg');
            background-size: cover;
            background-position: center;
            filter: brightness(0.6);
        }

        .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .box {
            width: 80%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.92);
            padding: 40px 35px;
            border-radius: 14px;
            position: relative;
        }

        /* logo di kanan atas form */
        .box .logo-small {
            position: absolute;
            top: -60px;
            right: 0px;
            width: 100px;
        }

        h2 {
            color: #004726;
            margin-bottom: 5px;
            font-size: 28px;
            text-align: center;
        }

        p {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #004726;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #dedede;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #004726;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .bottom-text {
            margin-top: 15px;
            text-align: center;
        }

        a {
            color: #004726;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="left"></div>

        <div class="right">
            <div class="box">

                <!-- LOGO DI KANAN ATAS FORM -->
                <img src="/img/logoo.png" class="logo">

                <h2>Selamat Datang, Admin</h2>
                <p>Silakan login untuk mengelola sistem.</p>

                <form method="POST" action="/login">
                    @csrf

                    <label>Email</label>
                    <input type="email" name="email" required>

                    <label>Password</label>
                    <input type="password" name="password" required>

                    <button type="submit">Login</button>
                </form>


            </div>
        </div>

    </div>

</body>

</html>
