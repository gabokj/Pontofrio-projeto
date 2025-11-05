<?php
include("conexao.php");

$result_funcionarios = $conexao->query("SELECT COUNT(*) as total FROM funcionario");
$total_funcionarios = $result_funcionarios ? $result_funcionarios->fetch_assoc()['total'] : 0;

$result_departamentos = $conexao->query("SELECT COUNT(DISTINCT cargo_func) as total FROM funcionario");
$total_departamentos = $result_departamentos ? $result_departamentos->fetch_assoc()['total'] : 0;

$result_salario = $conexao->query("SELECT AVG(salario_func) as media FROM funcionario");
$salario_medio = $result_salario ? $result_salario->fetch_assoc()['media'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_func = $_POST["nome_func"];
    $email_func = $_POST["email_func"];
    $data_nasc = $_POST["data_nasc"];
    $cpf = $_POST["cpf"];
    $senha_func = password_hash($_POST["senha_func"], PASSWORD_DEFAULT);
    $cargo_func = $_POST["cargo_func"];
    $salario_func = $_POST["salario_func"];

    $verificar = $conexao->prepare("SELECT * FROM funcionario WHERE email_func = ? OR cpf = ?");
    $verificar->bind_param("ss", $email_func, $cpf);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
        echo "<script>alert('E-mail ou CPF já cadastrado!');</script>";
    } else {
        $inserir = $conexao->prepare("INSERT INTO funcionario (nome_func, email_func, data_nasc, cpf, senha_func, cargo_func, salario_func) VALUES (?,?,?,?,?,?,?)");
        $inserir->bind_param("ssssssd", $nome_func, $email_func, $data_nasc, $cpf, $senha_func, $cargo_func, $salario_func);
        if ($inserir->execute()) {
            echo "<script>alert('Funcionário cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar funcionário!');</script>";
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
    <title>PontoFrio - Cadastro de Funcionários</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 80%; margin: 0 auto; }
        header { background-color: #1a1a1a; color: white; padding: 15px 0; }
        header .nav-bar { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.8em; font-weight: bold; color: #00bcd4; } 
        .search input { padding: 8px; border: none; border-radius: 4px; width: 300px; }
        .icons a { color: white; text-decoration: none; margin-left: 20px; }
        
        .hero { background-color: #333; color: white; text-align: center; padding: 40px 0; margin-bottom: 30px; }
        .hero h1 { font-size: 2.5em; margin-bottom: 10px; }
        .hero p { font-size: 1.2em; margin-bottom: 30px; }
        
        .form-container { background-color: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); margin-bottom: 40px; }
        .form-container h2 { color: #333; margin-bottom: 30px; text-align: center; }
        
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group.full-width { grid-column: span 2; }
        
        .form-group label { display: block; font-size: 0.9em; color: #333; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 1em; outline: none; transition: border-color 0.3s; }
        .form-group input:focus, .form-group select:focus { border-color: #f37805ff; }
        
        .btn-submit { width: 100%; padding: 16px; background-color: #f37805ff; color: white; border: none; border-radius: 6px; font-size: 1.1em; font-weight: 600; cursor: pointer; transition: background-color 0.3s; }
        .btn-submit:hover { background-color: rgb(208, 103, 29); }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; justify-items: center; justify-content: center; max-width: 1000px; margin-left: auto; margin-right: auto; }
        .stat-card { background-color: white; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); width: 200px; }
        .stat-card h3 { color: #f37805ff; font-size: 2em; margin: 0; }
        .stat-card p { color: #666; margin: 5px 0 0 0; }
        
    </style>
</head>
<body>

    <header>
        <div class="container nav-bar">
            <div class="logo">
                <img src="https://imgs.pontofrio.com.br/images/PontoFrio/brand/logo_negativo.svg" alt="Logo" style="height: 30px;">
            </div>
            
            <div class="search">
                <input type="text" placeholder="Buscar funcionários...">
            </div>
            
            <div class="icons">
                <a href="usuario.php">
                    <img src="img/user (3).png" alt="Login" style="height: 24px; vertical-align: middle;">
                </a>
                
                <a href="login.php" style="margin-left: 20px;">
                    <img src="img/log-out.png" alt="Cadastro" style="height: 24px; vertical-align: middle;">
                </a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Sistema de Cadastro de Funcionários</h1>
            <p>Gerencie sua equipe de forma eficiente e organizada</p>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?php echo number_format($total_funcionarios, 0, ',', '.'); ?></h3>
                    <p>Funcionários Ativos</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $total_departamentos; ?></h3>
                    <p>Cargos Diferentes</p>
                </div>
                <div class="stat-card">
                    <h3>R$ <?php echo number_format($salario_medio, 2, ',', '.'); ?></h3>
                    <p>Salário Médio</p>
                </div>
            </div>
        </div>
    </section>

    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <h2>Cadastrar Novo Funcionário</h2>
                
                <form action="#" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome_func">Nome Completo</label>
                            <input type="text" id="nome_func" name="nome_func" placeholder="Digite o nome completo" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email_func">E-mail</label>
                            <input type="email" id="email_func" name="email_func" placeholder="Digite o e-mail" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="data_nasc">Data de Nascimento</label>
                            <input type="date" id="data_nasc" name="data_nasc" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="senha_func">Senha</label>
                            <input type="password" id="senha_func" name="senha_func" placeholder="Digite uma senha" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cargo_func">Cargo</label>
                            <select id="cargo_func" name="cargo_func" required>
                                <option value="">Selecione o cargo</option>
                                <option value="Vendedor">Vendedor</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Analista">Analista</option>
                                <option value="Assistente">Assistente</option>
                                <option value="Coordenador">Coordenador</option>
                                <option value="Diretor">Diretor</option>
                            </select>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="salario_func">Salário</label>
                            <input type="number" id="salario_func" name="salario_func" placeholder="Digite o salário" step="0.01" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-submit">Cadastrar Funcionário</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });
    </script>

</body>
</html>
