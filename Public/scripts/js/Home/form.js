function verifyInputs(index) {

    function validateInput( isValid ) {

        if ( isValid ) {

            addButton.removeAttribute("disabled");
            addButton.classList.remove("BtnDisabled");
            
        } else {

            addButton.setAttribute("disabled", true);
            addButton.classList.add("BtnDisabled");
            
        };

    };

    let addButton = document.querySelectorAll("#addButton");
    addButton = addButton[index];
    let name = document.querySelectorAll("#projectName");
    name = name[index];
    
    validateInput(name.value.length > 0 && name.value.length <= 60);
    
};

function verifyDesc(index) {

    function validateInput( isValid ) {

        if ( isValid ) {

            addButton.setAttribute("disabled", true);
            addButton.classList.add("BtnDisabled");
            
        };

    };

    let addButton = document.getElementById("addButton");
    let desc = document.querySelectorAll("#projectDescription");
    desc = desc[index];
    
    validateInput(desc.value.length > 500);

};
