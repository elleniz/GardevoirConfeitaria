/*card*/
class Card extends HTMLElement {


  connectedCallback() {
    const img = this.getAttribute("img");
    const descricao = this.getAttribute("descricao");
    this.innerHTML = `

        <div class="card border-0 shadow" style="width: 20rem; border-radius: 0 0 15px 15px; overflow: hidden;  margin-bottom: 50px; margin-inline: 30px">
            <div style="position: relative;">

            <img src="${img}" class="card-img-top"style="height: 300px; object-fit: cover;">


                <div class="card-verde">
                    <p class="m-0">${descricao}</p>
                </div>
            </div>
        </div>
    `;
  }
}

customElements.define("card-produto", Card);