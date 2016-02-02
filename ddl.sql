/*
Navicat MySQL Data Transfer

Source Server         : MyData
Source Server Version : 50612
Source Host           : 127.0.0.1:3306
Source Database       : sdce

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-02-02 11:02:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_agencias
-- ----------------------------
DROP TABLE IF EXISTS `t_agencias`;
CREATE TABLE `t_agencias` (
  `ID_AGENCIA` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  `ID_CIUDAD` bigint(5) DEFAULT NULL,
  `NOMBRE_AGENCIA` varchar(80) DEFAULT NULL,
  `CORREO_AGENCIA` varchar(70) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO1` varchar(15) DEFAULT NULL,
  `TELEFONO2` varchar(15) DEFAULT NULL,
  `FAX` varchar(40) DEFAULT NULL,
  `PAGINA_WEB` varchar(150) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_AGENCIA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_agencias
-- ----------------------------
INSERT INTO `t_agencias` VALUES ('1', '1', '1', 'Alcaldía de Medellín', '', 'Calle 44 #52 - 165 Oficina 602', '3834136', '', '', '', '2015-11-06 05:35:35');
INSERT INTO `t_agencias` VALUES ('2', '1', '1', 'Fiscalía', '', 'Carrera 64C #67-300', '3117619919', '', '', '', '2015-11-06 05:37:16');
INSERT INTO `t_agencias` VALUES ('3', '1', '1', 'Ensambles y adornos', 'ensamblesyadornos@gruporhz.com', 'Transversal 78 #65-18', '4037090', '', '2571555', 'www.ensamblesyadornos.com.co', '2015-11-06 05:38:40');
INSERT INTO `t_agencias` VALUES ('4', '1', '1', 'Fundación Universitaria María Cano', '', 'Calle 56 #41 -90', '402 55 00', '', '254 59 57', 'www.fumc.edu.co', '2015-11-06 05:39:23');

-- ----------------------------
-- Table structure for t_asesoria_practicas
-- ----------------------------
DROP TABLE IF EXISTS `t_asesoria_practicas`;
CREATE TABLE `t_asesoria_practicas` (
  `ID_ASESORIA_PRACTICA` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PRACTICANTE` bigint(20) DEFAULT NULL,
  `TIPO_ASESORIA` int(1) DEFAULT NULL,
  `FECHA_HORA` varchar(20) DEFAULT NULL,
  `REUNION_ASESORIA` varchar(1500) DEFAULT NULL,
  `CONSECUTIVO` bigint(20) DEFAULT NULL,
  `FECHA_FINALIZA` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_ASESORIA_PRACTICA`),
  KEY `ID_PRACTICANTE` (`ID_PRACTICANTE`),
  CONSTRAINT `t_asesoria_practicas_ibfk_1` FOREIGN KEY (`ID_PRACTICANTE`) REFERENCES `t_practicantes` (`ID_PRACTICANTE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_asesoria_practicas
-- ----------------------------
INSERT INTO `t_asesoria_practicas` VALUES ('1', '3', '0', '28/07/2015 06:00 am', '* Hasta el día de hoy no se tiene el aval del futuro cooperador, puesto que esta solicitando la firma de un contrato de cooperación para que se lleve a cabo la práctica.\r\n* No se puede dar asesoría al estudiante hasta que no presente la carta de la empresa donde realizará el proyecto con sus funciones.', '1', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('2', '3', '1', '07/08/2015 06:00 am', 'Se realiza la segunda vista a la empresa con presencia del alumno y el colaborador para realizar \r\nla evaluación del primer momento', '2', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('3', '3', '1', '13/08/2015 06:00 am', '1. Agradecimiento\r\n2. Compra Sistema ERP\r\n3. Se realizaron 3 visitas, 1. inicio proyecto, 2. primera evaluación, 3. Segundo evaluación.\r\n4. La materia se gana de 3.5 en adelante y no se habilita ni posee segundo calificador.\r\n5. Se programa segunda visita para el jueves 27 septiembre\r\n6. Se programa la tercera visita para el 8 de octubre', '3', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('4', '3', '0', '20/08/2015 06:00 am', 'Para la próxima reunión se debe traer.\r\nPortada, contraportada, carta de aceptación,agradecimiento, dedicatoria, tabla de contenidos,\r\nintroducción, título, características generales de la institución, situación objeto, descripción general de la descripción \r\nproblemática, antecedentes, objetivos específicos, objetivos generales, justificación y población.\r\n\r\nEl trabajo debe tener: \r\nNormas APA, correcciones ortográficas, puntos y coma, justificación y fuentes bibliográficas.', '4', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('5', '3', '0', '27/08/2015 06:00 am', 'Para la próxima clase, se debe tarer el punto 8 \"Apectos metodológicos y procedimentales\".\r\n\r\nSe debe formatear el trabajo actual con las normas APA (Puntos del 1 al 8)', '5', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('6', '3', '0', '01/09/2015 06:00 am', 'Traer para el próximo encuentro:\r\n9) Aspectos legales (Marco legal) desarrollolo teniendo en cuenta: \r\nQue es licenciamiento, clases de licenciamiento, definir cada uno de ellos.\r\nRedactar un escrito teniendo en cuenta la clase de licenciamiento y los derechos de autor enfocado en el trabajo que se realiza\r\nen la empresa.\r\nQue es derechos de autor, cómo están catalogado y explique cada uno de ellos.\r\n\r\n10) Aspecto teórico y marco teórico y conceptual. Debe contener 5 páginas como mínimo donde realizará un ensayo del trabajo ralizado en la empresa.', '6', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('7', '3', '0', '03/09/2015 06:00 am', 'Aplicar normas APA al trabajo, justificar el trabajo escrito, revisar ortografía, mejorar redacción, eliminar\r\nabreviaturas, ampliar población bebeficiada.', '7', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('8', '3', '0', '08/10/2015 06:00 am', 'Revisar el punto \"aspectos del marco teórico y conceptual\". Debe contener 5 páginas como mímimo, donde relizará un ensayo del trabajo realizado en la empresa.\r\nSe realiza la evaluación docente por parte del alumno.\r\n\r\nTraer:\r\nPunto 9 \"Aspectos legales\". Se deberá desarrollar teniendo en cuenta:\r\n¿Qué es licenciamiento?\r\n¿Cuales son las clases de licenciamiento?\r\n¿Definir cada uno de ellos?\r\n¿Qué es un derecho de autor, cómo estan catalogados?\r\nExplique cada uno de ellos\r\nResultados, 12 conclusiones, 13 anexos y recomendaciones.', '8', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('9', '3', '1', '27/10/2015 06:00 am', 'Se realiza tercera visita para segunda evaluación.\r\nSe hace socialización de la práctica, queda el compromiso de presentar para el próximo encuentro, el trabajo y la carta de ka empresa informado que se aprueba la práctica,', '9', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('10', '3', '1', '04/11/2015 06:00 am', 'Se debe aplicar normas APA, aplicar imágenes y anexar bibliografías.\r\nReclamar la carta a la empresa que certifique la aprobación de la práctica dirigida a la universidad, con nombre completo y cédula de estudiante.\r\nEl trabajo debe estar completado para la próxima semana.', '10', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('11', '2', '0', '29/07/2015 07:00 am', 'El practicante llega tarde al encuentro se le recuerda que es a las 07:00am. *COMPROMISOS. 1. Fotocopia del carné. 2. Recibo de pago de la materia. 3. Carta de la Fiscalia con las funciones. 4. Cronograma de actividades a desarrollar. Se informa sobre como desarrollar el formato guia para practicas empresarial punto por punto. Nota: Se indica que este es el inicio de encuentro en la universidad.', '1', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('12', '2', '0', '10/08/2015 07:00 am', 'No se consigna hora de la reunión. \r\n\r\n1. Me comprometo a partir de la fecha a cumplir estrictamente con los horarios, fechas y actividades programadas dentro del proceso académico correspondiente a la asignatura práctica. \r\n\r\n2. En caso de un nuevo incumplimiento de mi parte, estoy informado y he comprendido que se iniciara por parte de la dirección del programa y la decanatura de la facultad el proceso de cancelación de la práctica por falta de asistencia, lo cual incluye que se me será reportado una nota definitiva de cero.\r\n\r\n 3. Me comprometo a partir de la presente semana a asistir a dos reuniones de asesoria semanal de práctica hasta recuperar las 4 faltas de asistencia registrada a la fecha. \r\n\r\n4. La reunión de asesoría adicional por las próximas 4 semanas de común acuerdo con el asesor se llevaran a cabo los martes a las 07:00am en el aula 403.', '2', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('13', '2', '0', '10/08/2015 07:00 am', 'No se consigna hora de la reunión. \r\n\r\n1. Horario de asesoria miércoles 6am a 7am aula 403 semanalmente.\r\n\r\n 2. Tener claro nombre completo del cooperador de la Fiscalia. \r\n\r\n3. Para la próxima saber direccion de la oficina.\r\n\r\n 4. Hasta la fecha tengo 4 faltas de asistencia de asesoria semanal de práctica. \r\n\r\n5. Pendiente a la fecha: *Fotocopia del carné. *Recibo de pago de la materia. *Carta de la fiscalia con funciones. *Cronograma de actividades a desarrollar. *No se a desarrollado los compromisos que se tenian establecidos para entregar. * Entrar al portal de la universidad y descargar el formato de práctica y diligenciarlo.  *Agradecimiento - Dedicatoria - Tabla de contenido - Titulos - Caracterización General - Objetivo General - Objetivos Específicos.  \r\n* Presentar los puntos anteriores el próximo miércoles 12/08/2015 a las 06:00am. \r\n* Confirmar reunión con el cooperador para el próximo miércoles 12/08/2015 a las 08:00am. \r\n* Enviar confirmación lunes 10/08/2015 al final de la tarde por correo electrónico al asesor. \r\n*En caso que la fecha señalada no este disponible en la agenda del cooperador informar al asesor fechas alternativas para la reunión. \r\n*Segunda reunión viernes 14/08/2015 a las 08:00am. \r\n* Leer todos los días el correo institucional. ', '3', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('14', '2', '1', '12/08/2015 08:00 am', '*Agradecimiento. * Los encuentros son semanales y presenciales. * Asesoría una hora completa. * Se realizarán tres visitas a la empresa. * La evaluación del proceso de práctica se lleva a cabo de manera conjunta con el cooperador y el asesor de cada uno de los proyectos de prácticas. * La evalución se hace en dos momentos en las fechas definidas en la asesoría. * No es práctica empresarial para optar al titulo de ingeniero se trata de una asignatura normal con 16 créditos. * No se habilita la materia. * La materia es normal, el estudiante puede ganar o perder de acuerdo a los logros obtenidos en el desarrollo de la misma. * La evaluación se hace de manera cualitativa y cuantitativa de acuerdo al formato estandar definido y suministrado por la FUMC para este proposito. * La escala de la evalución cuantitativa con un valor menor de 3.5 dará perdida la materia para el estudiante. * La empresa deberá proporcionar un paz y salvo por escrito una se haya con la práctica en formato fisico en papel membrete de la empresa firmado por el cooperador sellada y en original. * El contenido del paz y salvo debe hacer referencia a cada uno de los estudiantes que realizaron el proyecto a la culminacion exitosa del mismo con la obtencion de los resultados propuestos y expresar que la empresa recibe a satisfacción los resultados y por tanto los estudiantes quedan a paz y salvo con la empresa. * La escala de evalución cuantitativa debe ser de cero a cinco. Anexa celular 3117619919 e-mail: ayfbiem', '4', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('15', '2', '1', '12/08/2015 08:00 am', 'PRESENTA: * Introducción - Titulo - Caracterización, objetivos general y específico. DEBE: * Portada - Contraportada - Carta de presentación - Agradecimiento - Tabla de contenido - Introducción - objetivos y titulo. * Se tiene proyectado la terminación estudiando solo los martes medio tiempo  teniendo estipulado que la culminación de la práctica es el 22/12/2015. * El estudiante ya conoce la situación que enfrentará de no terminar con la práctica en la unidad de la Fiscalia. * No le atiendo en la próxima asesoría sino me trae los documentos solicitados.', '5', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('16', '2', '0', '19/08/2015 08:00 am', 'REVISION: * Se hace revision de manera verbal de la práctica realizada en la Fiscalia. * No asistí a la asesoría del día martes 18 de 7 a 8am. DEBE: * Ampliar la introducción ya que la tiene muy corta. * Ampliar el punto de caracterización de la institución objeto. * Mejorar el objeto general (esta muy ambiguo). * Mejorar los objetivos especificos. * Mejorar la revision realizadas. TRAES:  * Trabajar los puntos 4 y 5 (actividades realizadas - Descripcion del proceso). * El trabajo debe tener normas APPA, justificación, puntos y comas, fuente de imagenes, bibliografía, cibergrafía, etc. * Debo presentar los siguientes documentos para la próxima asesoría no será recibido: -Fotocopia del carné, carta de la fiscalia con las funciones, cronograma de actividades a desarrollar en la Fiscalia.', '6', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('17', '2', '0', '2/09/2015 07:00 am', 'No se consigna hora de la reunión. REVISIÓN: * Se hace revisión del trabajo presentado por escrito en el cual no se evidencia ningun adelanto significativo en la elaboracion del formato de practica. No se tiene ningun adelanto en dos semanas. DEBE: * Colocar la fuente de cada imágen para referenciar su origen, ampliar y dedactar mejor los puntos: Introducción, titulo, caracterizacion general de la institución objeto, objetivos, actividades realizadas, descripción de procesos, no se evidencia ningun resultado para mejorar y atender las recomendaciones realizadas en la asesoria. * NOTA: Se le informa que la semana siguiente no tiene asesoria ya que se le realizará la segunda visita para sacar la primer nota en compañia de la cooperadora en la empresa. * ATENCIÓN: No esta cumpliendo con los compromisos pactados con la fiscalia para asistir asesorias extras y reponer el tiempo perdido. TALLER: norma apa y correccion ortografica, puntos, comas, justificacion, fuente de imagenes, bibliografia y cibergrafia, etc.', '7', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('18', '2', '1', '9/09/2015 07:00 am', 'No se consigna hora de la reunión. REVISIÓN: * Se hace revisión del trabajo presentado por escrito en el cual no se evidencia ningun adelanto significativo en la elaboracion del formato de practica. No se tiene ningun adelanto en dos semanas. DEBE: * Colocar la fuente de cada imágen para referenciar su origen, ampliar y dedactar mejor los puntos: Introducción, titulo, caracterizacion general de la institución objeto, objetivos, actividades realizadas, descripción de procesos, no se evidencia ningun resultado para mejorar y atender las recomendaciones realizadas en la asesoria.\r\n\r\nNOTA: Se le informa que la semana siguiente no tiene asesoria ya que se le realizará la segunda visita para sacar la primer nota en compañia de la cooperadora en la empresa. \r\n* ATENCIÓN: No esta cumpliendo con los compromisos pactados con la fiscalia para asistir asesorias extras y reponer el tiempo perdido. TALLER: norma apa y correccion ortografica, puntos, comas, justificacion, fuente de imagenes, bibliografia y cibergrafia, etc.', '8', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('19', '2', '0', '16/09/2015 07:00 am', 'No se consigna hora de reunión. * Se realiza revisión del trabajo presentado, el estudiante deberá corregir y aplicar normas APA, debe tener el documento justificado, con el mismo tipo de lectura y tamaño, las imágenes deberán tener las fuentes referenciadas. * Debe entregar el cronograma de actividades. * Tiene 9 actividades y procesos, por lo cual las actividades deberan ser iguales a los procesos.', '9', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('20', '2', '0', '23/09/2015 07:00 am', 'No se consigna hora de reunión. \r\n* REVISIÓN: Práctica es hasta el 22/12/2015. * Consignar el nombre del asesor completo, fecha, cambiar la fecha del año, arreglar la contraportada, aplicar normas APA al documento margenes, espacio, justificación, etc.\r\n * La tabla de contenido debe ser dinamica, después de un punto final los espacios correspondientes a la norma. * Las imágenes deben tener las respectivas fuentes referenciadas. \r\nDEBE: * Actividades: Se debe especificar dia y semana, los procesos deben especificar  y explicar cada uno con dia y semana.\r\nHasta el 23 de septiembre debe llevar 10 semanas del proceso de práctica. * En la actualidad tiene actividades (9) y procesos (8). ', '10', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('21', '2', '0', '30/09/2015 07:00 am', 'No se consigna hora de reunión. * La práctica es hasta el 22/12/2015. * Debe revisar portada y contraportada, espacios después de los titulos, también los espacios después de los puntos, las imágenes debe tener las respectivas fuentes de referencia, revisar los puntos y coma. * No se evidencia la descripción de procesos de las últimas 8 semanas, solo se observa copia de texto. REVISION: * Se le comunica el día y la fecha de la vistia para confirmar su disponibilidad para llevar a cabo el inventario, una vez confirmada la cita, llegado el momento procedemos a inventariar y plaquetear todos los activos de estos usuarios, después de terminado este proceso se le confirma recoger la firma y se le hace entrega del paz y salvo, los activos faltantes, y luego se sube toda la información a la intranet de la institución. \r\nDEBE: *Se debe especificar actividades de cada dia y semana.  PROCESOS: *  Se debe especificar y explicar cada uno de ellos por día y semana hasta el 07/10/2015 se deberá presentar 2 semanas de procesos de práctica. \r\nDEBERÁ LLEGAR A LAS 06:00AM EN PUNTO. * El trabajo deberá tener normas APA, corrección de ortografía, puntos y comas, justificación, fuentes de imágenes, bibliografía y cibergrafía, etc.', '11', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('22', '2', '0', '07/10/2015 07:00 am', 'Semana 13. \r\n* Debe revisar la portada y contraportada, los espacios después de los puntos, las imágenes deben tener las respectivas fuentes referenciadas, revisar los puntos y las comas. \r\n\r\nACTIVIDADES: * Se debe especificar cada dia y semana, los procesos deben ser especificados y explicar cada uno de ellos por día y semana (fecha). * Debe llegar a las 06:00am. * El trabajo debe tener normas APA,etc. ', '12', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('23', '2', '0', '15/10/2015 07:00 am', 'Semana 14 REVISIÓN:\r\n *Debe realizar la portada y contraportada, los espacios después de los puntos, titulos. Las imágenes deberan tener sus respectivas fuentes referenciadas, revisar puntos y comas.\r\n* Debe trabajar en las actividades.\r\n* Trabajar en la descripción de procesos, especificando y explicando cada uno de ellos con fecha.\r\n* Deberá llegar a las 06:00am. \r\n* Trabajar normas APA y demás como ortografia y errores gramaticales.', '13', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('24', '2', '1', '27/10/2015 07:00 am', 'No se consigna hora de reunión.  \r\n1. Se realiza la tercera visita para hacer la última evaluación y seguimiento a la práctica. COMPROMISO:\r\n* Terminar la práctica sin ningún inconveniente hasta el 22/12/2015. \r\n* Entregar el trabajo realizado la próxima semana.', '14', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('25', '2', '0', '05/11/2015 07:00 am', '* Se debe organizar el trabajo con las normas APA y referenciar las imágenes anexadas cada una de ellas. \r\n* Se debe justificar el trabajo teniendo en cuenta las normas APA. \r\n* Debe revisar el trabajo y si encuentra errores de redacción se debe poner el significado de las siglas que tiene en el trabajo.', '15', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('26', '1', '0', '28/07/2015 06:00 am', '* Hasta el día de hoy no se tiene el aval del futuro cooperador, puesto que esta solicitando la firma de un contrato de cooperación para que se lleve a cabo la práctica.\r\n\r\n* No se puede dar asesoría al estudiante hasta que no presente la carta de la empresa donde realizará el proyecto con sus funciones.', '1', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('27', '1', '0', '28/07/2015 06:00 am', 'No se consigna hora ni fecha de reunión. \r\n * Se hace revisión del trabajo presentado el cual deberá realizar una ampliacion a los puntos presentados y tener presente el orden de la guia de práctica. \r\n\r\nDEBE:\r\n * Arreglar el punto 1 el titulo completo. \r\n* Adicionar mas contenido en el punto 2 caracterización general de la institución objeto, debe la población, la función empresarial, y el organigrama. \r\n* Situación problemática, descripción general de la situación. \r\n* Corregir objetivo general y especificos, redactar mejor. COMPROMISOS: \r\n* Traer punto 8, aspectos metodologicos y procedimentales. \r\n* El trabajo debe contener normas APA.', '2', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('28', '1', '0', '04/08/2015 06:00 am', 'No se consigna hora de reunión. \r\n El 11/08/2015 se realizará la primera visita a las 08:00am. Cel: 3014116434. ACTUALIZACIÓN:\r\n *Se hizo la codificación del proyecto por solicitud de uno de los cooperadores. COMPROMISOS: Entregar \r\n*Fotocopia carta de aceptación práctica. * Fotocopia recibo de pago. \r\n* Fotocopia carné.\r\n DEBE: \r\n*Cronograma de actividades.\r\n* Descargar formato de presentación trabajo de aplicacion la práctica que se encuentra en el portal en el centro de practicas o en el link del profesor. Materia prácticas.\r\n* Después de descargarlo desarrollar portada, contraportada, agradecimiento, dedicatoria, tabla de contenido, introducción, titulo, caracterización, situación problematica, descripción, objetivos, antecedentes, diagnostico conceptual, objetivos general y especifico.', '3', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('29', '1', '1', '11/08/2015 06:00 am', 'No se consigna hora de reunión. \r\n*Agradecimiento. \r\n* Los encuentros son semanales y presenciales. * Asesoría completa. \r\n* Se realizarán 3 visitas a la empresa.\r\n* la evaluación del proceso de práctica se lleva acabo de manera conjunta entre el cooperador y asesor de cada uno de los proyectos de practica.\r\n* Evaluación se hace en 2 momentos en fechas definidas en la asesoría.\r\n*No es práctica empresarial para optar al título de ingeniero, se trata de una asignatura normal con 16 créditos.\r\n* No se habilita la materia.\r\n* La materia es normal, el estudiante la puede ganar o perder de acuerdo a los logros obtenidos en el desarrollo de la misma.\r\n* La evaluación se hace de manera cualitativa y cuantitativa de acuerdo al formato estandar definido y suministrado por la FUMC para este propósito.\r\n*La escala de la evaluación cuantitativa debe ser entre cero y cinco. * En la escala definida para la evaluación cuantitativa, con un valor de la evaluación menor de 3.5 dará pérdida de la materia para el estudiante.\r\n* La empresa deberá proporcionar un paz y salvo por escrito, una vez se haya cumplido con la práctica en formato fisico, en papel membrete de la empresa y firmado por el cooperador, sellado y en original. \r\n* El contenido del paz y salvo debe hacer referencia a cada uno de los estudiantes que realizaron el proyecto de práctica, a la culminación exitosa del mismo con la obtención de los resultados propuestos y expresar que la empresa recibe a satisfacción  tales resultados y', '4', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('30', '1', '0', '18/08/2015 06:00 am', 'No se consigna hora de reunión. \r\n* No traje los datos solicitados (portada, contraportada, objetivos). \r\nDEBE. *Justificación y población beneficiada y puntos anteriores.\r\nPRESENTO: \r\n*Cronograma de actividades, recibo de pago y carta de aceptación del cooperador para la universidad. \r\nVERBALMENTE: \r\n* Se hace seguimiento de la práctica de la empresa, en la cual no se a realizado la reunion de toma de requerimientos. Se recomienda realizar seguimiento via email informando que esta a la espera de concretar reunión para continuar con el proyecto que se encuentra parado por esta. \r\nCOMPROMISO: \r\n* Traer también aspectos metodologicos y procedimentales.', '5', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('31', '1', '0', '1/09/2015 06:00 am', 'No se consigna hora de reunión.\r\nDEBE:\r\n* Colocar la fuente de cada imagen y referenciar su origen, ampliar los puntos, descripcion general de la situación problemática, antecedentes y diagnostico contextual.\r\n* Replantear el objetivo general y especificos.\r\n*Ampliar la justificación (razones, técnicas económicas, sociales, culturales que explican porque el proyecto es necesario o importante enla solución de la situación problematica). \r\n* Ampliar la población beneficiada (identifique la población directa e indirecta que se benefician, especificando el total).\r\n* Ampliar los aspectos metodologicos y procedimentales (describa paso a paso los procedimientos a utilizar para la realización del trabajo de ampliación, indicando fuentes e instrumentos para la recolección de datos asi como herramientas para analizarlos).\r\n COMPROMISOS:\r\n * Traer el trabajo el cual debe tener normas APA.', '6', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('32', '1', '1', '10/09/2015 02:00 pm', 'Se realiza la segunda visita en la emrpesa con el fin de realizar la primera evaluación de la práctica y realizar seguimiento de la práctica correspondiente.', '7', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('33', '1', '1', '10/09/2015 02:00 pm', 'COMPROMISOS:\r\n 1. Recolectar hoja de vida de un posible practicante.\r\n 2. Tener formulario de petición de práctica.\r\n 3. ilustrar los procedimientos de como funcionará desde la petición hasta las diferentes areas para solicitar practicante. \r\n4. Solicitar colores, logotipo, letra (comunicaciones). \r\n5. Tramitar solicitud en tecnologia para implementación.\r\n * Entregar 24/09/2015. Replantear cronograma de actividades. \r\n* Se realizó asesoría el 10/09/2015 de 2 a 4pm en la Alcaldía de Medellín.', '8', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('34', '1', '0', '15/09/2015 02:00 pm', 'No se consigna hora de reunión.\r\n * Se realiza la revisión del trabajo, al cual le hace falta colocarle las fuentes a las imágenes.\r\nDEBE: \r\n1. Ampliar los puntos= 3.1 Descripcion general de la situacion problemática, 3.2 Antecedentes de la situación problematica. \r\n4. Diagnostico contextual-situación actual, 6. Justificación, 7. Población beneficiada, 8. Aspectos Metodologicos y procedimentales. COMPROMISOS: 1. Ampliar y mejorar el contenido de los puntos anteriores, ya que estan muy cortos de contenido y no see cumple con el objetivo propuesto. Se debe presentar en la próxima asesoría.\r\n TRAER: \r\n1. El numeral 9 Aspectos Legales (marco legal), se deberá desarrollar  teniendo en cuenta:\r\n * Qué es licenciamiento?, cuáles son las clases de licenciamiento?, y definir cada uno de ellos\r\n. * Qué es derechos de autor?, cómo estan catalogados? y explique cada uno de ellos.\r\n * El trabajo de tener normas APA.\r\n * Debe traer cronograma de actividades modificado con la fecha de terminación del proyecto en la empresa.\r\n* Cuál es el contenido que debe tener el desarrollador para empezar a desarrollar el producto?. (Manuel).', '9', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('35', '1', '0', '22/09/2015 02:00 pm', 'No se consigna hora de reunión. \r\n *  El numeral 9 Aspectos Legales (marco legal), se deberá desarrollar  teniendo en cuenta:\r\n * Qué es licenciamiento?, cuáles son las clases de licenciamiento?, y definir cada uno de ellos. \r\n* Qué es derechos de autor?, cómo estan catalogados? y explique cada uno de ellos enfocado en el trabajo que se realizará con el desarrollo del sitio web. \r\n* El trabajo de tener normas APA.\r\n * Debe traer cronograma de actividades modificado con la fecha de terminación del proyecto en la empresa. \r\n* Cuál es el contenido que debe tener el desarrollador para empezar a desarrollar el producto?. \r\n* Se debe consultar los pasos previos que necesita un desarrollador para iniciar el proceso del desarrollo del producto. \r\n* Ampliar redacción de los puntos 3.1, 3.2, 4 y 8. \r\n* Revisar objetivo general, justificación y población beneficiada. * Modificar los objetivos especificos y el general.', '10', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('36', '1', '0', '29/09/2015 02:00 pm', 'No se consigna hora de reunión. \r\n* Cronograma de actividades modificado. \r\n* Cuál es el contenido que debe tener el desarrollador para empezar a desarrollar el producto? \r\n*Redactar un ensayo de 5 paginas donde se describan los aspectos teoricos conceptuales para el desarrollo. AMPLIAR.\r\n* Puntos 3.1, 3.2, 4 y 8. \r\n* Revisar objetivo general, justificación y población beneficiada.\r\n * Modificar los objetivos especificos y el general.\r\n * Se debe consultar los pasos previos que necesita un desarrollador para iniciar el proceso del desarrollo del producto.\r\n* El trabajo de contener normas APA.', '11', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('37', '1', '0', '06/10/2015 02:00 pm', 'No se consigna hora de reunión.\r\n* no esta realizando el trabajo escrito en la práctica empresarial. No ha construido detalladamente el cronograma de actividades que le ayudará a entregar el producto en la empresa. \r\n* No trajo lo solicitado pra el encuentro \r\n\r\nCOMPROMISOS * Cronograma de actividades modificado.\r\n * Cuál es el contenido que debe tener el desarrollador para empezar a desarrollar el producto?\r\n*Redactar un ensayo de 5 paginas donde se describan los aspectos teoricos conceptuales para el desarrollo. AMPLIAR. \r\n* Puntos 3.1, 3.2, 4 y 8. \r\n* Revisar objetivo general, justificación y población beneficiada. \r\n* Modificar los objetivos especificos y el general.\r\n* Se debe consultar los pasos previos que necesita un desarrollador para iniciar el proceso del desarrollo del producto.\r\n* El trabajo de contener normas APA.', '12', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('38', '1', '0', '13/10/2015 02:00 pm', 'No se consigna fecha ni hora de reunión. \r\n* No presento el trabajo escrito en la práctica empresarial. No realizó revisión nuevamente del cronograma de actividades, el cual prooyecto entregar la practica en la empresa en diciembre.\r\nCOMPROMISOS \r\n* Atención, debe presentar el trabajo escrito sin contratiempos de lo que se le solicita. \r\n* Para la próxima semana se realizará la segunda visita en la empresa, para realizar la evaluación por parte del cooperador. \r\n* Se debe terminar el trabajo de prácticas en su totalidad, para ser entregado con las características exigidas por la universidad.\r\nDEBE:\r\n*Desarrollar el numeral 10. Aspectos Teoricos Generales (ensayo), 11. Resultados, 12. Conclusiones, 13. Recomendaciones y Bibliografia.* El trabajo de contener normas APA.', '13', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('39', '1', '1', '27/10/2015 08:00 am', 'Se realiza la segunda visita pero no se puede realizar evaluación ya que el cooperador no tiene disponibilidad debido a actividades establecidas que surgieron a última hora, por lo cual reprogramamos para el próximo martes 3 a las 8am.\r\n* Se revisa trabajo el cual hasta el momento tiene 44 hojas, se debe terminar todo el trabajo para la próxima semana y presentar en power point la presentación con elementos reales del prototipo de trabajo presentara en la practica.', '14', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('40', '1', '0', '03/11/2015 02:00 pm', 'No se consigna hora de reunión.\r\n\r\n * Se debe organizar el trabajo con las normas APA y referenciar las lineas pegadas de internet. \r\n* Debe reclamar la carta de la empresa dirigida a la universidad donde se informa que cursó y aprobó la práctica. \r\n* Debe organizar los puntos 11. Resultados, 12. Conclusiones, 13. Recomendaciones, respecto a la práctica.', '16', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('41', '1', '1', '03/11/2015 02:00 pm', 'No se consigna hora de reunión. \r\n* Se realiza la tercera visita a la Alcaldía de Medellín con el objetivo de realizar la segunda evaluación de la práctica que realiza el estudiante.', '15', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('42', '7', '0', '03/08/2015 6:00am', 'Las asesorias son todos los lunes de 6:00am a 7:00am.\r\nDebe: \r\n-Confirmar la cita con el cooperador para la otra semana. \r\n- Descarga de la pagina de la FUMC o del portar del asesor el formato de practica empresarial hasta el numeral de los objetivos general y especifico.\r\n-Debe fotocopia del carnet cololla de pago y cronograma. Actividades debidamente deligenciados con las caracteristicas establecidas con el cooperador y las visitas con la decanatura.', '1', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('43', '7', '0', '11/08/2015 6:00am', '-Se recuperara la asesoria perdida del dia lunes 10/08/2015. \r\n-Se acordara la fecha con el asesor. \r\n-El estudiante solicita que la asesoria sea para el dia 09/10/2015. -Fotocopia carnet (jueves). \r\n-Fotocopia colilla pago (jueves).\r\n -Cronograma de actividades (viernes) enviado por email.\r\n -Diligenciar formato. -Para todos los compromisos traer los trabajos en una memoria.', '2', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('44', '7', '0', '11/08/2015 6:00 am', 'Agradecimientos: \r\n-Los encuentros son semanales y presenciales. \r\n-Asesorias completas.\r\n -Se realizaran 3 visitas a la empresa.\r\n -La evaluacion del proceso de practica se lleva de manera conjunta entre el cooperador y el asesor de cada uno de los proyectos de practicas. \r\n-La evaluacion se hace en dos momentos en fechas definidas en las asesorias.\r\n -No es practica empresarial para optar al titulo de ingeniero de sistemas.\r\n -Se trata de una asignatura normal con 16 creditos.\r\n -No se habilita la materia. \r\n-La materia es normal y el estudiante la puede ganar o perder deacuerdo con los logros obtenidos con el desarrollo de la misma. -La evaluacion se hace de manera cualitativa y cuantitativa deacuerdo al formato estandar definido y suministrado por la FUMC. para este proposito.\r\n-La escala de evaluacion cuantitativa debe ser entre 0 y 5. \r\n-La escala definida para la evaluacion cuantitativa, con un valor de la evaluacion menor a 3,5 para perdida de la materia para el estudiante. \r\n-La empresa debe suministrar un paz y salvo por escrito, una vez se halla cumplido con la practica en formato fisico, en papel membrete de la empresa, firmado por el cooperador, cellado y en original.\r\n-El contenido del paz y salvo debe hacer referencia a cada uno de los estudiantes que realizaron el proyecto de practica, a la culminacion exitosa del mismo con la obtencion de los resultados propuestos y expresar que la empresa recibe la satisfaccion tales resultados y por tanto los estudiantes qu', '3', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('45', '7', '0', '11/08/2015 6:00 am', 'Debe:\r\n -Desarrollar los numerales hasta el 5to punto. \r\n-Fotocopia carnet por ambos lados, colilla de pago, cronograma de actividades debidamente diligenciados con cooperador y las visitas programadas a la decanatura\r\n. -Se ha realizado la investigacion sugerida por el cooperadorcon el objetivo de documentarse acerca de un sistema de gestion. \r\n-Ya se tienen algunos requerimientos validos con el cooperador, como son: \r\n-Historia clinica de los equipos de computo.\r\n -Generacion de informes. \r\n-Administracion de los recuersos de la FUMC del laboratorio de telematica de la misma. \r\n-Debe la reunion con la docente silvia para la iniciacion de la toma de requerimientos y empezar la produccion.', '4', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('46', '7', '0', '20/08/2015 6:00 am', 'Revision: \r\n-Se realiza asesoria el dia jueves 20 de agosto de 2015 de 9:00 a 10:00am. \r\n-Se hace entrega de copia del carnet. \r\n-Portada. -Contraportada.\r\n-Carta de aceptacion del asesor firmada. \r\n-Agradecimientos.\r\n-Tabla de contenido.\r\n-Introduccion. \r\n-Titulo.\r\n -Caracterizacion general de la institucion objeto. -Objetivos: Los objetivos deberan ser proyectados teniendo encuenta los puntos anteriores.\r\n -Objetivo general. -Objetivo especifico.\r\n-Actividades realizadas. -No realizar el numeral 5to, descripcion de los procesos. \r\nDebe:\r\n-Cronograma de actividades.\r\n-Colilla de pago.\r\n- Dedicatoria.\r\n-En la introduccion se debe ampliar y socializar con el cooperador. -En la caracterizacion de la institucion objeto se debe ampliar y socializar con el cooperador.\r\n-5to descripcion de procesos. \r\nTraer: Actividades realizadas.\r\nEl trabajo debe tener: norma APA, correccion ortografica, puntos y comas, justificado, fuentes de imagenes, bibliografia y cibergrafia.', '5', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('47', '7', '0', '05/09/2015 6:00 am', '-Revision de las actividades y la descripcion de procesos, los cuales se deben seguir trabajando y ampliando para poder evidenciar el trabajo de practica que se viene evidenciando. \r\nDebe: Continuar trabajando las actividades y descripcion de los procesos.\r\n -Ojo: No se ha definido el alcance del trabajo con el cooperador.', '6', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('48', '7', '0', '10/09/2015 9:00am', 'No se tiene el cronograma de actividades.\r\n-No se evidencia trabajo alguno durante el desarrollo de la guia de practica. \r\nCompromisos:\r\n-Se hace entrega del cronograma el jueves 17. \r\n-Desarrollo de actividades para el viernes y descripcion de procesos.', '7', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('49', '7', '1', '10/09/2015 6:00am', '-Se realiza la segunda visita y se hace la evaluacion con el asesor, cooperador y estudiantes, se hace seguimiento de la practica. \r\n-Se valida con el cooperador que no se ha evidenciado los avances en cuanto al desarrollo. Debe: Compromiso, \r\n Traer para la asesoria el documento con todo lo que se ha trabajado. \r\n-Evidenciar el desarrollo, pantallazos, aplicacion al cooperador.', '8', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('50', '7', '0', '17/09/2015 6:00 am', 'Revision: Se realiza revision del trabajo, el cual debera organizar las fechas que son las representantes de cada actividad y los procesos descriptos.\r\n -Tiene un total de actividades (27) y procesos (24) y tiene un total de 22 hojas en el trabajo.\r\n -Las imagenes deben documentarse las fuentes de origen. -Presentar cronograma de actividades. -El porcentaje de la practica va en 60%.\r\n \r\nDebe: Caracterizacion general de la institucion objeto, debe contener el nombre de la institucion, una breve historia, fecha fundacion, fundadores, origen, su hubicacion geografica, los aspectos teologicos que la componen, la descripcion, la poblacion, organogramo, redactar y seguir cada una de las sugerencias realizadas. \r\n-Tabla de contenido. \r\n-Redactar y argumentar cada una de las actividades y procesos realizados en la practica.', '9', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('51', '7', '0', '08/10/2015 6:00 am', 'La practica va en un procentaje del 64%, se realiza evaluacion del docente por parte del alumno.\r\n\r\n Revision:\r\n-Se debe ampliar el contenido del material. \r\n-Debe especificar mejor el numeral 4, el de actividades realizadas. -Las imagenes deben tener las fuentes respectivas.\r\n -Para el punto 5 debe especificar mejor los dias en los que realizaron la practica.', '11', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('52', '7', '0', '22/10/2015 6:00 am', 'Se debe de terminar de ampliar la introduccion y el numeral 2 (debe contener el nombre de la institucion, una breve historia, fecha fundacion, fundadores, origen, su hubicacion geografica, los aspectos teologicos que la componen, la descripcion, la poblacion, organigrama.)\r\n-Debe colocar fuentes a cada imagen que tenga el documento. \r\n-Debe anexar un video donde se realiza la introduccion de la materia y el desarrollo que explicara seguidamente, se debe demostrar por todo el programa, donde se escuchara cada uno de los campos, su funcionamiento, posteriormente al video realizar las recomentaciones y concluciones. \r\nDebe: Desarrollar los puntos, numeral 4 actividades realizadas en practica, 5 descripcion de procesos, 6 aportes realizados a la empresa, 7 recomendaciones (presentes indicacion). El trabajo debe tener: norma APA, correccion ortografica, puntos y comas, justificado, fuentes de imagenes, bibliografia y cibergrafia.', '12', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('53', '7', '1', '30/10/2015 6:00 am', 'Se realiza la tercera visita a la empresa para realizar la segunda evaluacion.', '13', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('54', '7', '0', '06/11/2015 6:00 am', 'Se revisa el trabajo final, en el cual deberan ingresar las actividades de las ultimas semanas y los procesos detallados. Se debe realizar el trabajo y tener presente los espacion y las respectivas justificaciones en cada hoja del trabajo. Compromiso, Debera presentarse el dia lunes 9 de noviembre con la carta del cooperador de aceptacion, la cual presentara para anexarla con la carta del asesor y asi poder presentar el trabajo el dia miercoles.', '14', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('55', '4', '0', '24/07/2015 6:00 am', '-Tener los 4 documentos por cada estudiante.\r\n -Cronograma de actividades. \r\n-Portada. -Contraportada. \r\n-Carta de aceptacion.\r\n-Agradecimientos.\r\n-Dedicatoria. \r\n-Tabla de contenido\r\n-Introduccion.\r\n-Titulo.\r\n -Caracterizacion general de la institucion objeto.', '1', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('56', '4', '0', '31/07/2015 6:00am', 'Debe:\r\nCronograma de actividades. Se hace revision del formato de practica en el cual estan debiendo el punto numero 2 que es la caracterizacion general de la institucion objeto. Se hace entrega de la colilla de pago y el carnet.', '2', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('57', '4', '1', '05/08/2015 6:00 am', 'En la reunion se acuerda que el proyecto de practica se basa en la entrega de la formulacion y desarrollo del sistema para evaluar las practicas.\r\n-Se acuerda que de forma mensual se estara programando una reunion con el asesor y decanatura de forma independiente. \r\n-Se organiza el cronograma de actividades donde estara plasmado la formulacion, diseño e implementacion del proyecto.\r\n-Se realiza la primer visita en presencia del cooperador a las 8:30am el dia 05/08/2015.\r\n-Se socializa con el cooperador el inicio del proyecto y su finalizacion. -Se dan las gracias por permitir la realizacion de las practicas.\r\n-Se coordinan las 3 visitan que se realizaran en la practica con el cooperador, asesor y los estudiantes.\r\n -Se informa cual es el tipo de evaluacion que se realizara, sera en dos momentos. \r\n-Se le informa a los presentes que la asegnatura no tiene segundo calificador y se gana con 3.5 en adelante.\r\n\r\n- Las inasistencias deberan ser evaluadas por decanatura y el cooperador y de lo contrario no sera admitida.\r\n-Debe ser aprobada y cursada la practica, el cooperador proporsionara una carta con el nombre de los estudiantes confirmando que fue cumplido en su totalidad la asignatura.\r\n-La asesoria es semanal y presencial.\r\n-Se deberan entregar dos productos 2cd\'s, uno con la documentacion del proyecto realizado con el cooperador, el segundo cd contendra el desarrollo del documento descargado de la pagina de la FUMC, estatutos o formato de la practica.', '3', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('58', '4', '0', '18/08/2015 10:00 am', 'Se hace presentacion de avances del proyecto, donde el asesor hace recomendaciones.\r\nSe revisan formatos que debe contener el proyecto. Junto con el cooperador y el asesor se hara la presentacion de los avances del proyecto donde ambos le dan la aprovacion y hacen las respectivas recomendaciones. Se hacen requerimientos del sistema por parte del asesor donde se hace registro de los requirimientos.', '4', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('59', '4', '0', '14/08/2015 6:00 am', 'Se hace lectura de la respuesta a la solicitud de practica. \r\nFalta: \r\nActividades y procesos. \r\nPendiente: Consultar cual es el proceso inicial para que le acepten la modalidad de practica. Se entrega cronograma de actividades.', '5', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('60', '4', '0', '21/08/2015 6:00am', 'Se hace presentacion del formato de practica y el asesor hace las pertinentes observaciones de cada uno de los puntos del proyecto que se debe presentar. \r\nPor parte del asesor se retroalimenta el como se debe documentar las actividades realizadas y la descripcion de procesos. Revision, se realiza asesoria extra el dia miercoles 10 de agosto de 9:00 a 10:00am. \r\nSe hace revision del trabajo de practica via web de como esta quedando el desarrollo del software. \r\nSe realiza la revision de la actividad del formato de practica y solo tiene 3 fechas reportadas y no es muy convincente el trabajo que estan realizando. \r\nDebe: \r\nTrabajar mas en el formato de practica, por que no estan evidenciando todas las actividades que ejecutan ni hacen las respectivas descripcion de ellas. Preparar una capacitacion para el dia que se entregue el producto funcionando. \r\nTraer:\r\n Actividades realizadas y descripcion de procesos. El trabajo debe Tener:\r\n norma APA, correccion ortografica, puntos y comas, justificado, fuentes de imagenes, bibliografia y cibergrafía.', '6', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('61', '4', '0', '04/09/2015 6:00 am', 'Deben: \r\n-Ampliar y detallar las actividades, no realizarlas por semana.\r\n-Solo media pagina de actividades. \r\n-Solo 5 paginas de la descripcion. Se ampliaran cada una de las actividades que se vayan desarrollando en el proyecto de practica. Hacer la descripcion detalladamente de cada una de las actividades que se tienes en el punto anterior.\r\n- Deben estar muy pendientes de las reuniones asignadas por el cooperador.\r\nCompromisos:\r\nAgendar las reuniones con el cooperador y validar con el resto de compañeros si la disponibilidad si se puede dar para dicha reunion.', '7', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('62', '5', '0', '09/09/2015 8:00 am', 'Se realiza evaluacion en compañia del asesor, el cooperador y los estudiantes. Se hace seguimiento de la practica. Se hace presentacion de la pagina. Se hacen observaciones del sistema.', '8', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('63', '5', '1', '02/10/2015 2:00 pm', 'Se reevaluan los compromisos de la practica. \r\nLa profesora deja en claro la responsabilidad de realizar la autoevaluacion por parte de los docentes, para afianzar las fortalezas de los estudiantes. \r\nLos profesores se comprometeran a enviar por correo todo lo que sucede en las asesorias y encuentros que se realizan en las visitas.\r\nHacer las actas digitales para que sean diligenciadas por los estudiantes por medio de un link encriptado.', '9', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('64', '5', '0', '11/09/2015 6:00 am', 'Aun no se ha terminado de diligenciar el informe de practica. \r\nSe habla acerca de las responsabilidades con respecto al proyecto. Se dio una charla motivacional acerca de los cargos de cada estudiante para no incurrir en el cumplimiento de los objetivos. Se realiza seguimiento a la practica, desarrollo la cual va en un porcentaje del 72%.\r\n Se hace seguimiento al formato de practica de la validacion el cual se esta trabajando en el 4 y 5 punto de actividades y descripcion de procesos. Debe: Ampliar los puntos 4 y 5.\r\nCompromisos:\r\n\r\n Para la otra semana deberan presentar los avances de la practica y el contenido de los puntos solicitados en el. Se agenda visita para el dia lunes 14/09/2015.', '10', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('65', '5', '0', '16/09/2015 6:00 am', 'Compromisos:\r\n Para cuando se haya finalizado con el desarrollo deberan presentar los integrantes del grupo un video tutorial de como se administra, como se gentiona y se opera el software desarrollado el cual servira de entrenamiento para los docentes.\r\nRevision: Se realiza revision del numeral 4 y 5 de actividades y descripcion de procesos la cual va itens 26. \r\nDebe: Traer para el proximo encuentro documentados los puntos 4 y 5 con las actividades que se realizan esta semana y con los procesos descriptos. \r\n\r\nNota: Proximo encuentro viernes 18 de septiembre de 2015.', '11', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('66', '5', '0', '18/09/2015 6:00 am', 'Se presentan avances del desarrollo y se toman requerimientos sobre los formatos y requerimiento de paz y salvo de las deprendencias de decanatura, admisiones biblioteca. Se realiza seguimiento a la practica, desarrollo, la cual va en un procentaje del 70.2%. \r\nSe hace seguimiento al formato de practica de la validacion el cual estan trabajando en el punto 4 y 5 de actividades y descripcion de procesos. \r\nDebe: \r\nAmpliar los puntos 4 y 5. \r\nCompromisos: \r\nPara la otra semana deberan presentar los avances de la practica y el contenido de los puntos solicitados en el formato. Se agenda visita para el dia lunes 21 de septiembre de 2015.', '12', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('67', '5', '0', '25/09/2015 6:00 am', 'Se revisa el informe de practicas hasta la fecha. Revision: Se realiza seguimiento a la practica, desarrollo el cual va en el 85%. Se hace seguimiento al formato de practica de validacion en la cual se esta trabajando en los puntos 4 y 5 actividades y descripcion de porcesos. No se avidencia actualizacion del trabajo, ya que el ultimo registro de fechas que se presentan tiene la actividad de la semana 11 de septiembre de 2015. \r\nSe hace la asesoria correspondiente con el asesor. Por otro lado los procesos estan en el numeral 26 (en esta asesoria se hace presentacion del formato de practica empresarial donde el docente hace las correcciones pertinentes y se hace un detalle de todo el proceso de practica donde nos retroalimenta en cada uno de los factores que hemos trabajado y que en ocaciones no se han cumplido. \r\nDebe:\r\n La introduccion del trabajo que se esta realizando de practica. Ampliar los puntos 4 y 5.\r\nCompromisos:\r\nPara la otra semana deberan presentar los avances de la practica y el contenido de los puntos solicitados en el formato.', '13', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('68', '4', '0', '21/09/2015 6:00am', 'Asesoría extra.\r\nSe habla sobre el trabajo que se presentara al cooperador, se habla de todos los puntos donde se brindan opciones de mejora y recomendaciones para su carrecta elaboracion.\r\n\r\nDada  la semejanza entre los documentos o trabajos que se deberan entregar tanto al asesor como al cooperador, se realizara las correcciones dadas para los puntos que se comparten. \r\nUnicamente asistio el estudiante Gustavo Arcila a la asesoría extra.', '14', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('69', '6', '0', '02/10/2015 6:00am', 'Se realiza la revision del documento y se realizan varias observaciones. Ampliar la introduccion y mejorar la redapcion.\r\nPoner cuidado con los espacios y las justificaciones del texto en la descripcion de los procesos, se debe evidenciar el trabajo que se realizo en el desarrollo del codigo fuente.\r\nEl trabajo debe tener: norma APA, correccion ortografica, puntos y comas, justificado, fuentes de imagenes, bibliografia y cibergrafia. Compromiso: Reunion 5/10/2015 para revisar el desarrollo.', '15', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('70', '6', '0', '09/10/2015 6:00 am', 'No se presenta trabajo (Avances) debido a que la informacion que contenia la informacion de la memoria usb al momento de introducirla al pc se borro.\r\n El proyecto va en un 98% y estamos pendientes de agendar reunion con decanatura. \r\nDesarrollar los puntos 4 y 5 de actividades y descripcion de procesos detallados al orden del dia.', '16', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('71', '6', '0', '16/10/2015 6:00 am', 'Se realiza revision del formato de practica empresarial que corresponde. Semana 13 \r\nRevision: \r\nObservaciones, Ampliar la introduccion y mejorar la redaccion.\r\n Poner cuidado con los espacion y justificaciones del texto. Trabajar en los puntos Actividades 38 y precesos 38 donde quede evidencia del trabajo del texto.\r\n Lunes a las 6:00am entrega de resultados de las puebas de testeo y aportes realizados, y recomendaciones como minimo 13.', '17', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('72', '6', '0', '23/10/2015 6:00 am', 'Se realiza revision del formato. \r\nEl trabajo debe tener:\r\nNorma APA, correccion ortografica, puntos y comas, justificado, fuentes de imagenes, bibliografia y cibergrafia. \r\nDeben trabajar en las recomendaciones y aportes realizados en la elaboracion del trabajo.\r\nSe debe realizar un video con audio de paso a paso donde se evidencie todo el proceso de gestion del administrador hasta llegar al proceso de asesor, tambien evidenciar como se maneja la aplicación desarrollada que mejorara el proceso de la materia de práctica.\r\nTodo este video debera presentarse para el 30/10/2015 a primera hora. \r\n\r\nSe realiza la segunda evaluacion del docente por parte de los estudiantes.', '18', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('73', '6', '1', '30/10/2015 6:00 am', 'Se realiza la tercera visita y se procede a realizar la segunda evaluacion.', '19', '2015-11-04 12:30:00');
INSERT INTO `t_asesoria_practicas` VALUES ('74', '6', '0', '06/11/2015 6:00am', 'Se hace revision del formato final donde debera ingresar las actividades de las ultimas 3 semanas y los procesos detallados. Se debe realizar el trabajo y tener presente los espacios y la respectiva justificacion en cada hoja del trabajo.\r\nCompromisos:\r\n\r\nDebe tener todos los grupos de practica ingresados en el sistema, con el respectivo formato de asesoria, para poder generar los respectivos informes de practica.\r\n\r\nDeberan tener todo el material digitado para el lunes 9 de noviembre para que el cooperador les pueda dar la carta de aceptacion, la cual presentaran para abjuntarla con la carta del asesor, y asi poner entregar el trabajo el dia miercoles.', '20', '2015-11-04 12:30:00');

-- ----------------------------
-- Table structure for t_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_assignment`;
CREATE TABLE `t_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `t_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_auth_assignment
-- ----------------------------
INSERT INTO `t_auth_assignment` VALUES ('agencias', '1');
INSERT INTO `t_auth_assignment` VALUES ('asesores', '1');
INSERT INTO `t_auth_assignment` VALUES ('cooperadores', '1');
INSERT INTO `t_auth_assignment` VALUES ('parámetros', '1');
INSERT INTO `t_auth_assignment` VALUES ('practicantes', '1');
INSERT INTO `t_auth_assignment` VALUES ('proyectos', '1');
INSERT INTO `t_auth_assignment` VALUES ('usuarios', '1');

-- ----------------------------
-- Table structure for t_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_item`;
CREATE TABLE `t_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `t_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `t_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_auth_item
-- ----------------------------
INSERT INTO `t_auth_item` VALUES ('agencias', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('asesores', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('cooperadores', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('parámetros', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('practicantes', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('proyectos', '0', null, null, null);
INSERT INTO `t_auth_item` VALUES ('usuarios', '0', null, null, null);

-- ----------------------------
-- Table structure for t_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_item_child`;
CREATE TABLE `t_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `t_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_auth_item_child
-- ----------------------------

-- ----------------------------
-- Table structure for t_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_rule`;
CREATE TABLE `t_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for t_calificacion_practicantes
-- ----------------------------
DROP TABLE IF EXISTS `t_calificacion_practicantes`;
CREATE TABLE `t_calificacion_practicantes` (
  `ID_CALIFICACION_PRACTICANTE` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PRACTICANTE` bigint(20) DEFAULT NULL,
  `PERSONA` varchar(1) DEFAULT NULL COMMENT 'Calificador',
  `MOMENTO` int(2) DEFAULT NULL,
  `NOTA` varchar(80) DEFAULT NULL,
  `OBS_SABERSER` varchar(255) DEFAULT NULL,
  `OBS_SABERHACER` varchar(255) DEFAULT NULL,
  `OBS_SABERSABER` varchar(255) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_CALIFICACION_PRACTICANTE`),
  KEY `ID_PRACTICANTE` (`ID_PRACTICANTE`),
  CONSTRAINT `t_calificacion_practicantes_ibfk_1` FOREIGN KEY (`ID_PRACTICANTE`) REFERENCES `t_practicantes` (`ID_PRACTICANTE`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_calificacion_practicantes
-- ----------------------------
INSERT INTO `t_calificacion_practicantes` VALUES ('1', '3', 'M', '1', '5,5,5,5,5,5,4,5,4,4,5,5,5,5,5,5,4.7,4.8', '', 'Debe comprometer mejor los plazos con los proveedores para cumplir con los calendarios propuestos desde el principio. 27 oct/15\r\nTodo estaá saliendo muy bien ¡Felicitaciones!\r\nJorge López, por su desempeño e interés en su trabajo y proyectos, por la form', '', '2015-09-07 15:27:54');
INSERT INTO `t_calificacion_practicantes` VALUES ('2', '3', 'M', '2', '5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5', '', '', '', '2015-10-27 15:47:25');
INSERT INTO `t_calificacion_practicantes` VALUES ('3', '1', 'M', '1', '4.6,4.6,4,5,5,5,5,5,5,5,4,4.7,4.6,5,4.6,4.6,4.6,4.6', 'Por el conocimiento de  la organización  del estudiante compila rapidamente la información y adaptandose a la debilidades o dificultades deque se pudieran presentar.', 'Para la presentación de un formulario se recomienda el uso de medios electrónicos para ir conociendo el avance del proyecto.\r\n\r\nSu desempeño ha sido excelente hasta el momento.', 'Por estar al momento inicial, del proyecto aún  no se ha evidenciado avance en las problemáticas que pueden surgir, lo mismo ocurre con labúsqueda de información, la capacidad investigativa, y la síntesis coherente de  los resultados obtenidos.', '2015-09-10 16:50:44');
INSERT INTO `t_calificacion_practicantes` VALUES ('4', '1', 'M', '2', '3.9,4.7,3.9,3.9,3.9,5,3.9,3.9,3.9,3.9,3.9,3.9,3.9,3.9,3.9,3.9,4.5,4.5', '', '', '', '2015-11-04 17:19:53');
INSERT INTO `t_calificacion_practicantes` VALUES ('5', '2', 'A', '1', '4.6,4.6,3.5,4,4.6,4.6,4.6,4,4,4,4,4,4,4.6,4,4,4,4.6', 'Es una persona comprometida que se ha adoptado muy bien al grupo de trabajo, su aporte es muy valeroso en el logro de los objetivos del área.', 'Continúa trabajando con buena disposición, es parte integral del grupo de trabajo que ha conseguido metas importantes.', '', '2015-09-09 17:52:04');
INSERT INTO `t_calificacion_practicantes` VALUES ('6', '2', 'C', '1', '3.9,3.9,3.9,3.5,3.5,3.9,3.5,3.9,3.9,3.5,3.5,3.9,3.9,3.9,3.9,3.9,3.9,3.5', '', '', '', '2015-09-09 17:52:04');
INSERT INTO `t_calificacion_practicantes` VALUES ('7', '2', 'M', '2', '4.5,4.5,4,4.6,4,4.6,4,4,4,4,4,4,4,4,4,4.5,4.5,4.5', '', '', '', '2015-10-27 18:15:12');
INSERT INTO `t_calificacion_practicantes` VALUES ('8', '7', 'M', '1', '3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5', '', '', '', '2015-09-10 15:41:21');
INSERT INTO `t_calificacion_practicantes` VALUES ('9', '7', 'M', '2', '4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2,4.2', '', '', '', '2015-10-30 15:44:57');
INSERT INTO `t_calificacion_practicantes` VALUES ('10', '4', 'M', '1', '3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5', '', '', '', '2015-09-09 15:41:21');
INSERT INTO `t_calificacion_practicantes` VALUES ('11', '4', 'M', '2', '4,5,4,4,4,4.2,4.5,4,4,4.5,4,4.5,4,4,4,4,4,4.5', '', '', '', '2015-10-30 15:55:02');
INSERT INTO `t_calificacion_practicantes` VALUES ('12', '5', 'M', '1', '3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5,3.5', '', '', '', '2015-09-09 15:41:21');
INSERT INTO `t_calificacion_practicantes` VALUES ('13', '5', 'C', '2', '4.5,4.5,3.9,4.5,4.5,4.5,3.9,4.5,3.9,4.5,4.5,4.5,4.5,4,4,4,4,4', '', '', '', '2015-10-30 16:08:08');
INSERT INTO `t_calificacion_practicantes` VALUES ('14', '5', 'A', '2', '3,3,3,3,3,3,3,3.4,3.4,3.4,3.4,3.4,3.4,3,3,3,3,3', '', '', '', '2015-10-30 16:08:08');
INSERT INTO `t_calificacion_practicantes` VALUES ('15', '6', 'M', '1', '4.5,4.5,4.5,4.5,4.5,4.5,4.5,4.5,4.5,4.5,4.5,4.5,5,5,4.8,4.6,4.8,5', '', '', '', '2015-09-09 15:41:21');
INSERT INTO `t_calificacion_practicantes` VALUES ('16', '6', 'M', '2', '5,5,4.6,5,4,5,5,4.6,5,5,4,4.6,4.7,4.6,4.6,4.6,4,5', '', '', '', '2015-10-30 16:08:08');

-- ----------------------------
-- Table structure for t_ciudades
-- ----------------------------
DROP TABLE IF EXISTS `t_ciudades`;
CREATE TABLE `t_ciudades` (
  `ID_CIUDAD` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DEPARTAMENTO` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_CIUDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=1121 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_ciudades
-- ----------------------------
INSERT INTO `t_ciudades` VALUES ('1', 'MEDELLIN', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('2', 'ABEJORRAL', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('3', 'ABRIAQUI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('4', 'ALEJANDRIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('5', 'AMAGA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('6', 'AMALFI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('7', 'ANDES', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('8', 'ANGELOPOLIS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('9', 'ANGOSTURA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('10', 'ANORI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('11', 'SANTAFE DE ANTIOQUIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('12', 'ANZA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('13', 'APARTADO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('14', 'ARBOLETES', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('15', 'ARGELIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('16', 'ARMENIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('17', 'BARBOSA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('18', 'BELMIRA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('19', 'BELLO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('20', 'BETANIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('21', 'BETULIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('22', 'CIUDAD BOLIVAR', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('23', 'BRICE&Ntilde;O', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('24', 'BURITICA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('25', 'CACERES', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('26', 'CAICEDO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('27', 'CALDAS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('28', 'CAMPAMENTO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('29', 'CA&Ntilde;ASGORDAS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('30', 'CARACOLI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('31', 'CARAMANTA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('32', 'CAREPA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('33', 'EL CARMEN DE VIBORAL', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('34', 'CAROLINA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('35', 'CAUCASIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('36', 'CHIGORODO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('37', 'CISNEROS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('38', 'COCORNA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('39', 'CONCEPCION', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('40', 'CONCORDIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('41', 'COPACABANA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('42', 'DABEIBA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('43', 'DON MATIAS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('44', 'EBEJICO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('45', 'EL BAGRE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('46', 'ENTRERRIOS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('47', 'ENVIGADO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('48', 'FREDONIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('49', 'FRONTINO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('50', 'GIRALDO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('51', 'GIRARDOTA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('52', 'GOMEZ PLATA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('53', 'GRANADA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('54', 'GUADALUPE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('55', 'GUARNE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('56', 'GUATAPE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('57', 'HELICONIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('58', 'HISPANIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('59', 'ITAGUI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('60', 'ITUANGO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('61', 'JARDIN', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('62', 'JERICO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('63', 'LA CEJA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('64', 'LA ESTRELLA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('65', 'LA PINTADA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('66', 'LA UNION', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('67', 'LIBORINA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('68', 'MACEO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('69', 'MARINILLA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('70', 'MONTEBELLO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('71', 'MURINDO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('72', 'MUTATA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('73', 'NARI&Ntilde;O', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('74', 'NECOCLI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('75', 'NECHI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('76', 'OLAYA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('77', 'PE�OL', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('78', 'PEQUE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('79', 'PUEBLORRICO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('80', 'PUERTO BERRIO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('81', 'PUERTO NARE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('82', 'PUERTO TRIUNFO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('83', 'REMEDIOS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('84', 'RETIRO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('85', 'RIONEGRO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('86', 'SABANALARGA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('87', 'SABANETA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('88', 'SALGAR', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('89', 'SAN ANDRES DE CUERQUIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('90', 'SAN CARLOS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('91', 'SAN FRANCISCO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('92', 'SAN JERONIMO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('93', 'SAN JOSE DE LA MONTA&Ntilde;A', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('94', 'SAN JUAN DE URABA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('95', 'SAN LUIS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('96', 'SAN PEDRO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('97', 'SAN PEDRO DE URABA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('98', 'SAN RAFAEL', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('99', 'SAN ROQUE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('100', 'SAN VICENTE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('101', 'SANTA BARBARA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('102', 'SANTA ROSA DE OSOS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('103', 'SANTO DOMINGO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('104', 'EL SANTUARIO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('105', 'SEGOVIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('106', 'SONSON', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('107', 'SOPETRAN', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('108', 'TAMESIS', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('109', 'TARAZA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('110', 'TARSO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('111', 'TITIRIBI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('112', 'TOLEDO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('113', 'TURBO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('114', 'URAMITA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('115', 'URRAO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('116', 'VALDIVIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('117', 'VALPARAISO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('118', 'VEGACHI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('119', 'VENECIA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('120', 'VIGIA DEL FUERTE', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('121', 'YALI', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('122', 'YARUMAL', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('123', 'YOLOMBO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('124', 'YONDO', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('125', 'ZARAGOZA', 'ANTIOQUIA');
INSERT INTO `t_ciudades` VALUES ('126', 'BARRANQUILLA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('127', 'BARANOA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('128', 'CAMPO DE LA CRUZ', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('129', 'CANDELARIA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('130', 'GALAPA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('131', 'JUAN DE ACOSTA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('132', 'LURUACO', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('133', 'MALAMBO', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('134', 'MANATI', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('135', 'PALMAR DE VARELA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('136', 'PIOJO', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('137', 'POLONUEVO', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('138', 'PONEDERA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('139', 'PUERTO COLOMBIA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('140', 'REPELON', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('141', 'SABANAGRANDE', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('142', 'SABANALARGA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('143', 'SANTA LUCIA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('144', 'SANTO TOMAS', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('145', 'SOLEDAD', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('146', 'SUAN', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('147', 'TUBARA', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('148', 'USIACURI', 'ATLANTICO');
INSERT INTO `t_ciudades` VALUES ('149', 'BOGOTA, D.C.', 'BOGOTA');
INSERT INTO `t_ciudades` VALUES ('150', 'CARTAGENA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('151', 'ACHI', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('152', 'ALTOS DEL ROSARIO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('153', 'ARENAL', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('154', 'ARJONA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('155', 'ARROYOHONDO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('156', 'BARRANCO DE LOBA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('157', 'CALAMAR', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('158', 'CANTAGALLO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('159', 'CICUCO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('160', 'CORDOBA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('161', 'CLEMENCIA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('162', 'EL CARMEN DE BOLIVAR', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('163', 'EL GUAMO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('164', 'EL PE&Ntilde;ON', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('165', 'HATILLO DE LOBA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('166', 'MAGANGUE', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('167', 'MAHATES', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('168', 'MARGARITA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('169', 'MARIA LA BAJA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('170', 'MONTECRISTO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('171', 'MOMPOS', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('172', 'NOROSI', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('173', 'MORALES', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('174', 'PINILLOS', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('175', 'REGIDOR', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('176', 'RIO VIEJO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('177', 'SAN CRISTOBAL', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('178', 'SAN ESTANISLAO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('179', 'SAN FERNANDO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('180', 'SAN JACINTO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('181', 'SAN JACINTO DEL CAUCA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('182', 'SAN JUAN NEPOMUCENO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('183', 'SAN MARTIN DE LOBA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('184', 'SAN PABLO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('185', 'SANTA CATALINA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('186', 'SANTA ROSA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('187', 'SANTA ROSA DEL SUR', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('188', 'SIMITI', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('189', 'SOPLAVIENTO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('190', 'TALAIGUA NUEVO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('191', 'TIQUISIO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('192', 'TURBACO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('193', 'TURBANA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('194', 'VILLANUEVA', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('195', 'ZAMBRANO', 'BOLIVAR');
INSERT INTO `t_ciudades` VALUES ('196', 'TUNJA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('197', 'ALMEIDA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('198', 'AQUITANIA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('199', 'ARCABUCO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('200', 'BELEN', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('201', 'BERBEO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('202', 'BETEITIVA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('203', 'BOAVITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('204', 'BOYACA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('205', 'BRICE&Ntilde;O', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('206', 'BUENAVISTA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('207', 'BUSBANZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('208', 'CALDAS', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('209', 'CAMPOHERMOSO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('210', 'CERINZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('211', 'CHINAVITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('212', 'CHIQUINQUIRA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('213', 'CHISCAS', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('214', 'CHITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('215', 'CHITARAQUE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('216', 'CHIVATA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('217', 'CIENEGA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('218', 'COMBITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('219', 'COPER', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('220', 'CORRALES', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('221', 'COVARACHIA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('222', 'CUBARA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('223', 'CUCAITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('224', 'CUITIVA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('225', 'CHIQUIZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('226', 'CHIVOR', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('227', 'DUITAMA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('228', 'EL COCUY', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('229', 'EL ESPINO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('230', 'FIRAVITOBA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('231', 'FLORESTA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('232', 'GACHANTIVA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('233', 'GAMEZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('234', 'GARAGOA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('235', 'GUACAMAYAS', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('236', 'GUATEQUE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('237', 'GUAYATA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('238', 'GsICAN', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('239', 'IZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('240', 'JENESANO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('241', 'JERICO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('242', 'LABRANZAGRANDE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('243', 'LA CAPILLA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('244', 'LA VICTORIA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('245', 'LA UVITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('246', 'VILLA DE LEYVA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('247', 'MACANAL', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('248', 'MARIPI', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('249', 'MIRAFLORES', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('250', 'MONGUA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('251', 'MONGUI', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('252', 'MONIQUIRA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('253', 'MOTAVITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('254', 'MUZO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('255', 'NOBSA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('256', 'NUEVO COLON', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('257', 'OICATA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('258', 'OTANCHE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('259', 'PACHAVITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('260', 'PAEZ', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('261', 'PAIPA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('262', 'PAJARITO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('263', 'PANQUEBA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('264', 'PAUNA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('265', 'PAYA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('266', 'PAZ DE RIO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('267', 'PESCA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('268', 'PISBA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('269', 'PUERTO BOYACA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('270', 'QUIPAMA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('271', 'RAMIRIQUI', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('272', 'RAQUIRA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('273', 'RONDON', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('274', 'SABOYA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('275', 'SACHICA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('276', 'SAMACA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('277', 'SAN EDUARDO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('278', 'SAN JOSE DE PARE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('279', 'SAN LUIS DE GACENO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('280', 'SAN MATEO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('281', 'SAN MIGUEL DE SEMA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('282', 'SAN PABLO DE BORBUR', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('283', 'SANTANA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('284', 'SANTA MARIA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('285', 'SANTA ROSA DE VITERBO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('286', 'SANTA SOFIA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('287', 'SATIVANORTE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('288', 'SATIVASUR', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('289', 'SIACHOQUE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('290', 'SOATA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('291', 'SOCOTA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('292', 'SOCHA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('293', 'SOGAMOSO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('294', 'SOMONDOCO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('295', 'SORA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('296', 'SOTAQUIRA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('297', 'SORACA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('298', 'SUSACON', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('299', 'SUTAMARCHAN', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('300', 'SUTATENZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('301', 'TASCO', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('302', 'TENZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('303', 'TIBANA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('304', 'TIBASOSA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('305', 'TINJACA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('306', 'TIPACOQUE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('307', 'TOCA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('308', 'TOGsI', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('309', 'TOPAGA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('310', 'TOTA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('311', 'TUNUNGUA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('312', 'TURMEQUE', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('313', 'TUTA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('314', 'TUTAZA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('315', 'UMBITA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('316', 'VENTAQUEMADA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('317', 'VIRACACHA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('318', 'ZETAQUIRA', 'BOYACA');
INSERT INTO `t_ciudades` VALUES ('319', 'MANIZALES', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('320', 'AGUADAS', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('321', 'ANSERMA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('322', 'ARANZAZU', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('323', 'BELALCAZAR', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('324', 'CHINCHINA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('325', 'FILADELFIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('326', 'LA DORADA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('327', 'LA MERCED', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('328', 'MANZANARES', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('329', 'MARMATO', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('330', 'MARQUETALIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('331', 'MARULANDA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('332', 'NEIRA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('333', 'NORCASIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('334', 'PACORA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('335', 'PALESTINA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('336', 'PENSILVANIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('337', 'RIOSUCIO', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('338', 'RISARALDA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('339', 'SALAMINA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('340', 'SAMANA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('341', 'SAN JOSE', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('342', 'SUPIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('343', 'VICTORIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('344', 'VILLAMARIA', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('345', 'VITERBO', 'CALDAS');
INSERT INTO `t_ciudades` VALUES ('346', 'FLORENCIA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('347', 'ALBANIA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('348', 'BELEN DE LOS ANDAQUIES', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('349', 'CARTAGENA DEL CHAIRA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('350', 'CURILLO', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('351', 'EL DONCELLO', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('352', 'EL PAUJIL', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('353', 'LA MONTA&Ntilde;ITA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('354', 'MILAN', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('355', 'MORELIA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('356', 'PUERTO RICO', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('357', 'SAN JOSE DEL FRAGUA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('358', 'SAN VICENTE DEL CAGUAN', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('359', 'SOLANO', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('360', 'SOLITA', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('361', 'VALPARAISO', 'CAQUETA');
INSERT INTO `t_ciudades` VALUES ('362', 'POPAYAN', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('363', 'ALMAGUER', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('364', 'ARGELIA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('365', 'BALBOA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('366', 'BOLIVAR', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('367', 'BUENOS AIRES', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('368', 'CAJIBIO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('369', 'CALDONO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('370', 'CALOTO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('371', 'CORINTO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('372', 'EL TAMBO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('373', 'FLORENCIA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('374', 'GUACHENE', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('375', 'GUAPI', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('376', 'INZA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('377', 'JAMBALO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('378', 'LA SIERRA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('379', 'LA VEGA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('380', 'LOPEZ', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('381', 'MERCADERES', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('382', 'MIRANDA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('383', 'MORALES', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('384', 'PADILLA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('385', 'PAEZ', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('386', 'PATIA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('387', 'PIAMONTE', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('388', 'PIENDAMO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('389', 'PUERTO TEJADA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('390', 'PURACE', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('391', 'ROSAS', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('392', 'SAN SEBASTIAN', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('393', 'SANTANDER DE QUILICHAO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('394', 'SANTA ROSA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('395', 'SILVIA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('396', 'SOTARA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('397', 'SUAREZ', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('398', 'SUCRE', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('399', 'TIMBIO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('400', 'TIMBIQUI', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('401', 'TORIBIO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('402', 'TOTORO', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('403', 'VILLA RICA', 'CAUCA');
INSERT INTO `t_ciudades` VALUES ('404', 'VALLEDUPAR', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('405', 'AGUACHICA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('406', 'AGUSTIN CODAZZI', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('407', 'ASTREA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('408', 'BECERRIL', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('409', 'BOSCONIA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('410', 'CHIMICHAGUA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('411', 'CHIRIGUANA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('412', 'CURUMANI', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('413', 'EL COPEY', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('414', 'EL PASO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('415', 'GAMARRA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('416', 'GONZALEZ', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('417', 'LA GLORIA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('418', 'LA JAGUA DE IBIRICO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('419', 'MANAURE', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('420', 'PAILITAS', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('421', 'PELAYA', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('422', 'PUEBLO BELLO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('423', 'RIO DE ORO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('424', 'LA PAZ', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('425', 'SAN ALBERTO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('426', 'SAN DIEGO', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('427', 'SAN MARTIN', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('428', 'TAMALAMEQUE', 'CESAR');
INSERT INTO `t_ciudades` VALUES ('429', 'MONTERIA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('430', 'AYAPEL', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('431', 'BUENAVISTA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('432', 'CANALETE', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('433', 'CERETE', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('434', 'CHIMA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('435', 'CHINU', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('436', 'CIENAGA DE ORO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('437', 'COTORRA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('438', 'LA APARTADA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('439', 'LORICA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('440', 'LOS CORDOBAS', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('441', 'MOMIL', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('442', 'MONTELIBANO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('443', 'MO&Ntilde;ITOS', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('444', 'PLANETA RICA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('445', 'PUEBLO NUEVO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('446', 'PUERTO ESCONDIDO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('447', 'PUERTO LIBERTADOR', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('448', 'PURISIMA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('449', 'SAHAGUN', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('450', 'SAN ANDRES SOTAVENTO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('451', 'SAN ANTERO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('452', 'SAN BERNARDO DEL VIENTO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('453', 'SAN CARLOS', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('454', 'SAN PELAYO', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('455', 'TIERRALTA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('456', 'VALENCIA', 'CORDOBA');
INSERT INTO `t_ciudades` VALUES ('457', 'AGUA DE DIOS', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('458', 'ALBAN', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('459', 'ANAPOIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('460', 'ANOLAIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('461', 'ARBELAEZ', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('462', 'BELTRAN', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('463', 'BITUIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('464', 'BOJACA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('465', 'CABRERA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('466', 'CACHIPAY', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('467', 'CAJICA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('468', 'CAPARRAPI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('469', 'CAQUEZA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('470', 'CARMEN DE CARUPA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('471', 'CHAGUANI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('472', 'CHIA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('473', 'CHIPAQUE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('474', 'CHOACHI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('475', 'CHOCONTA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('476', 'COGUA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('477', 'COTA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('478', 'CUCUNUBA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('479', 'EL COLEGIO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('480', 'EL PE&Ntilde;ON', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('481', 'EL ROSAL', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('482', 'FACATATIVA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('483', 'FOMEQUE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('484', 'FOSCA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('485', 'FUNZA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('486', 'FUQUENE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('487', 'FUSAGASUGA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('488', 'GACHALA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('489', 'GACHANCIPA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('490', 'GACHETA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('491', 'GAMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('492', 'GIRARDOT', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('493', 'GRANADA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('494', 'GUACHETA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('495', 'GUADUAS', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('496', 'GUASCA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('497', 'GUATAQUI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('498', 'GUATAVITA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('499', 'GUAYABAL DE SIQUIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('500', 'GUAYABETAL', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('501', 'GUTIERREZ', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('502', 'JERUSALEN', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('503', 'JUNIN', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('504', 'LA CALERA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('505', 'LA MESA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('506', 'LA PALMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('507', 'LA PE&Ntilde;A', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('508', 'LA VEGA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('509', 'LENGUAZAQUE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('510', 'MACHETA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('511', 'MADRID', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('512', 'MANTA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('513', 'MEDINA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('514', 'MOSQUERA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('515', 'NARI&Ntilde;O', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('516', 'NEMOCON', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('517', 'NILO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('518', 'NIMAIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('519', 'NOCAIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('520', 'VENECIA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('521', 'PACHO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('522', 'PAIME', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('523', 'PANDI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('524', 'PARATEBUENO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('525', 'PASCA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('526', 'PUERTO SALGAR', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('527', 'PULI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('528', 'QUEBRADANEGRA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('529', 'QUETAME', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('530', 'QUIPILE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('531', 'APULO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('532', 'RICAURTE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('533', 'SAN ANTONIO DEL TEQUENDAMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('534', 'SAN BERNARDO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('535', 'SAN CAYETANO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('536', 'SAN FRANCISCO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('537', 'SAN JUAN DE RIO SECO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('538', 'SASAIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('539', 'SESQUILE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('540', 'SIBATE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('541', 'SILVANIA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('542', 'SIMIJACA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('543', 'SOACHA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('544', 'SOPO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('545', 'SUBACHOQUE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('546', 'SUESCA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('547', 'SUPATA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('548', 'SUSA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('549', 'SUTATAUSA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('550', 'TABIO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('551', 'TAUSA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('552', 'TENA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('553', 'TENJO', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('554', 'TIBACUY', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('555', 'TIBIRITA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('556', 'TOCAIMA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('557', 'TOCANCIPA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('558', 'TOPAIPI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('559', 'UBALA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('560', 'UBAQUE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('561', 'VILLA DE SAN DIEGO DE UBATE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('562', 'UNE', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('563', 'UTICA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('564', 'VERGARA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('565', 'VIANI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('566', 'VILLAGOMEZ', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('567', 'VILLAPINZON', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('568', 'VILLETA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('569', 'VIOTA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('570', 'YACOPI', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('571', 'ZIPACON', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('572', 'ZIPAQUIRA', 'CUNDINAMARCA');
INSERT INTO `t_ciudades` VALUES ('573', 'QUIBDO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('574', 'ACANDI', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('575', 'ALTO BAUDO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('576', 'ATRATO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('577', 'BAGADO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('578', 'BAHIA SOLANO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('579', 'BAJO BAUDO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('580', 'BOJAYA', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('581', 'EL CANTON DEL SAN PABLO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('582', 'CARMEN DEL DARIEN', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('583', 'CERTEGUI', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('584', 'CONDOTO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('585', 'EL CARMEN DE ATRATO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('586', 'EL LITORAL DEL SAN JUAN', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('587', 'ISTMINA', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('588', 'JURADO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('589', 'LLORO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('590', 'MEDIO ATRATO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('591', 'MEDIO BAUDO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('592', 'MEDIO SAN JUAN', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('593', 'NOVITA', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('594', 'NUQUI', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('595', 'RIO IRO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('596', 'RIO QUITO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('597', 'RIOSUCIO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('598', 'SAN JOSE DEL PALMAR', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('599', 'SIPI', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('600', 'TADO', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('601', 'UNGUIA', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('602', 'UNION PANAMERICANA', 'CHOCO');
INSERT INTO `t_ciudades` VALUES ('603', 'NEIVA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('604', 'ACEVEDO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('605', 'AGRADO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('606', 'AIPE', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('607', 'ALGECIRAS', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('608', 'ALTAMIRA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('609', 'BARAYA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('610', 'CAMPOALEGRE', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('611', 'COLOMBIA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('612', 'ELIAS', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('613', 'GARZON', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('614', 'GIGANTE', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('615', 'GUADALUPE', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('616', 'HOBO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('617', 'IQUIRA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('618', 'ISNOS', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('619', 'LA ARGENTINA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('620', 'LA PLATA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('621', 'NATAGA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('622', 'OPORAPA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('623', 'PAICOL', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('624', 'PALERMO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('625', 'PALESTINA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('626', 'PITAL', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('627', 'PITALITO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('628', 'RIVERA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('629', 'SALADOBLANCO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('630', 'SAN AGUSTIN', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('631', 'SANTA MARIA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('632', 'SUAZA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('633', 'TARQUI', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('634', 'TESALIA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('635', 'TELLO', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('636', 'TERUEL', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('637', 'TIMANA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('638', 'VILLAVIEJA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('639', 'YAGUARA', 'HUILA');
INSERT INTO `t_ciudades` VALUES ('640', 'RIOHACHA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('641', 'ALBANIA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('642', 'BARRANCAS', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('643', 'DIBULLA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('644', 'DISTRACCION', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('645', 'EL MOLINO', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('646', 'FONSECA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('647', 'HATONUEVO', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('648', 'LA JAGUA DEL PILAR', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('649', 'MAICAO', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('650', 'MANAURE', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('651', 'SAN JUAN DEL CESAR', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('652', 'URIBIA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('653', 'URUMITA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('654', 'VILLANUEVA', 'LA GUAJIRA');
INSERT INTO `t_ciudades` VALUES ('655', 'SANTA MARTA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('656', 'ALGARROBO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('657', 'ARACATACA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('658', 'ARIGUANI', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('659', 'CERRO SAN ANTONIO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('660', 'CHIBOLO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('661', 'CIENAGA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('662', 'CONCORDIA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('663', 'EL BANCO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('664', 'EL PI&Ntilde;ON', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('665', 'EL RETEN', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('666', 'FUNDACION', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('667', 'GUAMAL', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('668', 'NUEVA GRANADA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('669', 'PEDRAZA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('670', 'PIJI&Ntilde;O DEL CARMEN', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('671', 'PIVIJAY', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('672', 'PLATO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('673', 'PUEBLOVIEJO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('674', 'REMOLINO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('675', 'SABANAS DE SAN ANGEL', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('676', 'SALAMINA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('677', 'SAN SEBASTIAN DE BUENAVISTA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('678', 'SAN ZENON', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('679', 'SANTA ANA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('680', 'SANTA BARBARA DE PINTO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('681', 'SITIONUEVO', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('682', 'TENERIFE', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('683', 'ZAPAYAN', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('684', 'ZONA BANANERA', 'MAGDALENA');
INSERT INTO `t_ciudades` VALUES ('685', 'VILLAVICENCIO', 'META');
INSERT INTO `t_ciudades` VALUES ('686', 'ACACIAS', 'META');
INSERT INTO `t_ciudades` VALUES ('687', 'BARRANCA DE UPIA', 'META');
INSERT INTO `t_ciudades` VALUES ('688', 'CABUYARO', 'META');
INSERT INTO `t_ciudades` VALUES ('689', 'CASTILLA LA NUEVA', 'META');
INSERT INTO `t_ciudades` VALUES ('690', 'CUBARRAL', 'META');
INSERT INTO `t_ciudades` VALUES ('691', 'CUMARAL', 'META');
INSERT INTO `t_ciudades` VALUES ('692', 'EL CALVARIO', 'META');
INSERT INTO `t_ciudades` VALUES ('693', 'EL CASTILLO', 'META');
INSERT INTO `t_ciudades` VALUES ('694', 'EL DORADO', 'META');
INSERT INTO `t_ciudades` VALUES ('695', 'FUENTE DE ORO', 'META');
INSERT INTO `t_ciudades` VALUES ('696', 'GRANADA', 'META');
INSERT INTO `t_ciudades` VALUES ('697', 'GUAMAL', 'META');
INSERT INTO `t_ciudades` VALUES ('698', 'MAPIRIPAN', 'META');
INSERT INTO `t_ciudades` VALUES ('699', 'MESETAS', 'META');
INSERT INTO `t_ciudades` VALUES ('700', 'LA MACARENA', 'META');
INSERT INTO `t_ciudades` VALUES ('701', 'URIBE', 'META');
INSERT INTO `t_ciudades` VALUES ('702', 'LEJANIAS', 'META');
INSERT INTO `t_ciudades` VALUES ('703', 'PUERTO CONCORDIA', 'META');
INSERT INTO `t_ciudades` VALUES ('704', 'PUERTO GAITAN', 'META');
INSERT INTO `t_ciudades` VALUES ('705', 'PUERTO LOPEZ', 'META');
INSERT INTO `t_ciudades` VALUES ('706', 'PUERTO LLERAS', 'META');
INSERT INTO `t_ciudades` VALUES ('707', 'PUERTO RICO', 'META');
INSERT INTO `t_ciudades` VALUES ('708', 'RESTREPO', 'META');
INSERT INTO `t_ciudades` VALUES ('709', 'SAN CARLOS DE GUAROA', 'META');
INSERT INTO `t_ciudades` VALUES ('710', 'SAN JUAN DE ARAMA', 'META');
INSERT INTO `t_ciudades` VALUES ('711', 'SAN JUANITO', 'META');
INSERT INTO `t_ciudades` VALUES ('712', 'SAN MARTIN', 'META');
INSERT INTO `t_ciudades` VALUES ('713', 'VISTAHERMOSA', 'META');
INSERT INTO `t_ciudades` VALUES ('714', 'PASTO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('715', 'ALBAN', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('716', 'ALDANA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('717', 'ANCUYA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('718', 'ARBOLEDA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('719', 'BARBACOAS', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('720', 'BELEN', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('721', 'BUESACO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('722', 'COLON', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('723', 'CONSACA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('724', 'CONTADERO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('725', 'CORDOBA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('726', 'CUASPUD', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('727', 'CUMBAL', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('728', 'CUMBITARA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('729', 'CHACHAGsI', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('730', 'EL CHARCO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('731', 'EL PE&Ntilde;OL', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('732', 'EL ROSARIO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('733', 'EL TABLON DE GOMEZ', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('734', 'EL TAMBO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('735', 'FUNES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('736', 'GUACHUCAL', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('737', 'GUAITARILLA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('738', 'GUALMATAN', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('739', 'ILES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('740', 'IMUES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('741', 'IPIALES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('742', 'LA CRUZ', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('743', 'LA FLORIDA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('744', 'LA LLANADA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('745', 'LA TOLA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('746', 'LA UNION', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('747', 'LEIVA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('748', 'LINARES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('749', 'LOS ANDES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('750', 'MAGsI', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('751', 'MALLAMA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('752', 'MOSQUERA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('753', 'NARI&Ntilde;O', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('754', 'OLAYA HERRERA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('755', 'OSPINA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('756', 'FRANCISCO PIZARRO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('757', 'POLICARPA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('758', 'POTOSI', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('759', 'PROVIDENCIA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('760', 'PUERRES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('761', 'PUPIALES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('762', 'RICAURTE', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('763', 'ROBERTO PAYAN', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('764', 'SAMANIEGO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('765', 'SANDONA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('766', 'SAN BERNARDO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('767', 'SAN LORENZO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('768', 'SAN PABLO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('769', 'SAN PEDRO DE CARTAGO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('770', 'SANTA BARBARA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('771', 'SANTACRUZ', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('772', 'SAPUYES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('773', 'TAMINANGO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('774', 'TANGUA', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('775', 'SAN ANDRES DE TUMACO', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('776', 'TUQUERRES', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('777', 'YACUANQUER', 'NARI&Ntilde;O');
INSERT INTO `t_ciudades` VALUES ('778', 'CUCUTA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('779', 'ABREGO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('780', 'ARBOLEDAS', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('781', 'BOCHALEMA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('782', 'BUCARASICA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('783', 'CACOTA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('784', 'CACHIRA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('785', 'CHINACOTA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('786', 'CHITAGA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('787', 'CONVENCION', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('788', 'CUCUTILLA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('789', 'DURANIA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('790', 'EL CARMEN', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('791', 'EL TARRA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('792', 'EL ZULIA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('793', 'GRAMALOTE', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('794', 'HACARI', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('795', 'HERRAN', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('796', 'LABATECA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('797', 'LA ESPERANZA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('798', 'LA PLAYA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('799', 'LOS PATIOS', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('800', 'LOURDES', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('801', 'MUTISCUA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('802', 'OCA&Ntilde;A', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('803', 'PAMPLONA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('804', 'PAMPLONITA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('805', 'PUERTO SANTANDER', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('806', 'RAGONVALIA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('807', 'SALAZAR', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('808', 'SAN CALIXTO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('809', 'SAN CAYETANO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('810', 'SANTIAGO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('811', 'SARDINATA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('812', 'SILOS', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('813', 'TEORAMA', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('814', 'TIBU', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('815', 'TOLEDO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('816', 'VILLA CARO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('817', 'VILLA DEL ROSARIO', 'N. DE SANTANDER');
INSERT INTO `t_ciudades` VALUES ('818', 'ARMENIA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('819', 'BUENAVISTA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('820', 'CALARCA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('821', 'CIRCASIA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('822', 'CORDOBA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('823', 'FILANDIA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('824', 'GENOVA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('825', 'LA TEBAIDA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('826', 'MONTENEGRO', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('827', 'PIJAO', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('828', 'QUIMBAYA', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('829', 'SALENTO', 'QUINDIO');
INSERT INTO `t_ciudades` VALUES ('830', 'PEREIRA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('831', 'APIA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('832', 'BALBOA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('833', 'BELEN DE UMBRIA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('834', 'DOSQUEBRADAS', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('835', 'GUATICA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('836', 'LA CELIA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('837', 'LA VIRGINIA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('838', 'MARSELLA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('839', 'MISTRATO', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('840', 'PUEBLO RICO', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('841', 'QUINCHIA', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('842', 'SANTA ROSA DE CABAL', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('843', 'SANTUARIO', 'RISARALDA');
INSERT INTO `t_ciudades` VALUES ('844', 'BUCARAMANGA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('845', 'AGUADA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('846', 'ALBANIA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('847', 'ARATOCA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('848', 'BARBOSA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('849', 'BARICHARA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('850', 'BARRANCABERMEJA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('851', 'BETULIA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('852', 'BOLIVAR', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('853', 'CABRERA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('854', 'CALIFORNIA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('855', 'CAPITANEJO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('856', 'CARCASI', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('857', 'CEPITA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('858', 'CERRITO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('859', 'CHARALA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('860', 'CHARTA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('861', 'CHIMA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('862', 'CHIPATA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('863', 'CIMITARRA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('864', 'CONCEPCION', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('865', 'CONFINES', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('866', 'CONTRATACION', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('867', 'COROMORO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('868', 'CURITI', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('869', 'EL CARMEN DE CHUCURI', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('870', 'EL GUACAMAYO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('871', 'EL PE&Ntilde;ON', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('872', 'EL PLAYON', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('873', 'ENCINO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('874', 'ENCISO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('875', 'FLORIAN', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('876', 'FLORIDABLANCA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('877', 'GALAN', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('878', 'GAMBITA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('879', 'GIRON', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('880', 'GUACA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('881', 'GUADALUPE', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('882', 'GUAPOTA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('883', 'GUAVATA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('884', 'GsEPSA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('885', 'HATO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('886', 'JESUS MARIA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('887', 'JORDAN', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('888', 'LA BELLEZA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('889', 'LANDAZURI', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('890', 'LA PAZ', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('891', 'LEBRIJA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('892', 'LOS SANTOS', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('893', 'MACARAVITA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('894', 'MALAGA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('895', 'MATANZA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('896', 'MOGOTES', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('897', 'MOLAGAVITA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('898', 'OCAMONTE', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('899', 'OIBA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('900', 'ONZAGA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('901', 'PALMAR', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('902', 'PALMAS DEL SOCORRO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('903', 'PARAMO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('904', 'PIEDECUESTA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('905', 'PINCHOTE', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('906', 'PUENTE NACIONAL', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('907', 'PUERTO PARRA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('908', 'PUERTO WILCHES', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('909', 'RIONEGRO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('910', 'SABANA DE TORRES', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('911', 'SAN ANDRES', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('912', 'SAN BENITO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('913', 'SAN GIL', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('914', 'SAN JOAQUIN', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('915', 'SAN JOSE DE MIRANDA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('916', 'SAN MIGUEL', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('917', 'SAN VICENTE DE CHUCURI', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('918', 'SANTA BARBARA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('919', 'SANTA HELENA DEL OPON', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('920', 'SIMACOTA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('921', 'SOCORRO', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('922', 'SUAITA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('923', 'SUCRE', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('924', 'SURATA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('925', 'TONA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('926', 'VALLE DE SAN JOSE', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('927', 'VELEZ', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('928', 'VETAS', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('929', 'VILLANUEVA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('930', 'ZAPATOCA', 'SANTANDER');
INSERT INTO `t_ciudades` VALUES ('931', 'SINCELEJO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('932', 'BUENAVISTA', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('933', 'CAIMITO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('934', 'COLOSO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('935', 'COROZAL', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('936', 'COVE&Ntilde;AS', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('937', 'CHALAN', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('938', 'EL ROBLE', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('939', 'GALERAS', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('940', 'GUARANDA', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('941', 'LA UNION', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('942', 'LOS PALMITOS', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('943', 'MAJAGUAL', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('944', 'MORROA', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('945', 'OVEJAS', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('946', 'PALMITO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('947', 'SAMPUES', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('948', 'SAN BENITO ABAD', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('949', 'SAN JUAN DE BETULIA', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('950', 'SAN MARCOS', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('951', 'SAN ONOFRE', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('952', 'SAN PEDRO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('953', 'SAN LUIS DE SINCE', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('954', 'SUCRE', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('955', 'SANTIAGO DE TOLU', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('956', 'TOLU VIEJO', 'SUCRE');
INSERT INTO `t_ciudades` VALUES ('957', 'IBAGUE', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('958', 'ALPUJARRA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('959', 'ALVARADO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('960', 'AMBALEMA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('961', 'ANZOATEGUI', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('962', 'ARMERO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('963', 'ATACO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('964', 'CAJAMARCA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('965', 'CARMEN DE APICALA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('966', 'CASABIANCA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('967', 'CHAPARRAL', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('968', 'COELLO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('969', 'COYAIMA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('970', 'CUNDAY', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('971', 'DOLORES', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('972', 'ESPINAL', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('973', 'FALAN', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('974', 'FLANDES', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('975', 'FRESNO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('976', 'GUAMO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('977', 'HERVEO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('978', 'HONDA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('979', 'ICONONZO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('980', 'LERIDA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('981', 'LIBANO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('982', 'MARIQUITA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('983', 'MELGAR', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('984', 'MURILLO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('985', 'NATAGAIMA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('986', 'ORTEGA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('987', 'PALOCABILDO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('988', 'PIEDRAS', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('989', 'PLANADAS', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('990', 'PRADO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('991', 'PURIFICACION', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('992', 'RIOBLANCO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('993', 'RONCESVALLES', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('994', 'ROVIRA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('995', 'SALDA&Ntilde;A', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('996', 'SAN ANTONIO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('997', 'SAN LUIS', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('998', 'SANTA ISABEL', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('999', 'SUAREZ', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('1000', 'VALLE DE SAN JUAN', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('1001', 'VENADILLO', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('1002', 'VILLAHERMOSA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('1003', 'VILLARRICA', 'TOLIMA');
INSERT INTO `t_ciudades` VALUES ('1004', 'CALI', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1005', 'ALCALA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1006', 'ANDALUCIA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1007', 'ANSERMANUEVO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1008', 'ARGELIA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1009', 'BOLIVAR', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1010', 'BUENAVENTURA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1011', 'GUADALAJARA DE BUGA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1012', 'BUGALAGRANDE', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1013', 'CAICEDONIA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1014', 'CALIMA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1015', 'CANDELARIA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1016', 'CARTAGO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1017', 'DAGUA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1018', 'EL AGUILA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1019', 'EL CAIRO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1020', 'EL CERRITO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1021', 'EL DOVIO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1022', 'FLORIDA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1023', 'GINEBRA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1024', 'GUACARI', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1025', 'JAMUNDI', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1026', 'LA CUMBRE', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1027', 'LA UNION', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1028', 'LA VICTORIA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1029', 'OBANDO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1030', 'PALMIRA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1031', 'PRADERA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1032', 'RESTREPO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1033', 'RIOFRIO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1034', 'ROLDANILLO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1035', 'SAN PEDRO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1036', 'SEVILLA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1037', 'TORO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1038', 'TRUJILLO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1039', 'TULUA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1040', 'ULLOA', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1041', 'VERSALLES', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1042', 'VIJES', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1043', 'YOTOCO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1044', 'YUMBO', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1045', 'ZARZAL', 'VALLE DEL CAUCA');
INSERT INTO `t_ciudades` VALUES ('1046', 'ARAUCA', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1047', 'ARAUQUITA', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1048', 'CRAVO NORTE', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1049', 'FORTUL', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1050', 'PUERTO RONDON', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1051', 'SARAVENA', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1052', 'TAME', 'ARAUCA');
INSERT INTO `t_ciudades` VALUES ('1053', 'YOPAL', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1054', 'AGUAZUL', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1055', 'CHAMEZA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1056', 'HATO COROZAL', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1057', 'LA SALINA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1058', 'MANI', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1059', 'MONTERREY', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1060', 'NUNCHIA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1061', 'OROCUE', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1062', 'PAZ DE ARIPORO', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1063', 'PORE', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1064', 'RECETOR', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1065', 'SABANALARGA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1066', 'SACAMA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1067', 'SAN LUIS DE PALENQUE', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1068', 'TAMARA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1069', 'TAURAMENA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1070', 'TRINIDAD', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1071', 'VILLANUEVA', 'CASANARE');
INSERT INTO `t_ciudades` VALUES ('1072', 'MOCOA', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1073', 'COLON', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1074', 'ORITO', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1075', 'PUERTO ASIS', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1076', 'PUERTO CAICEDO', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1077', 'PUERTO GUZMAN', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1078', 'LEGUIZAMO', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1079', 'SIBUNDOY', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1080', 'SAN FRANCISCO', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1081', 'SAN MIGUEL', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1082', 'SANTIAGO', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1083', 'VALLE DEL GUAMUEZ', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1084', 'VILLAGARZON', 'PUTUMAYO');
INSERT INTO `t_ciudades` VALUES ('1085', 'SAN ANDRES', 'SAN ANDRES');
INSERT INTO `t_ciudades` VALUES ('1086', 'PROVIDENCIA', 'SAN ANDRES');
INSERT INTO `t_ciudades` VALUES ('1087', 'LETICIA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1088', 'EL ENCANTO', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1089', 'LA CHORRERA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1090', 'LA PEDRERA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1091', 'LA VICTORIA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1092', 'MIRITI - PARANA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1093', 'PUERTO ALEGRIA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1094', 'PUERTO ARICA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1095', 'PUERTO NARI&Ntilde;O', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1096', 'PUERTO SANTANDER', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1097', 'TARAPACA', 'AMAZONAS');
INSERT INTO `t_ciudades` VALUES ('1098', 'INIRIDA', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1099', 'BARRANCO MINAS', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1100', 'MAPIRIPANA', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1101', 'SAN FELIPE', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1102', 'PUERTO COLOMBIA', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1103', 'LA GUADALUPE', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1104', 'CACAHUAL', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1105', 'PANA PANA', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1106', 'MORICHAL', 'GUAINIA');
INSERT INTO `t_ciudades` VALUES ('1107', 'SAN JOSE DEL GUAVIARE', 'GUAVIARE');
INSERT INTO `t_ciudades` VALUES ('1108', 'CALAMAR', 'GUAVIARE');
INSERT INTO `t_ciudades` VALUES ('1109', 'EL RETORNO', 'GUAVIARE');
INSERT INTO `t_ciudades` VALUES ('1110', 'MIRAFLORES', 'GUAVIARE');
INSERT INTO `t_ciudades` VALUES ('1111', 'MITU', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1112', 'CARURU', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1113', 'PACOA', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1114', 'TARAIRA', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1115', 'PAPUNAUA', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1116', 'YAVARATE', 'VAUPES');
INSERT INTO `t_ciudades` VALUES ('1117', 'PUERTO CARRE&Ntilde;O', 'VICHADA');
INSERT INTO `t_ciudades` VALUES ('1118', 'LA PRIMAVERA', 'VICHADA');
INSERT INTO `t_ciudades` VALUES ('1119', 'SANTA ROSALIA', 'VICHADA');
INSERT INTO `t_ciudades` VALUES ('1120', 'CUMARIBO', 'VICHADA');

-- ----------------------------
-- Table structure for t_comentarios
-- ----------------------------
DROP TABLE IF EXISTS `t_comentarios`;
CREATE TABLE `t_comentarios` (
  `ID_COMENTARIO` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_NOTICIA` bigint(20) DEFAULT NULL,
  `ID_USUARIO` bigint(20) DEFAULT NULL,
  `COMENTARIO` varchar(1000) DEFAULT NULL,
  `FECHA_COMENTARIO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_COMENTARIO`),
  KEY `ID_NOTICIA` (`ID_NOTICIA`),
  CONSTRAINT `t_comentarios_ibfk_1` FOREIGN KEY (`ID_NOTICIA`) REFERENCES `t_noticias` (`ID_NOTICIA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_comentarios
-- ----------------------------

-- ----------------------------
-- Table structure for t_consecutivos
-- ----------------------------
DROP TABLE IF EXISTS `t_consecutivos`;
CREATE TABLE `t_consecutivos` (
  `NOMBRE` varchar(50) DEFAULT NULL,
  `CONSECUTIVO` bigint(20) DEFAULT NULL,
  `ID_PROYECTO` bigint(20) DEFAULT NULL,
  `ID_USUARIO` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_consecutivos
-- ----------------------------
INSERT INTO `t_consecutivos` VALUES ('ap', '11', '3', null);
INSERT INTO `t_consecutivos` VALUES ('ap', '1', '2', null);
INSERT INTO `t_consecutivos` VALUES ('ap', '1', '4', null);
INSERT INTO `t_consecutivos` VALUES ('ap', '1', '5', null);
INSERT INTO `t_consecutivos` VALUES ('ap', '1', '1', null);
INSERT INTO `t_consecutivos` VALUES ('GT', '2', null, '2');

-- ----------------------------
-- Table structure for t_cooperadores
-- ----------------------------
DROP TABLE IF EXISTS `t_cooperadores`;
CREATE TABLE `t_cooperadores` (
  `ID_COOPERADOR` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_AGENCIA` bigint(20) DEFAULT NULL,
  `NOMBRE_COOPERADOR` varchar(70) DEFAULT NULL,
  `DIRECCION_COOPERADOR` varchar(100) DEFAULT NULL,
  `TELEFONO_COOPERADOR` varchar(15) DEFAULT NULL,
  `CORREO_COOPERADOR` varchar(70) DEFAULT NULL,
  `CARGO` varchar(60) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_COOPERADOR`),
  KEY `ID_AGENCIA` (`ID_AGENCIA`),
  CONSTRAINT `t_cooperadores_ibfk_1` FOREIGN KEY (`ID_AGENCIA`) REFERENCES `t_agencias` (`ID_AGENCIA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_cooperadores
-- ----------------------------
INSERT INTO `t_cooperadores` VALUES ('1', '1', 'Jose Humberto Restrepo Pulgarín', 'Calle 44 # 52-165 Oficina 602', '3834136', '', 'Cooperador', '2015-11-06 05:39:05');
INSERT INTO `t_cooperadores` VALUES ('2', '2', 'Adriana Maria Gomez', 'Carrera 64C # 67-300', '3117619919', 'ayfbiemed@fiscalia.gov.co', 'Cooperadora', '2015-11-06 05:41:34');
INSERT INTO `t_cooperadores` VALUES ('3', '3', 'Juan Cesar Estrada R', 'Transveral 78 # 65-18', '3155746866', '', 'Cooperador', '2015-11-06 05:43:03');
INSERT INTO `t_cooperadores` VALUES ('4', '4', 'Yeiler Alberto Quintero Barco', 'Calle 56 # 41-90', '3122274014', 'yeileralbertoquinterbarco@fumc.edu.co', 'Docente', '2015-11-06 05:45:51');

-- ----------------------------
-- Table structure for t_dependencias
-- ----------------------------
DROP TABLE IF EXISTS `t_dependencias`;
CREATE TABLE `t_dependencias` (
  `DECANATURA_TITULO` int(1) DEFAULT NULL,
  `DECANATURA` varchar(255) DEFAULT NULL,
  `CP_TITULO` int(1) DEFAULT NULL,
  `CP` varchar(255) DEFAULT NULL,
  `CIAD_TITULO` int(1) DEFAULT NULL,
  `CIAD` varchar(255) DEFAULT NULL,
  `ADMISIONES_TITULO` int(1) DEFAULT NULL,
  `ADMISIONES` varchar(255) DEFAULT NULL,
  `FECHA_REGISTRO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_dependencias
-- ----------------------------
INSERT INTO `t_dependencias` VALUES ('1', 'Héctor Andrés Bucheli López', '0', 'Sonia Magdalena Welsh', '0', 'Cecilia Córdoba Córdoba', '0', 'Martha Luz Pulgarín', '2015-10-12');

-- ----------------------------
-- Table structure for t_destinatarios
-- ----------------------------
DROP TABLE IF EXISTS `t_destinatarios`;
CREATE TABLE `t_destinatarios` (
  `ID_DESTINATARIO` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_NOTICIA` bigint(20) DEFAULT NULL,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID_DESTINATARIO`),
  KEY `ID_NOTICIA` (`ID_NOTICIA`),
  CONSTRAINT `t_destinatarios_ibfk_1` FOREIGN KEY (`ID_NOTICIA`) REFERENCES `t_noticias` (`ID_NOTICIA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_destinatarios
-- ----------------------------

-- ----------------------------
-- Table structure for t_evaluacion_estudiante
-- ----------------------------
DROP TABLE IF EXISTS `t_evaluacion_estudiante`;
CREATE TABLE `t_evaluacion_estudiante` (
  `ID_EVALUACION_ESTUDIANTE` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PRACTICANTE` bigint(20) DEFAULT NULL,
  `R1` varchar(1) DEFAULT NULL,
  `R2` varchar(1) DEFAULT NULL,
  `FUNCION1` varchar(150) DEFAULT NULL,
  `FUNCION2` varchar(150) DEFAULT NULL,
  `FUNCION3` varchar(150) DEFAULT NULL,
  `FUNCION4` varchar(150) DEFAULT NULL,
  `R3` varchar(1) DEFAULT NULL,
  `RESP1` varchar(150) DEFAULT NULL,
  `R4` varchar(1) DEFAULT NULL,
  `R5` varchar(1) DEFAULT NULL,
  `R6` varchar(1) DEFAULT NULL,
  `R121` varchar(60) DEFAULT NULL,
  `R7` varchar(1) DEFAULT NULL,
  `RESP2` varchar(150) DEFAULT NULL,
  `R8` varchar(1) DEFAULT NULL,
  `RESP3` varchar(150) DEFAULT NULL,
  `R9` varchar(1) DEFAULT NULL,
  `R10` varchar(1) DEFAULT NULL,
  `DEBFOR` varchar(260) DEFAULT NULL,
  `METEST` varchar(260) DEFAULT NULL,
  `FD` varchar(380) DEFAULT NULL,
  PRIMARY KEY (`ID_EVALUACION_ESTUDIANTE`),
  KEY `t_evaluacion_estudiante_ibfk_1` (`ID_PRACTICANTE`),
  CONSTRAINT `t_evaluacion_estudiante_ibfk_1` FOREIGN KEY (`ID_PRACTICANTE`) REFERENCES `t_practicantes` (`ID_PRACTICANTE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_evaluacion_estudiante
-- ----------------------------
INSERT INTO `t_evaluacion_estudiante` VALUES ('1', '3', 'a', 'a', 'Analizar', 'Probar', 'Evaluar', 'Seleccionar software', 'a', 'Fundamentación en normas NIIF-UGPP y reglamentación sobre la seguridad social.', 'a', 'a', 'd', '', 'c', 'Esta basada en casos de la vida real', 'c', 'Completamente y afirma mis conocimientos técnicos y administrativos', 'a', 'b', 'readacción,documentación', 'Apoyo de diccionarios,auto estudio para mejorar competencias', 'Fundacmentación de normas NIIF y UGGP');
INSERT INTO `t_evaluacion_estudiante` VALUES ('2', '2', 'a', 'a', 'Hacer inventarios de elementos', 'Actualización de inventario de cada funcionario', 'Impresiones de inventario de elementos por funcionarios', '', 'b', 'Un poco más la redacción.', 'b', 'a', 'c', '', 'b', 'Realizo las labores que me ayudan a mi formación profesional.', 'c', 'Por la oportunidad de trabajo y pora terminar la carrea de ingeniería de sistemas.', 'a', 'c', 'Desconocimiento del tema,capcidad para captar las ordenes respecto a las labores', 'Terminar de la mejor manera la práctica,solicitar las ayudas asociadas,utilizar todos los medios disponibles', 'Fortaleza: La entrega del compromiso con las prácticas, Debilidad: desconocimiento de la labor.');
INSERT INTO `t_evaluacion_estudiante` VALUES ('3', '1', 'b', 'a', 'Levantamiento de requisitos', 'Entrevistas, Reuniones, Consolidación de la información', 'Informes, Bocetos', 'Entrega de boceto e informe final', 'b', 'Ciclo de vida de un programa, casos de levantamiento y requisitos', 'b', 'a', 'c', '', 'c', 'Porque te enfrentas a lo que vas a trabajar durante el resto de tu vida y te refuerza lo adquirido.', 'c', 'Me enfrento a un mundo aboral, prque me enseña o refuerza el conocimiento ya adquirido, porqie me enfrento a un mundo nuevo para mi, porque me brinda ', 'b', 'b', 'ciclo de vida del desarrollo de software,el tiempo del cooperador,buena su disposición cuando lo necesito,apoyo del asesor de prácticas', 'Dar lo mejor de mi para sacra el proyecto adelante,fortalecer mis falencias para aprender mucho más, dejarme guiar para hacer este trabajo un buen resultado final', 'El corto tiempo que se tiene, la ganas de trabajar y sacar adelante el proyecto, se cuenta con la ayuda del trabajo como el de la universidad, el poco tiempo con el que cuenta el cooperador, la disponibilidad y empeño  que se le pretende poner a este proyecto.');
INSERT INTO `t_evaluacion_estudiante` VALUES ('4', '7', 'a', 'a', 'Colaboración de la propuesta', 'Levantamiento de requerimientos', 'Análisis y diseño', 'Desarrollo de sistemas', 'b', ' ', 'b', 'a', 'd', '', 'c', ' ', 'c', 'Es una estrategia en donde analizo mis fortalezas.', 'a', 'b', 'Capicidad de análisis,debilidades en programación', 'desarrollo sistema de gestión,investigar y buscar asesorías de programación', ' ');
INSERT INTO `t_evaluacion_estudiante` VALUES ('5', '4', 'a', 'a', 'Analizar los requerimientos de la FI-FUMC para el diseño deun sistema de gestión para el desarrollo de competencias empresariales.', 'Diseñar un sistema de gestión', 'Implementar un sistema de gestión', '', 'a', 'Manejar major los conceptos atribuidos a herramientas y frameworks para el desarrollo de la aplicación o software, además de su manejo.', 'a', 'a', 'd', '', 'c', 'Es un reto que me he trazado con el fin de influir positivamenente mi experiencia profesional enfocado no solamente en el proceso de desarrollo y prog', 'c', 'Mojera y estimula el interés por la parte investigativa y mejora o fortalece.', 'b', 'b', 'Analizar requerimientos,tomar datos, descripción y desarrollo teórico e investigativo,debilidades: desarrollo y programacion', 'En base a las fortalezas que manejo, profundizar y crear ambientes que propicien actividades que mejores mis habilidades,colaboración brindada por el compañero Wbeimar Muñoz, quién tiene este tema como fortalez', 'Fortalezas: El de analizar requerimientos, toma de requerimientos, documentación, análisis, descripción y desarrollo teórico e investigativo, Debilidades: Desarrollo o programacion en base a las fortalezas que manejo, profundizar y crear ambientes que propicien a ejercer actividades que mejoren mis habilidades como programador.');
INSERT INTO `t_evaluacion_estudiante` VALUES ('6', '5', 'a', 'a', 'Análisis del planteamiento del proyecto', 'Formulación del formato de práctica empresarial', '', '', 'b', 'aplicar la realización del proyecto, haber tenido conocimientos en la parte del desarrollo de software', 'b', 'a', 'd', '', 'c', 'Debido a las exigencias y responsabilidades que plantea el proyecto', 'c', 'Por los conocimientos adquiridos y la responsabilidad que se requiere para llevarlo a cabo.', 'b', 'b', 'Poco conocimiento en desarrollo,disponibilidad en el momento reducido, formulación y análisis del formato de la modalidad', 'Ampliar conocimientos en la parte del desarrollo,presentación de proyectos de esta índole,ayudandome en el grupo de trabajo', 'Ene ste proyecto de prácticas tengo debilidad en el desarrollo y he buscado alternativas que me permitan tener un poco más de conocimiento al respecto.');
INSERT INTO `t_evaluacion_estudiante` VALUES ('7', '6', 'a', 'a', 'Tomar requerimientos', 'Desarrollar', 'Hacer manuales de usuario', '', 'a', 'Fortalecer e invertir moyor liderazgo para con el grupo.', 'a', 'a', 'b', '', 'c', 'Me ayuda a pulir y mejorar mis estrategias en la empresa.', 'b', 'Es un banco de experiencia adicional para mi futuro como ingeniero en sistemas.', 'a', 'b', 'Responsabilidad,compromisos,resolver conflictos,liderazgo', 'Reuniones en grupo,lectura de documentos,recolección de datos, gestión de la información', ' ');

-- ----------------------------
-- Table structure for t_gastos_transporte
-- ----------------------------
DROP TABLE IF EXISTS `t_gastos_transporte`;
CREATE TABLE `t_gastos_transporte` (
  `ID_GASTOS_TRANSPORTE` bigint(20) NOT NULL AUTO_INCREMENT,
  `FECHA_GASTO` varchar(60) DEFAULT NULL,
  `LUGAR` varchar(150) DEFAULT NULL,
  `ACTIVIDAD` varchar(255) DEFAULT NULL,
  `NUMERO_DESPLAZAMIENTOS` int(5) DEFAULT NULL,
  `VALOR_UNITARIO` int(6) DEFAULT NULL,
  `CONSECUTIVO` bigint(20) DEFAULT NULL,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID_GASTOS_TRANSPORTE`),
  KEY `ID_ASESOR` (`ID_ASESOR`),
  CONSTRAINT `t_gastos_transporte_ibfk_1` FOREIGN KEY (`ID_ASESOR`) REFERENCES `t_usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_gastos_transporte
-- ----------------------------
INSERT INTO `t_gastos_transporte` VALUES ('1', '2015-11-02', 'Bancolombia', 'diligenciar informes', '2', '1800', '1', '2');

-- ----------------------------
-- Table structure for t_links
-- ----------------------------
DROP TABLE IF EXISTS `t_links`;
CREATE TABLE `t_links` (
  `ID_LINK` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PRACTICANTE` bigint(20) DEFAULT NULL,
  `TIPO` varchar(2) DEFAULT NULL,
  `FINALIZADO` int(1) DEFAULT '0',
  `CONSECUTIVO` bigint(20) DEFAULT NULL,
  `FECHA_CADUCA` datetime DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_FINALIZA` datetime DEFAULT NULL COMMENT 'Fecha en la que el prcaticante evalua',
  PRIMARY KEY (`ID_LINK`),
  KEY `t_links_ibfk_1` (`ID_PRACTICANTE`),
  CONSTRAINT `t_links_ibfk_1` FOREIGN KEY (`ID_PRACTICANTE`) REFERENCES `t_practicantes` (`ID_PRACTICANTE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_links
-- ----------------------------
INSERT INTO `t_links` VALUES ('1', '3', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('2', '2', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('3', '1', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('4', '4', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('5', '5', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('6', '6', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');
INSERT INTO `t_links` VALUES ('7', '7', 'sp', '1', null, '2015-11-04 12:30:00', '2015-11-07 13:33:59', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_modalidad_practica
-- ----------------------------
DROP TABLE IF EXISTS `t_modalidad_practica`;
CREATE TABLE `t_modalidad_practica` (
  `ID_MODALIDAD_PRACTICA` int(2) NOT NULL AUTO_INCREMENT,
  `NOMBRE_MODALIDAD_PRACTICA` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`ID_MODALIDAD_PRACTICA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_modalidad_practica
-- ----------------------------
INSERT INTO `t_modalidad_practica` VALUES ('1', 'Validación de experiencia empresarial');

-- ----------------------------
-- Table structure for t_noticias
-- ----------------------------
DROP TABLE IF EXISTS `t_noticias`;
CREATE TABLE `t_noticias` (
  `ID_NOTICIA` bigint(20) NOT NULL AUTO_INCREMENT,
  `ASUNTO` varchar(150) DEFAULT NULL,
  `MENSAJE` varchar(1000) DEFAULT NULL,
  `FECHA_ENVIO` datetime DEFAULT NULL,
  `ENVIADO_POR` bigint(20) DEFAULT NULL,
  `FECHA_MODIFICA` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_NOTICIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_noticias
-- ----------------------------

-- ----------------------------
-- Table structure for t_practicantes
-- ----------------------------
DROP TABLE IF EXISTS `t_practicantes`;
CREATE TABLE `t_practicantes` (
  `ID_PRACTICANTE` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  `ID_COOPERADOR` bigint(20) DEFAULT NULL,
  `ID_PROYECTO` bigint(20) DEFAULT NULL,
  `ID_AGENCIA` bigint(20) DEFAULT NULL,
  `ID_PROGRAMA` int(2) DEFAULT NULL,
  `MOMENTO` int(1) DEFAULT '1',
  `ID_MODALIDAD_PRACTICA` int(2) DEFAULT NULL,
  `NOMBRE_PRACTICANTE` varchar(60) DEFAULT NULL,
  `CORREO_PRACTICANTE` varchar(70) DEFAULT NULL,
  `DOCUMENTO` varchar(20) DEFAULT NULL,
  `CELULAR` varchar(15) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `CODIGO` varchar(10) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICA` datetime DEFAULT NULL,
  `ID_USUARIO_MODIFICA` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PRACTICANTE`),
  KEY `ID_ASESOR` (`ID_ASESOR`),
  KEY `ID_COOPERADOR` (`ID_COOPERADOR`),
  KEY `ID_PROYECTO` (`ID_PROYECTO`),
  KEY `ID_AGENCIA` (`ID_AGENCIA`),
  KEY `ID_MODALIDAD_PRACTICA` (`ID_MODALIDAD_PRACTICA`),
  CONSTRAINT `t_practicantes_ibfk_1` FOREIGN KEY (`ID_ASESOR`) REFERENCES `t_usuarios` (`ID_USUARIO`),
  CONSTRAINT `t_practicantes_ibfk_2` FOREIGN KEY (`ID_COOPERADOR`) REFERENCES `t_cooperadores` (`ID_COOPERADOR`),
  CONSTRAINT `t_practicantes_ibfk_3` FOREIGN KEY (`ID_PROYECTO`) REFERENCES `t_proyectos` (`ID_PROYECTO`),
  CONSTRAINT `t_practicantes_ibfk_4` FOREIGN KEY (`ID_AGENCIA`) REFERENCES `t_agencias` (`ID_AGENCIA`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_practicantes
-- ----------------------------
INSERT INTO `t_practicantes` VALUES ('1', '2', '1', '1', '1', '1', '3', '1', 'Jose Alexander Torres Agudelo', 'josealexandertorresagudelo@fumc.edu.co', '1017166673', '3014116434', '2845702', '122026061', '2015-11-06 05:52:35', '2015-11-06 05:55:11', '1');
INSERT INTO `t_practicantes` VALUES ('2', '2', '2', '2', '2', '1', '3', '2', 'Jhon James Mosquera Palacios', 'jhonjamesmosquerapalacios@fumc.edu.co', '11111', '3116191581', '3116191581', '1', '2015-11-06 05:57:21', '2015-11-06 05:57:21', '1');
INSERT INTO `t_practicantes` VALUES ('3', '2', '3', '3', '3', '1', '3', '1', 'Jorge López González', 'jorgelopezgonzalez@fumc.edu.co', '11111', '3182856431', '3182856431', '1', '2015-11-06 05:59:17', '2015-11-06 05:59:17', '1');
INSERT INTO `t_practicantes` VALUES ('4', '2', '4', '5', '4', '1', '3', '2', 'Gustavo Antonio Arcila León', 'gustavoantonioarcilaleon@fumc.edu.co', '1128439055', '3158838305', '2521948', '08125024', '2015-11-06 06:00:26', '2015-11-06 06:00:26', '1');
INSERT INTO `t_practicantes` VALUES ('5', '2', '4', '5', '4', '1', '3', '2', 'Juan Darío Arenas Concha', 'juandarioarenasconcha@fumc.edu.co', '1128440588', '3016168710', '2551347', '09125028', '2015-11-06 06:01:39', '2015-11-06 06:01:39', '1');
INSERT INTO `t_practicantes` VALUES ('6', '2', '4', '5', '4', '1', '3', '2', 'Wbeimar Alexis Muñoz Carvajal', 'wbeimaralexismunozcarvajal@fumc.edu.co', '1128458286', '3128991097', '2211488', '1', '2015-11-06 06:03:24', '2015-11-06 06:03:24', '1');
INSERT INTO `t_practicantes` VALUES ('7', '2', '4', '4', '4', '1', '3', '2', 'David Enrique Mena Blandón', 'davidenriquemenablandon@fumc.edu.co', '1075192173', '3122457380', '5271779', '1', '2015-11-06 06:05:21', '2015-11-06 06:05:21', '1');

-- ----------------------------
-- Table structure for t_proyectos
-- ----------------------------
DROP TABLE IF EXISTS `t_proyectos`;
CREATE TABLE `t_proyectos` (
  `ID_PROYECTO` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_TIPO_PROYECTO` bigint(20) DEFAULT NULL,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  `NOMBRE_PROYECTO` varchar(255) DEFAULT NULL,
  `HORARIO` varchar(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `PERIODO` date DEFAULT NULL,
  PRIMARY KEY (`ID_PROYECTO`),
  KEY `ID_TIPO_PROYECTO` (`ID_TIPO_PROYECTO`),
  KEY `ID_ASESOR` (`ID_ASESOR`),
  CONSTRAINT `t_proyectos_ibfk_1` FOREIGN KEY (`ID_TIPO_PROYECTO`) REFERENCES `t_tipo_proyectos` (`ID_TIPO_PROYECTO`),
  CONSTRAINT `t_proyectos_ibfk_2` FOREIGN KEY (`ID_ASESOR`) REFERENCES `t_usuarios` (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_proyectos
-- ----------------------------
INSERT INTO `t_proyectos` VALUES ('1', '2', '2', 'Implementación de plataforma tecnológica para los practicantes', '2015/07/15 06:00 am', '2015-11-06 05:41:43', '2015-07-01');
INSERT INTO `t_proyectos` VALUES ('2', '3', '2', 'Inventario', '2015/07/15 06:00 am', '2015-11-06 05:42:41', '2015-07-01');
INSERT INTO `t_proyectos` VALUES ('3', '3', '2', 'Compra e implementación sistema ERP', '2015/07/16 06:00 am', '2015-11-06 05:42:59', '2015-07-01');
INSERT INTO `t_proyectos` VALUES ('4', '2', '2', 'Sistema de gestión del laboratorio FUMC', '2015/07/07 07:00 am', '2015-11-06 05:43:37', '2015-07-01');
INSERT INTO `t_proyectos` VALUES ('5', '2', '2', 'Sistema de gestión para el desarrollo de competencias empresariales', '2015/07/17 06:00 am', '2015-11-06 05:43:50', '2015-07-01');

-- ----------------------------
-- Table structure for t_registros
-- ----------------------------
DROP TABLE IF EXISTS `t_registros`;
CREATE TABLE `t_registros` (
  `ID_REGISTRO` bigint(20) NOT NULL AUTO_INCREMENT,
  `CONSECUTIVO` bigint(20) DEFAULT NULL,
  `TIPO` varchar(30) DEFAULT NULL,
  `ID_ASESOR` bigint(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `TOTAL` varchar(12) DEFAULT NULL,
  `MOMENTO_EVALUATIVO` int(2) DEFAULT NULL,
  `PERIODO` date DEFAULT NULL,
  PRIMARY KEY (`ID_REGISTRO`),
  KEY `ID_ASESOR` (`ID_ASESOR`),
  CONSTRAINT `t_registros_ibfk_1` FOREIGN KEY (`ID_ASESOR`) REFERENCES `t_usuarios` (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_registros
-- ----------------------------
INSERT INTO `t_registros` VALUES ('1', '1', 'GT', '2', '2015-11-17 16:08:07', '3600', null, '2015-07-01');

-- ----------------------------
-- Table structure for t_tipo_proyectos
-- ----------------------------
DROP TABLE IF EXISTS `t_tipo_proyectos`;
CREATE TABLE `t_tipo_proyectos` (
  `ID_TIPO_PROYECTO` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRE_TIPO_PROYECTO` varchar(60) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_TIPO_PROYECTO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_tipo_proyectos
-- ----------------------------
INSERT INTO `t_tipo_proyectos` VALUES ('1', 'Educativo', '2015-08-22 16:40:33');
INSERT INTO `t_tipo_proyectos` VALUES ('2', 'Desarrollo de software', '2015-08-22 16:41:58');
INSERT INTO `t_tipo_proyectos` VALUES ('3', 'Administrativo', '2015-11-06 05:42:27');

-- ----------------------------
-- Table structure for t_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `t_usuarios`;
CREATE TABLE `t_usuarios` (
  `ID_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `DOCUMENTO` varchar(20) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `CELULAR` varchar(15) DEFAULT NULL,
  `CORREO` varchar(60) DEFAULT NULL,
  `CLAVE` varchar(40) DEFAULT NULL,
  `NIVEL` int(1) DEFAULT '0',
  `FOTO` varchar(150) DEFAULT 'avatar.png',
  `PERIODO` date DEFAULT NULL,
  `ESTADO` int(1) DEFAULT '1',
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FACHA_ULTIMO_INICIO_SESION` datetime DEFAULT NULL,
  `FECHA_MODIFICA` datetime DEFAULT NULL,
  `ID_USUARIO_MODIFICA` bigint(20) DEFAULT NULL,
  `LOG_IN` int(1) DEFAULT '0',
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_usuarios
-- ----------------------------
INSERT INTO `t_usuarios` VALUES ('1', 'Alexis Munoz', null, null, null, 'Alexis', '0cc175b9c0f1b6a831c399e269772661', '2', 'avatar.png', null, '1', '2015-04-26 23:01:14', '2015-12-31 15:57:07', '2015-10-09 21:09:45', '1', '1');
INSERT INTO `t_usuarios` VALUES ('2', 'Alejandro Antonio Arenas Pulgarín', '9203111', '3232221', '3128991089', 'Alejandro', '0cc175b9c0f1b6a831c399e269772661', '0', '1441157476.png', '2016-01-01', '1', '2015-05-18 17:04:04', '2016-01-11 10:03:12', '2015-10-09 21:09:45', '1', '1');
