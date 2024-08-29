function verifyInput() {

    function validateInput(input, isValid) {

        if ( isValid ) {

            input.classList.remove("InputError");

            //Caso ele tenha colocado um email já cadastrado,irá aparecer uma mensagem, então temos que remover ela agora
            if ( input == password ) {

                let messageError = document.getElementsByClassName("InputAlert"); // input -> div -> div -> p = Isso apenas do input email
                messageError[0].classList.add("d-none");
                messageError[0].classList.remove("InputAlert");

            };

        } else {

            input.classList.add("InputError");

        };

    };

    let email = document.getElementById("email");
    let password = document.getElementById("password");

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    validateInput(email, email.value !== "" && emailRegex.test(email.value));
    validateInput(password, password.value !== "" && password.value.length >= 8 && password.value.length <= 126);

    if ( document.querySelectorAll(".InputError").length > 0 ) {

        event.preventDefault();
        
    };
    
};
