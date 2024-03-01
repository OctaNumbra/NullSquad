<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id']));{
    $id = $_REQUEST['id'];
}

if(null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    $validacao = true;
    if(empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if(empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email valido!';
        $validacao = false;
    }

    if(empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }

    if(empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }

    if(empty($sexo)) {
        $sexoErro = 'Por favor prencha o campo!';
        $validacao = false;
    }

    if($validacao) {
        $pdo = Banco:: conectar();
        $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="UPDATE tb_aluno set nome =?, telefone =?, email =?, sexo= ? where id=?";
        $q = $pdo -> prepare($sql);
        $q -> execute(array($nome,$endereco,$telefone,$email,$sexo,$id));
        Banco:: desconectar();
        header("Location: idex.php");
    }else {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_aluno where id = ?";
        $q = $pdo -> prepare($sql);
        $q ->execute(array($id));
        $data = $q-> fetch(PDO:: FETCH_ASSOC);
        $nome  =$data['nome'];
        $endereco  =$data['endereco'];
        $telefone  =$data['telefone'];
        $email  =$data['email'];
        $sexo  =$data['sexo'];
        Banco:: desconectar();
    }}
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Atualizar Cadastro</title>
    </head>
    <body>
        <div class ="container">
    <div class= "span10 offset1">
    <div class= "card">
    <div class= "card-header">
        <h3 class="well">Atualizar Contato</h3>
</div>
<div class="card-body">
    <form class="form-horizontal" action="update.php?id=<?php echo $id ?>"method = "post">
    <div class="control-group <?php echo !empty($nomeErro) ? 'error' : '';?>">
    <label class="control-label">Nome</label>
    <div class = "controls">
    <input name = "nome" class="form-control" size="50" type="text" placeholder="Nome"
            value ="<?php echo !empty($nome) ? $nome : ''; ?>">

        <?php if(!empty($nomeErro)): ?>
            <span class ="text-danger"><?php echo $nomeErro;?> </span>
            <?php endif; ?>

            </div>
            </div>

            <div class="control-group <?php echo !empty($enderecoErro)? 'error' : '';?>">
            <label cass="control-label">Endereço</label>
            <div class = "controls">
    <input name = "endereço" class="form-control" size="80" type="text" placeholder="Endereço"
            value ="<?php echo !empty($endereco) ? $endereco : ''; ?>">
            <?php if(!empty($enderecoErro)): ?>
                <span class ="text-danger"><?php echo $enderecoErro;?> </span>
                <?php endif; ?>

            </div>
            </div>

            <div class="control-group <?php echo !empty($telefoneErro)? 'error' : '';?>">
            <label cass="control-label">Telefone</label>
            <div class = "controls">
    <input name = "telefone" class="form-control" size="30" type="text" placeholder="Telefone"
            value ="<?php echo !empty($telefone) ? $telefone : ''; ?>">
            <?php if(!empty($telefoneErro)): ?>
                <span class ="text-danger"><?php echo $telefoneErro;?> </span>
                <?php endif; ?>

            </div>
            </div>

            <div class="control-group <?php echo !empty($emailErro)? 'error' : '';?>">
            <label cass="control-label">email</label>
            <div class = "controls">
    <input name = "email" class="form-control" size="40" type="text" placeholder="email"
            value ="<?php echo !empty($email) ? $email : ''; ?>">
            <?php if(!empty($emailErro)): ?>
                <span class ="text-danger"><?php echo $emailErro;?> </span>
                <?php endif; ?>

            </div>
            </div>

            <div class="control-group <?php echo !empty($sexoErro)? 'error' : '';?>">
            <label cass="control-label">sexo</label>
            <div class = "controls">
            <div class ="form-check">
            <p class="form-check-label">
            <input class ="form-check-input" type="radio" name="sexo" 
                value ="M" <?php echo($sexo == "M") ? "checked" : null; ?>/> Masculino
                </div>
                <div class="form-check">
                <input class = "form-check-label">
                <input class ="form-check-input" type="radio" name="sexo" 
                value="F" <?php echo ($sexo == "F") ? "checked" : null; ?>/> Feminino
                
            </div>
            </p>
            <?php if (!empty($sexoErro)) : ?>
                <span class ="text-danger"><?php echo $sexoErro; ?></span>
                <?php endif;  ?>

            </div>
            </div>

            <br/>
            <div class="form-actions">
            <button type ="submit" class="btn btn-warning">Atuaizar<button>
            <a href="index.php" type="btn" class= "btn btn-default"Voltar</a>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src= "assets/js/bootstrap.min.js"></script>
</body>
</html>