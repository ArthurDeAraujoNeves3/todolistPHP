function addNewProject() {

    let ActionsBtns = document.getElementById("ActionsBtns"); //Botão de adicionar
    let NoProjects = document.getElementById("NoProjects"); 
    let AddProjectModal = document.getElementById("AddProject"); //Modal para criação de novos projetos

    if ( !AddProjectModal.className.includes("d-flex") ) {

        ActionsBtns.classList.remove("d-flex");
        ActionsBtns.classList.add("d-none");

        AddProjectModal.classList.remove("d-none");
        AddProjectModal.classList.add("d-flex");

        //Caso já tenha projetos criados
        if ( !NoProjects.className.includes("invisible") ) {

            NoProjects.classList.remove("d-flex");
            NoProjects.classList.add("d-none");

        };

    } else {

        ActionsBtns.classList.remove("d-none");
        ActionsBtns.classList.add("d-flex");

        AddProjectModal.classList.remove("d-flex");
        AddProjectModal.classList.add("d-none");

        //Caso já tenha projetos criados
        if ( !NoProjects.className.includes("invisible") ) {

            NoProjects.classList.remove("d-none");
            NoProjects.classList.add("d-flex");

        };

    };

};

function addNewTask() {

    let ActionsBtns = document.getElementById("ActionsBtnsTask"); //Botão de adicionar
    let AddProjectModal = document.getElementById("AddTask"); //Modal para criação de novas tarefas

    if ( !AddProjectModal.className.includes("d-flex") ) {

        ActionsBtns.classList.remove("d-flex");
        ActionsBtns.classList.add("d-none");

        AddProjectModal.classList.remove("d-none");
        AddProjectModal.classList.add("d-flex");

    } else {

        ActionsBtns.classList.remove("d-none");
        ActionsBtns.classList.add("d-flex");

        AddProjectModal.classList.remove("d-flex");
        AddProjectModal.classList.add("d-none");

    };

};
