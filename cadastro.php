<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST["nome_usuario"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $verificar = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? ");
    $verificar->bind_param("s", $email);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
        echo"E-mail já cadastrado!";
    } else {
        $inserir = $conexao->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?,?,?)");
        $inserir->bind_param("sss", $nome_usuario, $email, $senha);
        if ($inserir->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao Cadastrar!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png" type="favicon">
    <title>PontoFrio - Cadastro</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            overflow: hidden;
        }

        .login-container {
            position: relative;
            height: 100vh;
            width: 100vw;
            display: flex;
            background-color: #000;
        }

        .left-section {
            flex: 1;
            position: relative;
            background-image: url('https://grandesnomesdapropaganda.com.br/wp-content/uploads/2025/04/Novo-Pin-Pontofrio-e-Leo.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
            box-sizing: border-box;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .left-content {
            position: relative;
            z-index: 2;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .top-text {
            font-size: 2.2em;
            font-weight: 300;
            line-height: 1.2;
            margin-bottom: 0;
        }

        .bottom-section {
            display: flex;
            align-items: center;
            margin-top: auto;
        }

        .ponto-logo-small {
            width: 60px;
            height: 60px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .ponto-logo-small img {
            width: 40px;
            height: 40px;
        }

        .tagline-box {
            background-color: #f37805ff;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 500;
            line-height: 1.3;
        }

        .right-section {
            width: 400px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            box-sizing: border-box;
        }

        .login-form-card {
            width: 100%;
            max-width: 350px;
        }

        .form-header h2 {
            font-size: 1.8em;
            color: white;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-header p {
            font-size: 1em;
            color: white;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 0.9em;
            color: white;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input[type="email"] {
            width: 100%;
            padding: 15px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 15px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus {
            border-color: #f37805ff;
        }

        .form-group input[type="email"]:focus {
            border-color: #f37805ff;
        }

        .form-group input[type="password"] {
            width: 100%;
            padding: 15px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input[type="password"]:focus {
            border-color: orange;
        }

        .btn-continue {
            width: 100%;
            padding: 16px;
            background-color: #f37805ff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        .btn-continue:hover {
            background-color:rgb(208, 103, 29);
        }

        .signup-text {
            text-align: center;
            font-size: 0.9em;
            color: white;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .signup-text a {
            color: orange;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .left-section {
                height: 40vh;
            }
            
            .right-section {
                width: 100%;
                height: 60vh;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="left-section">
            <div class="overlay"></div>
            <div class="left-content">
                
                
                <div class="bottom-section">
                    <div class="ponto-logo-small">
                        <img src="img/favicon.png" alt="ponto Logo">
                    </div>
                    <div class="tagline-box">
                        Seja<br>
                        Um Cliente<br>
                        PontoFrio<br>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-section">
            <div class="login-form-card">
                <div class="form-header">
                    <h2>Cadastro</h2>
                    <p>Venha fazer parte da pontofrio e ganhe descontos especiais!</p>
                </div>

                <form action="#" method="POST">

                    <div class="form-group">
                        <label for="nome_usuario">Nome</label>
                        <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Digite seu nome completo" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Digite o seu E-mail" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="Crie sua senha" required>
                    </div>
                    
                    <button type="submit" class="btn-continue">
                        Cadastre-se
                    </button>
                </form>

                <div class="signup-text">
                    Ja tem conta?
                    <a href="login.php">Faça Login</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>