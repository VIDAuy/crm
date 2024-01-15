/** v1.0.32 **/
👉 Identificación de usuario para las áreas Recepción, Morosos, Calidad, Servicios, Coordinación, Bajas y Calidad_interna.
👉 Cuando se carga un nuevo registro se guarda también el ID de la persona para saber quién cargo el mismo (Esto se cumple solo en las áreas a las que se le agregó la identificación).
👉 Se ordenaron las funciones sueltas en el archivo funciones.js en archivos nuevos agregados en JS/general.
👉 Posibilidad de cargar multiples archivos con un registro.
👉 Posibilidad de poder cargar un registro con archivo PDF.
👉 Si algún registro de la cédula tiene un PDF cargado, este se muestra en un iframe.
👉 Sesión expira cada 10 minutos de inactividad del mouse, tiene que ingresar la cédula para que se extienda la sesión.
👉 Posibilidad de agregar al socio a una agenda para volver a llamar, dejando así un comentario como referencia para que el usuario que vaya a llamar sepa lo que tiene que comunicar.
👉 El usuario de cédula 43382081 y de nombre “Paola Pagano” es el único que tiene la potestad de:
💨 Asignar las llamadas pendientes de volver a llamar a otro usuario de la misma área.
💨 Reasignar la llamada por si el usuario no puede realizar la llamada.
👉 Si hay una llamada pendiente asignada a un usuario y la hora está próxima a la hora registrada para volver a llamar, se le mostrará al usuario asignado un recordatorio en la parte superior cada 1 minuto.
👉 Se envía mail cuando se carga un registro avisando a otra área.
👉 Si el socio exige que se le envíe los Términos y Condiciones de sus servicios contratados, se les podrá enviar por defecto al primer celular registrado en padrón o si se ingresa un celular se le enviará al mismo.
👉 Se agregó el ID del registro a la tabla de “Historia Comunicación de Cédula” y se ocultó el mismo. Esta implementación fue solamente para ordenar la tabla.

/** v1.0.33 **/
👉 Se limpian los campos de selección de imagenes luego de la carga del registro.

/** v1.0.34 **/
👉 Se agregó el id_sub_usuario en la los registros de baja.

/** v1.0.35 **/
👉 Se optimizó la sección "Volver a llamar" dejando la asignación y reasignación de la llamada en una misma tabla.
👉 Se implemento la tabla de asignar las alertas pendientes a un usuario para el sector de Calidad y usuario 43382081 "Paola Pagano".

/** v1.0.36 **/
👉 Se registra el usuario que solicita la baja y el que la gestiona dejando en el registro el id_sub_usuario.
👉 Se agregó (fecha inicio, fecha fin, hora inicio, hora fin, horas por día, lugar, estado y patología) a la tabla de coordinación del socio.

/** v1.0.37 **/
👉 Se incluyerón más usuarios con la potestad de:
💨 Asignar las llamadas pendientes de volver a llamar a otro usuario de la misma área.
💨 Reasignar la llamada por si el usuario no puede realizar la llamada.

/** v1.0.38 **/
👉 Se agregó el sector de Bajas para asignar las alertas y las llamadas, quedo solo con el usuario gestor 43382081 "Paola Pagano".

/** v1.0.39 **/
👉 Se hicierón las modificaciones para que solo el usuario 44417851 "Sabrina De León" de Bajas pueda asignar alertas y llamadas.

/** v1.0.40 **/
👉 Modificación necesaria por remover código duplicado.

/** v1.0.41 **/
👉 Se implemento el historial de alertas y de volver a llamar.

/** v1.0.42 **/
👉 No se mostraba la cantidad de pendientes en agenda volver a llamar para el sector de Bajas.

/** v1.0.45 **/
👉 Se agregarón estados y motivos en la gestión de bajas y para calidad la opción de gestionar la baja como Elite o como Calidad.

/** v1.0.46 **/
👉 Se agregarón motivos de baja para el estado "En Gestión", (Aguardando auditoria y Pendiente excepción).

/** v1.0.49 **/
👉 Se agregó el checkbox para derivar a elite que registra la gestión por elite, le envía un correo avisando y le alerta en su usuario.
👉 Se creó el usuario "Elite" con nivel 3.
👉 Se agregó el motivo "Derivado a Elite" al estado "En Gestión" en la gestión de bajas.
👉 Se agregó una función para parsear los nombres con tíldes traidos de padrón.

/** v1.0.49 **/
👉 Se implementó para que puedan ver las patologías del socio y la posibilidad de agregarlas.

/** v1.0.59 **/
👉 Se deja registro cuando se agrega una patología a un socio.
