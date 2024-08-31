function verifyInputs() {

    function validateInput( isValid ) {

        console.log(isValid);

        if ( isValid ) {

            addButton.removeAttribute("disabled");
            addButton.classList.remove("BtnDisabled");
            
        } else {

            addButton.setAttribute("disabled", true);
            addButton.classList.add("BtnDisabled");
            
        };

    };

    let addButton = document.getElementById("addButton");
    let name = document.getElementById("projectName");
    
    validateInput(name.value.length > 0 && name.value.length <= 60);
    verifyDesc();

};

function verifyDesc() {

    function validateInput( isValid ) {

        if ( isValid ) {

            addButton.setAttribute("disabled", true);
            addButton.classList.add("BtnDisabled");
            
        };

    };

    let addButton = document.getElementById("addButton");
    let desc = document.getElementById("projectDescription");
    
    validateInput(desc.value.length > 500);

};
 