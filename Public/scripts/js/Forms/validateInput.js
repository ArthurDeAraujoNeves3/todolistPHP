function verifyInput() {

    function validateInput(input, isValid) {

        if ( isValid ) {

            input.classList.remove("InputError");

            //Caso ele tenha colocado um email já cadastrado,irá aparecer uma mensagem, então temos que remover ela agora
            if ( input == email ) {

                let messageError = email.parentElement.parentElement.children[1]; // input -> div -> div -> p = Isso apenas do input email
                messageError.classList.remove("InputAlert");
                messageError.classList.add("d-none");

            };

        } else {

            input.classList.add("InputError");

        };

    };

    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    validateInput(name, name.value !== "" && name.value.length <= 126);
    validateInput(email, email.value !== "" && emailRegex.test(email.value));
    validateInput(password, password.value !== "" && password.value.length <= 126);

    if ( document.querySelectorAll(".InputError").length > 0 ) {

        event.preventDefault();
        
    };
    
};
