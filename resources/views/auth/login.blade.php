<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { display: flex; max-width: 900px; width: 100%; }
        .form-section { flex: 1; padding: 40px; display: flex; flex-direction: column; justify-content: center; }
        .form-section h2 { font-size: 36px; margin-bottom: 10px; color: #008759; }
        .form-section p { font-size: 16px; color: #555; margin-bottom: 30px; }
        input { padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 10px; width: 100%; font-size: 16px; }
        .btn { padding: 12px; background-color: #008759; color: white; border: none; border-radius: 25px; font-weight: bold; font-size: 16px; cursor: pointer; }
        .btn-outline { margin-top: 10px; background-color: white; color: #008759; border: 2px solid #008759; }
        .or-divider { text-align: center; margin: 15px 0; position: relative; }
        .or-divider::before, .or-divider::after {
            content: ''; position: absolute; top: 50%; width: 45%; height: 1px; background: #ccc;
        }
        .or-divider::before { left: 0; }
        .or-divider::after { right: 0; }
        .or-divider span { background: #fff; padding: 0 10px; position: relative; z-index: 1; color: #777; }

        /* Perubahan di bawah ini */
        .image-section {
            flex: 1;
            background: transparent; /* <-- ini diubah dari #8AA88B jadi transparent */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-section img {
            max-width: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <p>Welcome back!</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <button class="btn" type="submit">Sign In</button>
            </form>
            <div class="or-divider"><span>or</span></div>
            <button class="btn btn-outline">Sign In</button>
        </div>
        <div class="image-section">
            <img src="{{ asset('Logo 1.png') }}" alt="Calculator Icon">
        </div>
    </div>
</body>
</html>
