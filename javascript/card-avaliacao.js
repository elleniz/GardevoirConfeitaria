class CardAvaliacao extends HTMLElement {
  connectedCallback() {
    const nome = this.getAttribute("nome") 
    const foto = this.getAttribute("foto") 
    const texto = this.getAttribute("texto")

    this.innerHTML = `
      <div class="card card-avaliacao mb-3">
        <div class="card-topo d-flex justify-content-between align-items-center">
          <strong>${nome}</strong>
          <img src="${foto}" class="rounded-circle">
        </div>
        <div class="card-body">
          ${texto}
        </div>
      </div>
    `;
  }
}

customElements.define("card-avaliacao", CardAvaliacao);
