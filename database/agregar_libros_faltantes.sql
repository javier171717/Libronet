-- Script para agregar contenido a los libros faltantes
USE libronet;

-- Actualizar "El Aleph"
UPDATE libros 
SET contenido_completo = 'La candente mañana de febrero en que Beatriz Viterbo murió, después de una imperiosa agonía que no se rebajó un solo instante ni al sentimentalismo ni al miedo, noté que las carteleras de fierro de la Plaza Constitución habían renovado no sé qué aviso de cigarrillos rubios; el hecho me dolió, pues comprendí que el incesante y vasto universo ya se apartaba de ella y que ese cambio era el primero de una serie infinita. Cambiará el universo pero yo no, pensé con melancólica vanidad; alguna vez, lo sé, mi vana devoción la había exasperado; muerta, yo podía consagrarme a su memoria, sin esperanza pero también sin humillación. Pensé que el treinta de abril era su cumpleaños; visitar su casa en la calle Garay ese día y saludar a su padre y a Carlos Argentino Daneri, su primo hermano, sería un acto de cortesía, irreprochable y tal vez necesario. Agregaría que esperaría en el crepúsculo, en el zaguán siempre sombrío, y que no examinaría con demasiada atención las circunstancias y los objetos, porque el hombre que viene de afuera no debe parecer un profanador.

Beatriz Viterbo era una mujer, una niña de claras prendas, que en 1929 llegó a su fin de un modo que para los griegos hubiera sido mágico; para mí, que la amé más que a mi madre, fue atroz. Beatriz Viterbo murió en 1929; desde entonces, no dejé de visitar su casa, en la calle Garay, el treinta de abril, día de su cumpleaños. Yo solía llegar a las siete y cuarto de la tarde y me demoraba unos veinticinco minutos; cada año subía un poco más tarde y me quedaba un poco más; en 1933, una lluvia torrencial me favoreció: tuvieron que invitarme a comer. No desaproveché esa buena fortuna. En 1934, llegué, ya con mi reloj adelantado, a las ocho y cuarto y no me fui hasta las diez. Así, en años melancólicos y vanamente lúbricos, logré graduar la simpatía de Carlos Argentino Daneri.

Beatriz era alta, frágil, muy ligeramente inclinada; había en su andar (si el oxímoron es tolerable) una como graciosa torpeza, un principio de éxtasis; Carlos Argentino es rosado, considerable, canoso, de rasgos finos. Ejerce no sé qué función subalterna en una biblioteca ilegible de los arrabales del Sur. Es autoritario pero también es ineficaz; hasta hace muy poco, solía visitarme, de noche, con alguna frecuencia; ahora un achaque en un ojo y la pereza lo recluyen. Hacia las nueve de la noche, con una suerte de desesperación, solía instalarse en mi casa. Cada visita suya era una manera de que yo no olvidara a Beatriz; su vanidad se complacía en la vana tarea de insinuar que yo me había enamorado de ella por compasión, por pobreza de imaginación.'
WHERE titulo = 'El Aleph';

-- Actualizar "El retrato de Dorian Gray"
UPDATE libros 
SET contenido_completo = 'El estudio estaba lleno del rico olor de las rosas, y cuando la brisa de verano soplaba entre los árboles abiertos del jardín, traía a través de la puerta abierta el pesado perfume de las lilas, o el aroma más delicado de las flores rosadas del espino.

Desde el rincón del diván de cuero persa sobre el que estaba tendido Lord Henry Wotton, fumando, como era su costumbre, innumerables cigarrillos, podía ver el dulce brillo como de miel de las flores de laburno, cuyas temblorosas ramas parecían apenas capaces de soportar la carga de una belleza tan flameante y ardiente; y de vez en cuando las fantásticas sombras de los pájaros en vuelo cruzaban las largas cortinas de seda que colgaban frente a la ventana abierta, produciendo una especie de momentáneo efecto japonés, y haciéndole pensar en esos pintores de Tokio de pálidos rostros de jade, que, por medio de un arte que es necesariamente inmóvil, procuran transmitir la sensación de velocidad y movimiento. El zumbido sordo de las abejas que se abrían paso a través de la alta hierba sin cortar, o revoloteaban con persistente monotonía alrededor de las hojas polvorientas y doradas de la madreselva, parecía hacer el silencio más opresivo. El sordo rugido de Londres era como el bajo de un órgano distante.

En el centro de la habitación, clavado a un caballete vertical, se alzaba el retrato de tamaño natural de un joven de extraordinaria belleza personal, y frente a él, a poca distancia, estaba sentado el propio artista, Basil Hallward, cuya repentina desaparición hace algunos años causó, en su momento, tan gran conmoción pública, y dio lugar a tantas extrañas conjeturas.

Mientras el pintor contemplaba la graciosa y hermosa imagen que había tan hábilmente reflejado en el lienzo, una sonrisa de placer pasó por su rostro, y pareció que se quedaba, como si se hubiera quedado. Pero de repente se estremeció, y cerró los ojos, colocando los dedos sobre los párpados, como si tratara de encerrar en su cerebro algún extraño sueño del que temía despertar.

"Es tu mejor obra, Basil, la mejor cosa que has hecho", dijo Lord Henry lánguidamente. "Debes enviarlo el año que viene a la Grosvenor. La Academia es demasiado grande y vulgar. Cada vez que he ido allí ha habido tantas personas que no he podido ver los cuadros, lo cual es horrible, o tantos cuadros que no he podido ver las personas, lo cual es peor. La Grosvenor es realmente el único lugar."

"No creo que lo envíe a ningún sitio", respondió él, echando la cabeza hacia atrás en esa extraña manera que solía hacer en Oxford. "No, no lo enviaré a ningún sitio."

Lord Henry levantó las cejas y lo miró con asombro a través de las delgadas espirales azules de humo que, enredadas como pétalos de rosa, salían de su cigarrillo pesadamente perfumado. "¿No lo enviarás a ningún sitio? Mi querido muchacho, ¿por qué no? ¿Qué razón tienes? Qué extraños sois vosotros, los pintores! Hacéis cualquier cosa para ganar reputación. En cuanto la tenéis, parece que queréis deshaceros de ella. Es una tontería, porque no hay nada en el mundo peor que ser hablado. Ser hablado es peor que ser ignorado. La fama degrada cada cosa que toca. Tiene algo de la naturaleza de lo físico, y nuestros mejores hombres mueren de ella como mueren de la tuberculosis."'
WHERE titulo = 'El retrato de Dorian Gray';

-- Verificar los cambios
SELECT id, titulo, 
       CASE 
           WHEN contenido_completo IS NOT NULL THEN 'SÍ'
           ELSE 'NO'
       END as tiene_contenido
FROM libros 
WHERE titulo IN ('El Aleph', 'El retrato de Dorian Gray')
ORDER BY id; 