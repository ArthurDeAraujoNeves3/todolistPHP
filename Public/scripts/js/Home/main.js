function addNewProject() {

    let ActionsBtns = document.getElementById("ActionsBtns"); //Botão de adicionar
    let NoProjects = document.getElementById("NoProjects"); 

    let isOpened = false;

    if ( !isOpened ) {

        ActionsBtns.classList.remove("d-flex");
        ActionsBtns.classList.add("d-none");

        //Caso já tenha projetos criados
        if ( !NoProjects.className.includes("invisible") ) {

            NoProjects.classList.remove("d-flex");
            NoProjects.classList.add("d-none");

        };

    } else {

        ActionsBtns.classList.remove("d-none");
        ActionsBtns.classList.add("d-flex");

        //Caso já tenha projetos criados
        if ( !NoProjects.className.includes("invisible") ) {

            NoProjects.classList.remove("d-none");
            NoProjects.classList.add("d-flex");

        };

    };

};
