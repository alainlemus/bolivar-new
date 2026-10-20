<?php

return [

    /*
    | Planes funerarios: sección del home, página /planes, menú, pie de página y sitemap.
    | Apagado a petición del cliente; los planes siguen en la base y en el panel.
    | Para volver a mostrarlos: SHOW_PLANS=true en el .env y limpiar la caché de configuración.
    */
    'plans_enabled' => (bool) env('SHOW_PLANS', false),

];
