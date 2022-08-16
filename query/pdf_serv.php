<?php

move_uploaded_file(
    $_FILES['pdf']['tmp_name'], 
        //cambiar en el futuro SUPER IMPORTANTEEEEE
    $_SERVER['DOCUMENT_ROOT'] . "/MM/reportesgenerados/".$_GET['num_folio'].".pdf"
);