<?php

function montaAlert($status, $texto) {
    switch ($status) {
        Case 0://Sucesso
            $icone = "bx bxs-check-circle";
            $classe = "success";
            break;
        Case 1://Erro
            $icone = "bx bxs-x-circle";
            $classe = "danger";
            break;
        Case 2://Cuidado
            $icone = "bx bxs-error";
            $classe = "warning";
            break;
        Case 3://Info
            $icone = "bx bx-error-circle";
            $classe = "info";
            break;
    }
    return '<div style="font-size: 15px;" class="alert alert-' . $classe . ' alert-dismissible" role="alert">
                    <i style="font-size: 19px;" class="' . $icone . '"></i> ' . $texto . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script type="text/javascript">
                window.setTimeout(function () {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                        $(this).remove();
                    });
                }, 9000);
            </script>';
};

function dataBuscaBanco($dt) {
    $data = explode("-", $dt); //[2019][06][29]
    $data = array_reverse($data); // [29][06][2019]
    $dt = implode("/", $data);
    return $dt; // 29/06/2019
}

function dataBanco($dt) {
    $data = explode("/", $dt); //[29][06][2019]
    $data = array_reverse($data); // [2019][06][29]
    $dt = implode("-", $data);
    return $dt; // 2019/0629/
}
