<?php

namespace App\Tests\E2E;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddButtonTest extends WebTestCase
{
    public function testAddButtonDoesNotExistWhenUserIsNotLoggedIn(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/series');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorNotExists('.btn.btn-dark.mb-3');
    }

    public function testAddButtonNotExistWhenUserIsLoggedIn()
    {
        $client = static::createClient();
        $container = static::getContainer();
        $userRepository = $container->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'email@example.com']);
        $client->loginUser($user);
        $crawler = $client->request('GET', '/series');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.btn.btn-dark.mb-3');
    }
}
