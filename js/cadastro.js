document.addEventListener('DOMContentLoaded', function () {
  const formCadastro = document.getElementById('form-cadastro');

  formCadastro.addEventListener('submit', function (event) {
    event.preventDefault();

    const senha = document.getElementById('senha').value;
    const confirmar = document.getElementById('confirmar').value;

    if (senha.length < 6) {
      alert('A senha deve ter no mínimo 6 caracteres.');
      return;
    }

    if (senha !== confirmar) {
      alert('As senhas não coincidem.');
      return;
    }

    const dados = new FormData(formCadastro);

    fetch('php/cadastrar_cliente.php', {
      method: 'POST',
      body: dados
    })
      .then(res => res.text())
      .then(msg => {
        alert(msg);
        formCadastro.reset();
      })
      .catch(err => alert("Erro: " + err));
  });
});