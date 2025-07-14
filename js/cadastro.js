document.addEventListener('DOMContentLoaded', function () {
    const formCadastro = document.querySelector('form');
  
    formCadastro.addEventListener('submit', function (event) {
      const senha = document.getElementById('senha').value;
      const confirmar = document.getElementById('confirmar').value;
  
      if (senha.length < 6) {
        alert('A senha deve ter no mínimo 6 caracteres.');
        event.preventDefault();
        return;
      }
  
      if (senha !== confirmar) {
        alert('As senhas não coincidem. Por favor, verifique.');
        event.preventDefault();
      }
    });
  });