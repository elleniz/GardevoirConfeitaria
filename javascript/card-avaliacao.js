class CardAvaliacao extends HTMLElement {
  connectedCallback() {
    const nome = this.getAttribute("nome") 
    const foto = this.getAttribute("foto") 
    const texto = this.getAttribute("texto")

    this.innerHTML = `
        <body class="d-flex justify-content-center align-items-center vh-100">
            <div class="testimonial-card shadow">
                <div class="testimonial-header">
                    <h5 class="mb-0">${nome}</h5>
                    <img src="${foto}">
                </div>
                <div class="testimonial-body">
                    <p class="mb-0">${texto}</p>
                </div>
            </div>
        </body>
        </html>
    `;
  }
}

customElements.define("card-avaliacao", CardAvaliacao);