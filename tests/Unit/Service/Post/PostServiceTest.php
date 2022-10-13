<?php

namespace Tests\Unit\Services\Post;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Services\Post\PostService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    public $postService;
    public $faker;

    public function __construct()
    {
        parent::__construct();
        $this->postService = new PostService;
        $this->faker = Factory::create();
    }

    public function createUser()
    {
        return User::factory()->for(Role::factory()->create())->create();
    }

    public function createPost($user)
    {
        return Post::factory()->for($user)->create();
    }

    public function createInputData()
    {
        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->sentence(),
        ];
    }

    public function testCreateServiceMethod()
    {
        $data = $this->createInputData();
        $user = $this->createUser();
        $data['user_id'] = $user->id;

        $this->postService->create($data);

        $this->assertDatabaseHas(
            'posts',
            [
                'slug' => $data['title'],
                'title' => $data['title'],
                'body' => $data['body'],
            ]
        );
    }

    public function testUpdateServiceMethod()
    {
        $user = $this->createUser();
        $post = $this->createPost($user);

        $data = $this->createInputData();
        $user = $this->createUser();
        $data['user_id'] = $user->id;
        $this->postService->update($data, $post);

        $this->assertDatabaseHas(
            'posts',
            [
                'slug' => $data['title'],
                'title' => $data['title'],
                'body' => $data['body'],
                'user_id' => $user->id,
            ]
        );
    }

    public function testDeleteServiceMethod()
    {
        $user = $this->createUser();
        $post = $this->createPost($user);

        $this->assertModelExists($post);

        $this->postService->delete($post);

        $this->assertModelMissing($post);
    }
}
