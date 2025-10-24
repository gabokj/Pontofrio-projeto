<?php
session_start();
if (!isset($_SESSION["nome_usuario"])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png" type="favicon">
    <title>PontoFrio - Eletrônicos | Smartphones, Notebooks e Mais</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 80%; margin: 0 auto; }
        header { background-color: #1a1a1a; color: white; padding: 15px 0; }
        header .nav-bar { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.8em; font-weight: bold; color: #00bcd4; } 
        .search input { padding: 8px; border: none; border-radius: 4px; width: 300px; }
        .icons a { color: white; text-decoration: none; margin-left: 20px; }
        
        .hero { background-color: #333; color: white; text-align: center; padding: 80px 0; margin-bottom: 30px; }
        .hero h1 { font-size: 3em; margin-bottom: 10px; }
        .hero p { font-size: 1.2em; margin-bottom: 30px; }
        .hero button { padding: 10px 20px; background-color: orange; color: white; border: none; cursor: pointer; font-size: 1em; }
        
        .categories-grid { display: flex; justify-content: space-around; margin-bottom: 40px; }
        .category-item { text-align: center; padding: 20px; border: 1px solid #ddd; width: 150px; background-color: white; }
        
        .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .product-card { background-color: white; border: 1px solid #ddd; padding: 15px; text-align: center; }
        .product-card img { max-width: 100%; height: auto; margin-bottom: 10px; }
        .price { color: #e60000; font-weight: bold; margin-top: 5px; }
        
    </style>
</head>
<body>

    <header>
    <div class="container nav-bar">
    <div class="logo">
        <img src="https://imgs.pontofrio.com.br/images/PontoFrio/brand/logo_negativo.svg" alt="Logo" style="height: 30px;">
    </div>
            
            <div class="search">
                <input type="text" placeholder="Buscar produtos...">
            </div>
            
            <div class="icons">
                <a href="usuario.php">
                    <img src="img/user (3).png" alt="Área do Usuário" style="height: 24px; vertical-align: middle;">
                </a>
                
                <a href="carrinho.php" style="margin-left: 20px;">
                    <img src="img/shopping-cart.png" alt="carrinho" style="height: 24px; vertical-align: middle;">
                </a>

                <a href="login.php" style=" margin-left: 50px; margin-right: 10px;">
                    <img src="img/log-out.png" alt="Sair" style="height: 24px; vertical-align: middle;">
                </a>
</div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Lançamento do Mês: Novo Smartphone X9 Pro</h1>
            <p>Compre agora e ganhe 20% de desconto e frete grátis!</p>
            <button onclick="window.location.href='produto_x9pro.html'">Ver Detalhes</button>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2>Compre por Categoria</h2>
            <div class="categories-grid">
                <div class="category-item">
                    <img src="https://www.havan.com.br/media/catalog/product/cache/73a52df140c4d19dbec2b6c485ea6a50/c/e/celular-smartphone-xiaomi-redmi-note13-4g-octacore-8gb-ram-256gb-ssd_1007650.webp" alt="Smartphones" width="80">
                    <p>Smartphones</p>
                </div>
                <div class="category-item">
                    <img src="https://mirandacomputacao.jetassets.com.br/produto/48612-principal.png" alt="Notebooks" width="80">
                    <p>Notebooks</p>
                </div>
                <div class="category-item">
                    <img src="https://www.lg.com/content/dam/channel/wcms/br/images/produtos/tv/65qned80tsa/3-1600-65qned80tsa.jpg/_jcr_content/renditions/thum-1600x1062.jpeg" alt="Smart TVs" width="80">
                    <p>Smart TVs</p>
                </div>
                <div class="category-item">
                    <img src="https://media.istockphoto.com/id/525125897/pt/foto/aparelhos-de-casa-conjunto-de-cozinha-technics-uso-dom%C3%A9stico.jpg?s=612x612&w=0&k=20&c=neK3N6ClDQFF_iP8RI0ER7kIwC5ZvR2Ge5E9BYM3i2w=" alt="Áudio" width="80">
                    <p>Eletrodomésticos</p>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2>Produtos em Destaque</h2>
            <div class="product-grid">
                
                <div class="product-card">
                    <img src="https://www.logitechstore.com.br/media/catalog/product/cache/105e6f420716e0751863c4b81f527d17/l/o/logitech098.png" alt="Headphone Gamer" height="150">
                    <h3>Headphone Gamer Pro</h3>
                    <p>Áudio imersivo de alta qualidade.</p>
                    <div class="price">R$ 499,00</div>
                    <button>Adicionar ao Carrinho</button>
                </div>
                
                <div class="product-card">
                    <img src="https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRMaGXxmPtiJVA8FuLAa80AIi0ifunuQIx-djyHXCJnvExscQ6xLBYZq9lkVGlOLmdCF7WWayZEtqCc0N7G3AwqeSrLwXFnVzEiu_Ymz1XFqyiYVzpicc72j3Dz0jf9wsRGjSj3_u0&usqp=CAc" alt="Câmera Esportiva 4K" height="120">
                    <h3>Câmera Esportiva 4K</h3>
                    <p>Grave suas aventuras em Ultra HD.</p>
                    <div class="price">R$ 899,00</div>
                    <button>Adicionar ao Carrinho</button>
                </div>
                
                <div class="product-card">
                    <img src="https://http2.mlstatic.com/D_NQ_NP_630844-MLB79774653696_102024-O-smartwatch-z10-call-celular-de-pulso-4g-wi-fi-play-store.webp" alt="Smartwatch Z10" height="150">
                    <h3>Smartwatch Z10</h3>
                    <p>Monitore sua saúde e notificações.</p>
                    <div class="price">R$ 299,00</div>
                    <button>Adicionar ao Carrinho</button>
                </div>
                
                <div class="product-card">
                    <img src="https://images.kabum.com.br/produtos/fotos/472044/teclado-mecanico-gamer-kbm-gaming-tg600-preto-60-e-abnt2-rgb-switch-gateron-blue-kgtg600ptaz_1709825263_gg.jpg" alt="Teclado Mecânico RGB" height="150">
                    <h3>Teclado Mecânico</h3>
                    <p>Performance e iluminação RGB.</p>
                    <div class="price">R$ 350,00</div>
                    <button>Adicionar ao Carrinho</button>
                </div>

            </div>
        </div>
    </section>

</body>
</html>