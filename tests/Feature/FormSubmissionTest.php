<?php

test('la página de inicio responde correctamente', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
