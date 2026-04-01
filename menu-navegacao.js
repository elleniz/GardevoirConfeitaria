class Navbar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">        
        <img src="./img/logo.png" alt="logo" style="width: 190px; height: 80px; object-fit: cover; margin-left=200px"; class="logo-navbar">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item navbar-text active">
              <a class="nav-link" href="#index.html">Início</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="#produtos.html">Produtos</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="#curos.html">Cursos</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="#localizacao.html">Localização</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="#sobre-nos.html">Sobre nós</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="#">Contate-nos</a>
            </li>
          </ul>
        </div>
      </nav>
    `;
  }
}

customElements.define("menu-navegacao", Navbar);