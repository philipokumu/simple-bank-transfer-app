<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Transaction;

class BankTransferTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     /** @test */
    public function money_can_be_transferred_from_one_account_to_another()
    {
        $this->withoutExceptionHandling();

        $dbCount = Transaction::count() + 1;

        $this->post('/api/accounts/1/transactions', [
            'to' => 2,
            'amount' => 3,
            'details' => 'simple transaction'
        ]);

        $this->assertCount($dbCount,Transaction::all());

    }

        /** @test */
    public function to_is_required()
    {
        $response = $this->post('/api/accounts/1/transactions', [
            'to' => '',
            'amount' => 3,
            'details' => 'simple transaction'
        ]);

        $response->assertSessionHasErrors('to');
        
    }

    /** @test */
    public function amount_is_required()
    {
        $response = $this->post('/api/accounts/1/transactions', [
            'to' => 2,
            'amount' => '',
            'details' => 'simple transaction'
        ]);

        $response->assertSessionHasErrors('amount');
        
    }

    /** @test */
    public function details_is_required()
    {
        $response = $this->post('/api/accounts/1/transactions', [
            'to' => 2,
            'amount' => 2,
            'details' => ''
        ]);

        $response->assertSessionHasErrors('details');
        
    }

    /** @test */
    public function amount_is_not_less_than_one()
    {
        $response = $this->post('/api/accounts/1/transactions', [
            'to' => 2,
            'amount' => 0,
            'details' => 'Simple transaction'
        ]);

        $response->assertSessionHasErrors('amount');
        
    }

    /** @test */
    public function to_is_not_equal_to_id_sending()
    {
        $response = $this->post('/api/accounts/1/transactions', [
            'to' => 1,
            'amount' => 2,
            'details' => 'Simple transaction'
        ]);

        $response->assertSessionHasErrors('to');
        
    }
}
