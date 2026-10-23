<?php

namespace Tests\Feature;

use App\Models\Pizza;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PizzaManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_panel(): void
    {
        $response = $this->get(route('admin.pizzas.index'));

        $response->assertRedirectToRoute('login');
    }

    public function test_authenticated_user_can_access_admin_panel(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.pizzas.index'));

        $response->assertOk();
    }

    public function test_public_menu_only_shows_available_pizzas(): void
    {
        Pizza::create([
            'name' => 'Pizza disponible',
            'description' => 'Pizza de prueba disponible.',
            'price' => 12.50,
            'is_available' => true,
        ]);

        Pizza::create([
            'name' => 'Pizza agotada',
            'description' => 'Pizza de prueba agotada.',
            'price' => 14.00,
            'is_available' => false,
        ]);

        $response = $this->get(route('pizzas.index'));

        $response->assertOk();
        $response->assertSee('Pizza disponible');
        $response->assertDontSee('Pizza agotada');
    }

    public function test_invalid_pizza_price_is_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.pizzas.store'), [
                'name' => 'Pizza inválida',
                'description' => 'Descripción de prueba.',
                'price' => -5,
                'image_url' => '',
            ]);

        $response->assertSessionHasErrors('price');

        $this->assertDatabaseMissing('pizzas', [
            'name' => 'Pizza inválida',
        ]);
    }
    
public function test_authenticated_user_can_create_a_pizza(): void
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.pizzas.store'), [
            'name' => 'Pizza Test',
            'description' => 'Tomate, mozzarella y albahaca.',
            'price' => 12.50,
            'image_url' => '',
        ]);

    $response->assertRedirectToRoute('admin.pizzas.index');

    $this->assertDatabaseHas('pizzas', [
        'name' => 'Pizza Test',
        'price' => 12.50,
        'is_available' => true,
    ]);
}

public function test_authenticated_user_can_edit_a_pizza(): void
{
    $user = User::factory()->create();

    $pizza = Pizza::create([
        'name' => 'Pizza Original',
        'description' => 'Descripción original.',
        'price' => 10.00,
        'is_available' => true,
    ]);

    $response = $this->actingAs($user)
        ->put(route('admin.pizzas.update', $pizza), [
            'name' => 'Pizza Modificada',
            'description' => 'Descripción actualizada.',
            'price' => 15.50,
            'image_url' => '',
        ]);

    $response->assertRedirectToRoute('admin.pizzas.index');

    $this->assertDatabaseHas('pizzas', [
        'id' => $pizza->id,
        'name' => 'Pizza Modificada',
        'price' => 15.50,
    ]);
}

public function test_authenticated_user_can_delete_a_pizza(): void
{
    $user = User::factory()->create();

    $pizza = Pizza::create([
        'name' => 'Pizza Para Eliminar',
        'description' => 'Pizza de prueba.',
        'price' => 11.00,
        'is_available' => true,
    ]);

    $response = $this->actingAs($user)
        ->delete(route('admin.pizzas.destroy', $pizza));

    $response->assertRedirectToRoute('admin.pizzas.index');

    $this->assertDatabaseMissing('pizzas', [
        'id' => $pizza->id,
    ]);
}

public function test_authenticated_user_can_toggle_pizza_availability(): void
{
    $user = User::factory()->create();

    $pizza = Pizza::create([
        'name' => 'Pizza Para Desactivar',
        'description' => 'Pizza de prueba.',
        'price' => 13.00,
        'is_available' => true,
    ]);

    $response = $this->actingAs($user)
        ->patch(route('admin.pizzas.toggle-availability', $pizza));

    $response->assertRedirectToRoute('admin.pizzas.index');

    $this->assertDatabaseHas('pizzas', [
        'id' => $pizza->id,
        'is_available' => false,
    ]);
}

public function test_guest_cannot_create_pizzas(): void
{
    $response = $this->post(route('admin.pizzas.store'), [
        'name' => 'Pizza No Autorizada',
        'description' => 'Intento de creación sin iniciar sesión.',
        'price' => 12.50,
        'image_url' => '',
    ]);

    $response->assertRedirectToRoute('login');

    $this->assertDatabaseMissing('pizzas', [
        'name' => 'Pizza No Autorizada',
    ]);
}

public function test_guest_cannot_edit_pizzas(): void
{
    $pizza = Pizza::create([
        'name' => 'Pizza Protegida',
        'description' => 'Descripción original.',
        'price' => 10.00,
        'is_available' => true,
    ]);

    $response = $this->put(route('admin.pizzas.update', $pizza), [
        'name' => 'Pizza Modificada Sin Permiso',
        'description' => 'Intento de modificación.',
        'price' => 20.00,
        'image_url' => '',
    ]);

    $response->assertRedirectToRoute('login');

    $this->assertDatabaseHas('pizzas', [
        'id' => $pizza->id,
        'name' => 'Pizza Protegida',
        'price' => 10.00,
    ]);
}

public function test_guest_cannot_delete_pizzas(): void
{
    $pizza = Pizza::create([
        'name' => 'Pizza Que Debe Seguir',
        'description' => 'Pizza de prueba.',
        'price' => 11.00,
        'is_available' => true,
    ]);

    $response = $this->delete(
        route('admin.pizzas.destroy', $pizza)
    );

    $response->assertRedirectToRoute('login');

    $this->assertDatabaseHas('pizzas', [
        'id' => $pizza->id,
        'name' => 'Pizza Que Debe Seguir',
    ]);
}

}
