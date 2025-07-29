let paso = 1;
const paso_inicial = 1;
const paso_final = 3;
let cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
};

document.addEventListener('DOMContentLoaded', function() {
    iniciar_app();
});

function iniciar_app(){
    mostrar_seccion(); //Muestra y oculta las secciones
    tabs();
    botones_paginador();
    pagina_siguiente();
    pagina_anterior();

    consultar_api(); //Consulta la API de servicios

    id_cliente();
    nombre_cliente();
    seleccionar_fecha();
    seleccionar_hora();
}

function mostrar_seccion() {
    //Remover la clase mostrar a la seccion anterior
    seccion_anterior = document.querySelector(".mostrar");
    if(seccion_anterior){
        seccion_anterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`)
    seccion.classList.add('mostrar');

    //Remover la clase actual a la tab anterior
    const tab_anterior = document.querySelector(".actual");
    if(tab_anterior){
        tab_anterior.classList.remove('actual');
    }

    //Tab activo
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener("click", function(evento){
            paso = parseInt(evento.target.dataset.paso);

            mostrar_seccion();
            botones_paginador();
        })
    })
}

function botones_paginador() {
    boton_anterior = document.querySelector("#anterior");
    boton_siguiente = document.querySelector("#siguiente");

    if(paso === 1){
        boton_anterior.classList.add("ocultar");
        boton_siguiente.classList.remove("ocultar");
    } else if (paso === 3) {
        boton_siguiente.classList.add("ocultar");
        boton_anterior.classList.remove("ocultar");
        mostrar_resumen();
    } else{
        boton_anterior.classList.remove("ocultar");
        boton_siguiente.classList.remove("ocultar");
    }

    mostrar_seccion();
}

function pagina_siguiente() {
    const pagina_siguiente = document.querySelector("#siguiente");
    pagina_siguiente.addEventListener("click", function() {
        if (paso >= paso_final) {
            return;
        }

        paso++;
        
        botones_paginador();
    })

}

function pagina_anterior() {
    const pagina_anterior = document.querySelector("#anterior");
    pagina_anterior.addEventListener("click", function() {
        if (paso <= paso_inicial) {
            return;
        }

        paso--;
        
        botones_paginador();
    })

}

async function consultar_api() {
    try {
        const url = `${location.origin}/api/servicios`
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrar_servicios(servicios);
    } catch (error) {
        console.error("Error al consultar la API:", error);
    }
}

function mostrar_servicios(servicios) {
    servicios.forEach(function(servicio){
        const { id, nombre, precio } = servicio;

        const nombre_servicio = document.createElement("P");
        nombre_servicio.classList.add("nombre_servicio");
        nombre_servicio.textContent = nombre;

        const precio_servicio = document.createElement("P");
        precio_servicio.classList.add("precio_servicio");
        precio_servicio.textContent = `$${precio}`;

        const contenedor_servicio = document.createElement("DIV");
        contenedor_servicio.classList.add("servicio");
        contenedor_servicio.dataset.idServicio = id;
        contenedor_servicio.onclick = function(){
            seleccionar_servicio(servicio);
        };

        contenedor_servicio.appendChild(nombre_servicio);
        contenedor_servicio.appendChild(precio_servicio);

        const div_servicios = document.querySelector("#servicios");
        div_servicios.appendChild(contenedor_servicio);
    })
}

function seleccionar_servicio(servicio) {
    const {servicios} = cita;
    const { id } = servicio;

    //Identificar elelemento al que se le da click
    const servicio_contenedor = document.querySelector(`[data-id-servicio="${id}"]`);
    
    //comprobar si el servicio ya fue agregado
    if( servicios.some(function(agregado){
        return agregado.id === servicio.id;
    })){
        //Eliminarlo de la cita
        cita.servicios = servicios.filter(function(agregado){
            return agregado.id !== servicio.id;
        });
        servicio_contenedor.classList.remove("seleccionado");
    } else {
        //Agregarlo a la cita
        cita.servicios = [...servicios, servicio];
        servicio_contenedor.classList.add("seleccionado");
    };
}

function id_cliente(){
    const seleccionar_id = document.querySelector("#id");
    const id = seleccionar_id.value;
    cita.id = id;
}

function nombre_cliente(){
    const seleccionar_nombre = document.querySelector("#nombre");
    const nombre = seleccionar_nombre.value;
    cita.nombre = nombre;
}

function seleccionar_fecha(){
    const input_fecha = document.querySelector("#fecha");
    input_fecha.addEventListener("input", function(e){
        const dia = new Date(e.target.value).getUTCDay();

        if([6, 0].includes(dia)){
            e.target.value = "";
            mostrar_alerta("errores", "Fecha no disponible", "#paso-2 p");
        } else {
            cita.fecha = e.target.value;
        };
    })
}

function seleccionar_hora(){
    const input_hora = document.querySelector("#hora");
    input_hora.addEventListener("input", function(evento){
        const hora_cita = evento.target.value;
        const hora = hora_cita.split(":")[0];
        const minuto = hora_cita.split(":")[1];

        if(hora < 8 || hora == 12 || hora >= 17){
            evento.target.value = "";
            mostrar_alerta("errores", "Hora no válida", "#paso-2 p");
        } else {
            cita.hora = evento.target.value;
        };
    });
}

function mostrar_alerta(tipo, mensaje, elemento, desaparece = true){
    const alerta_previa = document.querySelector(".alerta");
    if(alerta_previa){
        alerta_previa.remove();
    };
    
    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipo);
    
    const ver_alerta = document.querySelector(elemento);
    ver_alerta.appendChild(alerta);

    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    } else {
        setTimeout(() => {
            alerta.remove();
        }, 10000);
    }
}


function mostrar_resumen(){
    const resumen = document.querySelector(".contenido_resumen");
    const info_cita = document.querySelector(".informacion_cita");
    const div_resumen = document.querySelector(".resumen");

    // Limpiar contenido anterior
    resumen.innerHTML = "";
    info_cita.innerHTML = "";

    
    if(Object.values(cita).includes("") || cita.servicios.length == 0){
        mostrar_alerta("errores", "Faltan datos o servicios", "#paso-3 p", false);
    } else {
        //Crear variables de la cita
        const {nombre, fecha, hora, servicios} = cita;
        
        //Mostrar Servicios
        const header_servicios = document.createElement("H3");
        header_servicios.textContent = "Servicios";
        resumen.appendChild(header_servicios);
        
        servicios.forEach(servicio => {
            const {id, precio, nombre} = servicio;
            const div_servicio = document.createElement("DIV");
            div_servicio.classList.add("contenedor_servicio");
            
            const nombre_de_servicio = document.createElement("P");
            nombre_de_servicio.textContent = nombre;
            
            const precio_de_servicio = document.createElement("P");
            precio_de_servicio.innerHTML = `<span>Precio:</span> $${precio}`;
            
            div_servicio.appendChild(nombre_de_servicio);
            div_servicio.appendChild(precio_de_servicio);
            
            resumen.appendChild(div_servicio);
            
        });
        
        //Datos Cliente
        const nombre_cliente = document.createElement("P");
        nombre_cliente.innerHTML = `<span>Cliente:</span> ${nombre}`

        //Formatear fecha al español
        const fecha_objeto = new Date(fecha);
        const dia = fecha_objeto.getDate() +2;
        const mes = fecha_objeto.getMonth();
        const year = fecha_objeto.getFullYear();
        const opciones = {weekday: "long", day: "numeric", month: "long", year: "numeric"};

        const fecha_utc = new Date(Date.UTC(year, mes, dia));
        const fecha_formateada = fecha_utc.toLocaleDateString("es-MX", opciones);

        const fecha_cita = document.createElement("P");
        fecha_cita.innerHTML = `<span>Fecha:</span> ${fecha_formateada}`

        const hora_cita = document.createElement("P");
        hora_cita.innerHTML = `<span>Hora:</span> ${hora}`

        const datos_cita = document.createElement("H3");
        datos_cita.textContent = "Datos de la cita";

        // Eliminar botón previo si existe
        const boton_anterior = div_resumen.querySelector("button");
        if (boton_anterior) boton_anterior.remove();


        //crear boton para enviar la reserva
        const boton_reservar = document.createElement("BUTTON");
        boton_reservar.classList.add("boton");
        boton_reservar.textContent = "Reservar Cita";
        boton_reservar.onclick = reservar_cita;

        info_cita.appendChild(datos_cita);
        info_cita.appendChild(nombre_cliente);
        info_cita.appendChild(fecha_cita);
        info_cita.appendChild(hora_cita);

        div_resumen.appendChild(boton_reservar);
    };
}

async function reservar_cita(){
    const {nombre, fecha, hora, servicios, id} = cita;
    const id_servicio = servicios.map(servicio => servicio.id);
    const numero_de_servicios = id_servicio.length;

    const datos = new FormData();
    datos.append("usuario_id", id);
    datos.append("fecha", fecha);
    datos.append("hora", hora);
    datos.append("servicios", id_servicio);

    try {
        const url = `${location.origin}/api/citas`;
        const respuesta = await fetch(url, {
            method: "POST",
            body: datos
        });
    
        const resultado = await respuesta.json();
        
        if(resultado.resultado){
            Swal.fire({
      icon: "success",
      title: "Cita creada",
      text: "Tu cita ha sido agendada",
      button: "OK"
    }).then(() => {
        window.location.reload();
            });
        };
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error inesperado",
            text: "Tu cita no ha sido agendada",
            button: "OK"
        });
    }
}
