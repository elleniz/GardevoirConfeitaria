class Footer extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `        
        <footer bg-primary py-3">
        <div class="container-fluid text-center text-white" style="background-color: #2B2B2B;";>
        <h1>a.</h1>
        </div>
            <div class="container-fluid text-center text-center py-2" style="background-color: #8F2738; color: #E6BFD2";>
                <span class="mx-auto text-footer">
                    Projeto Desenvolvimento Web 1 - Super Shock © 2025
                </span>
            </div>

        </footer>
        `;
  }
}

customElements.define("ins-footer", Footer);