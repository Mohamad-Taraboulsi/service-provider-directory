<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    use RefreshDatabase;

    // Postive Cases

    /** @test */
    public function it_displays_all_providers_and_categories()
    {

        $category = Category::factory()->create();
        $providers = Provider::factory()->count(3)->create(['category_id' => $category->id]);

        $response = $this->get('/providers');

        $response->assertStatus(200);
        $response->assertSee($providers->first()->name);
        $response->assertViewHas('categories');
        $response->assertViewHas('providers');
    }

    /** @test */
    public function it_filters_providers_by_category()
    {

        $cat1 = Category::factory()->create(['name' => 'tech']);
        $cat2 = Category::factory()->create(['name' => 'finance']);
        $provider1 = Provider::factory()->create(['category_id' => $cat1->id]);
        $provider2 = Provider::factory()->create(['category_id' => $cat2->id]);

        $response = $this->get('/providers?category=tech');

        $response->assertStatus(200);
        $response->assertSee($provider1->name);
        $response->assertDontSee($provider2->name);
    }

    /** @test */
    public function it_caches_categories_forever()
    {

        Cache::flush();
        Category::factory()->count(2)->create();

        $this->assertFalse(Cache::has('categories_list'));

        $this->get('/providers');

        $this->assertTrue(Cache::has('categories_list'));
    }

    /** @test */
    public function it_caches_providers_by_category_name()
    {

        Cache::flush();
        $category = Category::factory()->create(['name' => 'tech']);
        Provider::factory()->count(2)->create(['category_id' => $category->id]);

        $this->assertFalse(Cache::has('providers_category_tech'));

        $this->get('/providers?category=tech');

        $this->assertTrue(Cache::has('providers_category_tech'));
    }

    /** @test */
    public function it_displays_a_single_provider_profile()
    {

        $provider = Provider::factory()->create();

        $response = $this->get(route('providers.show', $provider));

        $response->assertStatus(200);
        $response->assertSee($provider->name);
    }

    // Negative Cases

    /** @test */
    public function it_returns_no_providers_for_nonexistent_category()
    {
        Category::factory()->create(['name' => 'tech']);
        Provider::factory()->create();

        $response = $this->get('/providers?category=WRONG');

        $response->assertStatus(302);
        $response->assertDontSeeText('tech');
    }

    /** @test */
    public function it_returns_404_for_nonexistent_provider()
    {
        $nonExistentId = 9999;

        $response = $this->get("/providers/{$nonExistentId}");

        $response->assertStatus(404);
    }

    /** @test */
    public function it_fails_validation_if_category_param_is_not_a_string()
    {
        $response = $this->get('/providers?category[]=array');

        $response->assertStatus(302);
        $response->assertSessionHasErrors('category');
    }
}
