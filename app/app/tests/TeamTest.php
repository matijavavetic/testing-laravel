<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Team;
use App\User;

class TeamTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }
    /** @test */
    public function a_team_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2, $team->count());

        $this->setExpectedException('Exception');

        $user3 = factory(User::class)->create();
        $team->add($user3);

    }
}
