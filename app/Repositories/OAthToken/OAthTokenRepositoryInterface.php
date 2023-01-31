<?php
namespace App\Repositories\OAthToken;

interface OAthTokenRepositoryInterface
{
    public function getLast();

    public function createAccessToken($accessToken);
}
