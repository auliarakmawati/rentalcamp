<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
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
            position: relative;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(162, 162, 162, 0.45);
        }


        .logo-big {
            position: relative;
            width: 300px; /* ukuran diperbesar */
            z-index: 2;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        /* BAGIAN KANAN */
        .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .box {
            width: 80%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.94);
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
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

        input, select {
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
            font-size: 16px;
        }

        a {
            color: #004726;
            font-weight: bold;
        }

        .bottom-text {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- KIRI -->
        <div class="left">
            <img src="/img/logoo.png" class="logo-big">
        </div>

        <!-- KANAN -->
        <div class="right">
            <div class="box">
                <h2>Buat akun baru!</h2>
                <p>SIlahkan registrasi terlebih dahulu sebelum melakukan penyewaan.</p>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <label for="name">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="masukkan nama" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="masukkann email" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="password" required>

                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="">Pilih Role:</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>

                    <label for="phone">No. telp</label>
                    <input type="text" name="no_hp" id="no_hp" placeholder="no. telp">

                    <button type="submit">Registrasi</button>
                </form>

                <div class="bottom-text">
                    Sudah punya akun? Yuk masuk <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
