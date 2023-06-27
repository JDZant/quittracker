<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\QuitAttempt;
use App\Models\Reason;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuitAttemptFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_quit_attempt_and_related_models()
    {
        // Create a test user
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);

        // Prepare the Livewire component
        Livewire::test(\App\Http\Livewire\QuitAttempt\SmokingData::class)
            ->set('start_date', '2023-06-27')
            ->set('cigarettes_per_day', 10)
            ->set('cost_per_pack', 5.99)
            ->set('nicotine_per_cigarette', 0.8)
            ->set('tar_per_cigarette', 10)
            ->set('cigarettes_per_pack', 20)
            ->call('store');

        // Assert that the quit attempt and related models are created in the database
        $this->assertDatabaseHas('quit_attempts', [
            'start_date' => '2023-06-27',
            'user_id' => $user->id,
        ]);


        $quitAttempt = QuitAttempt::first()->with('smokingData')->first();

        $this->assertDatabaseHas('smoking_data', [
            'quit_attempt_id' => $quitAttempt->id,
            // Assert other smoking data fields here
        ]);

//        TODO: ADDING REASONS TO TESTING

/*        // Define the selectedReasons array
        $selectedReasons = ['Reason 1', 'Reason 2'];

        foreach ($selectedReasons as $reason) {
            $this->assertDatabaseHas('reasons', [
                'quit_attempt_id' => $quitAttempt->id,
                'reason' => $reason,
                'type' => 1
            ]);
        }*/

        // Assert any other necessary assertions
    }
}

