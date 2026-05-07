<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email'    => 'El campo :attribute debe ser una dirección de correo válida.',
    'unique'   => 'El valor del campo :attribute ya está en uso.',
    'min'      => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max'      => [
        'string' => 'El campo :attribute no debe ser mayor a :max caracteres.',
    ],
    'confirmed' => 'La confirmación de :attribute no coincide.',

    /*
    |--------------------------------------------------------------------------
    | Atributos Personalizados
    |--------------------------------------------------------------------------
    | Aquí mapeamos los nombres de los inputs (en inglés) a cómo queremos
    | que se lean en el mensaje de error en español.
    */
    'attributes' => [
        'name' => 'nombre completo',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'license_number' => 'número de matrícula',
        'institution' => 'institución',
        'terms' => 'términos y condiciones',
    ],
];
