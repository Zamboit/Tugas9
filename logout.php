<?php
session_start();
$_SESSION = [];
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
	<style>
		body {
			background: linear-gradient(120deg, #232526 0%, #414345 100%);
			color: #fff;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		.logout-box {
			background: rgba(40, 40, 60, 0.97);
			padding: 48px 36px;
			border-radius: 20px;
			box-shadow: 0 12px 32px rgba(0,0,0,0.35);
			text-align: center;
			min-width: 320px;
			animation: fadeIn 0.7s;
		}
		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(40px); }
			to { opacity: 1; transform: translateY(0); }
		}
		h2 {
			margin-bottom: 18px;
			font-size: 2rem;
			color: #00adb5;
			letter-spacing: 1px;
		}
		h2 .fa-sign-out-alt {
			margin-right: 10px;
		}
		p {
			font-size: 1.1rem;
			color: #bb86fc;
			margin-bottom: 24px;
		}
		.btn-login {
			background: linear-gradient(90deg, #00adb5 0%, #007b7f 100%);
			color: #fff;
			border: none;
			padding: 14px 36px;
			border-radius: 10px;
			font-size: 1.1rem;
			cursor: pointer;
			font-weight: bold;
			box-shadow: 0 2px 8px rgba(0,0,0,0.12);
			transition: background 0.2s, transform 0.2s;
			margin-top: 10px;
			text-decoration: none;
			display: inline-block;
		}
		.btn-login i {
			margin-right: 8px;
		}
		.btn-login:hover {
			background: linear-gradient(90deg, #007b7f 0%, #00adb5 100%);
			transform: scale(1.04);
		}
		@media (max-width: 500px) {
			.logout-box {
				padding: 24px 8px;
				min-width: 0;
			}
		}
	</style>
</head>
<body>
	<div class="logout-box">
		<h2><i class="fa-solid fa-sign-out-alt"></i> Anda telah logout.</h2>
		<p>Terima kasih telah menggunakan aplikasi ini.</p>
		<a href="login.php" class="btn-login"><i class="fa-solid fa-sign-in-alt"></i> Login kembali</a>
	</div>
</body>
</html>