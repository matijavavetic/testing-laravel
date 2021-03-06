<?php

use App\Article;

// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{
    // use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_trending_articles()
    {
        // Given
        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        // Wheen
        $articles = Article::trending();

        // Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(4, $articles);
    }
}
