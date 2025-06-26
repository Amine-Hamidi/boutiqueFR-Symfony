<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/register');

        $client->submitForm("S'inscrire",[
            'user_form_type_form[firstname]' => 'nesrine',
            'user_form_type_form[lastname]' => 'attalah',
            'user_form_type_form[email]' => 'nesrine.attalah@test.fr',
            'user_form_type_form[plainPassword][first]' => '012345678',
            'user_form_type_form[plainPassword][second]' => '012345678',
        ]);
        $this->assertResponseRedirects('/connexion');
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("Votre compte est correctement créé, veuillez vous connecter.")');

    }
}
