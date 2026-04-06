class CardAvaliacao extends HTMLElement {
  connectedCallback() {
    const nome = this.getAttribute("nome") 
    const foto = this.getAttribute("foto") 
    const texto = this.getAttribute("texto")

    this.innerHTML = `
            <div class="testimonial-card shadow" >
                <div class="testimonial-header">
                    <h5 class="mb-0">${nome}</h5>
                    <img src="${foto}" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                </div>
                <div class="testimonial-body d-flex align-items-center justify-content-center" style="height: 150px; text-align: center; padding: 15px;">
                    <p class="mb-0">${texto}</p>
                </div>
            </div>
    `;
  }
}

customElements.define("card-avaliacao", CardAvaliacao);
