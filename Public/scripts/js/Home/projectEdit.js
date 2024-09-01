function editProject(id, name, description) {

    let formEdits = document.querySelectorAll("#EditProject");
    
    //Verificando se já está ocorrendo uma edição
    if ( formEdits.length > 0 ) {

        let productId = formEdits[0].parentElement.id;
        let product = document.getElementById(productId);
        formEdits[0].remove();

        product.classList.remove("d-none");
        product.classList.add("d-flex");

    };

    let product = document.getElementById(id);
    let formReference = document.querySelectorAll('.formEdit'); //Indica onde o nosso formulário irá ficar
    
    //Buscando a div correta
    formReference.forEach(element => {

        if ( element.id == id ) {

            formReference = element;

        };
        
    });

    if ( !formReference.children[0] ) {

        let formAdd = document.getElementById("AddProject");
    
        //Clonando o formulário
        let formEdit = formAdd.cloneNode(true);
        formEdit.classList.remove("d-none");
        formEdit.classList.add("d-flex");
        formEdit.id = "EditProject";

        //Alterando valores dos botões
        let cancelBtn = formEdit.children[0].children[1].children[0].children[0]; //Botão de cancelar
        let submitBtn = formEdit.children[0].children[1].children[0].children[1]; //Botão de envio
        cancelBtn.onclick = function() { 

            formReference.children[0].remove();
            
            product.classList.remove("d-none");
            product.classList.add("d-flex");
        
        };
        console.log(submitBtn.children[1]);
        submitBtn.children[1].innerHTML = "Salvar"; //Tag <p>
        submitBtn.name = "update"; //Altero daqui a pouco
        submitBtn.value = id; //Inserindo o id do projeto para 
        
        //Adicionando valores no input
        let inputName = formEdit.children[0][0]; //Input nome
        let inputDescription = formEdit.children[0][1]; //Input descrição
        inputName.value = name;
        inputDescription.value = description;
        
        formReference.appendChild(formEdit);

        //Editando o produto
        if ( product.className.includes("d-flex") ) {

            product.classList.remove("d-flex");
            product.classList.add("d-none");

        };

    } else {

        formReference.children[0].remove();

        product.classList.remove("d-none");
        product.classList.add("d-flex");

    };

};

function deleteProject() {



};
