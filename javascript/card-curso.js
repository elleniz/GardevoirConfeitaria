class CardCurso extends HTMLElement {
  connectedCallback() {
    const titulo = this.getAttribute("titulo")
    const descricao = this.getAttribute("descricao")
    const imagem = this.getAttribute("imagem") 

    this.innerHTML = `
      <div class="card curso-card">
        <img src="${imagem}"style="height: 250px">
        <div class="card-body">
          <h6 style="height: 50px">${titulo}</h6>
          <p class="py-1"style="height: 20px">${descricao}</p>
          <div class="estrelas">★★★★★</div>
          <button class="btn w-100 mt-2">Ver curso</button>
        </div>
      </div>
    `;
  }
}

customElements.define("card-curso", CardCurso);