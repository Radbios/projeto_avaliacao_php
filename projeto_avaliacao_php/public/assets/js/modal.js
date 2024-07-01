const modal_btn = document.querySelectorAll('.modal_btn');
const modal = document.querySelector('.modal');
const modal_background = document.querySelector('.modal-background');

const close_modal = document.getElementById('close_modal');

const title_modal = document.getElementById('title-modal');

const input_valor =document.getElementById('edit_valor');
const input_data_pagar =document.getElementById('edit_data_pagar');

function hidden_modal() {
    modal_background.classList.remove("modal-active");
    modal.classList.remove("modal-active");
}

close_modal.addEventListener("click", hidden_modal)

modal_background.addEventListener("click", hidden_modal);

modal_btn.forEach(btn => {
    btn.addEventListener("click", () => {
        modal_background.classList.add("modal-active");
        modal.classList.add("modal-active");
        const route = btn.getAttribute("data-route");

        fetch(route)
            .then(response => {
            if (!response.ok) {
                return new Error('falhou a requisição')
            }

            if (response.status === 404) {
                return new Error('não encontrou qualquer resultado')
            }
            
            return response.json()
            })
            .then( response => {
                title_modal.innerHTML = "Editar conta : " + response.id_conta_pagar;
                input_valor.setAttribute("value", response.valor);
                input_data_pagar.setAttribute("value", response.data_pagar);

                const option =document.getElementById("option"+response.id_empresa);

                option.setAttribute("selected", true);
                modal_route = modal.getAttribute("action");

                console.log(modal_route);
                modal.setAttribute("action", modal_route.replace("param", response.id_conta_pagar));
            });
    });
});