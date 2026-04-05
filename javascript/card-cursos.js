class CardCursos extends HTMLElement {


  connectedCallback() {
    const img = this.getAttribute("img");
    const title = this.getAttribute("title");
    const subtitle = this.getAttribute("subtitle");
    const a = this.getAttribute("a")
    this.innerHTML = `

        <div class="card h-100" style="width: 22rem; background-color: #E6BFD2">
            <img src="${img}" class="card-img-top" style="height: 150px; object-fit: cover; ">
            <div class="card-body">
                <h5 class="card-title py-2 px-2" style="font-family: 'Inter', sans-serif; font-size: 16px">${title}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary py-2 px-2" style="font-family: 'Inter', sans-serif;">${subtitle}</h6>

                <hr>
                
                <div class="d-flex justify-content-center">
                    <a href="${a}" class="botao-saiba-mais px-5 btn m-auto">Saiba mais</a>
                </div>
            </div>
        </div>

        `;
  }
}

customElements.define("card-cursos", CardCursos);