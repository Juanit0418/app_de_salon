document.addEventListener("DOMContentLoaded", function(){
    iniciar_app();
});

function iniciar_app(){
    buscar_por_fecha();
};

function buscar_por_fecha(){
    const fecha_input = document.querySelector("#fecha");
    fecha_input.addEventListener("input", function(evento){
        const fecha_seleccionada = evento.target.value;
        
        window.location = `?fecha=${fecha_seleccionada}`;
    });
};