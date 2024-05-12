<?php

namespace Tests;

use Tests\TestCase;

class AccountApiTest extends TestCase
{
    /**
     * @test
     */
    public function test_reset_application()
    {
        $response = $this->post('/reset');
        $response
            ->assertOk(200)
            ->assertContent('OK');
    }

    /**
     * @test
     *
     * @depends test_reset_application
     */
    public function test_get_balance_for_non_existing_account()
    {
        $response = $this->get('/balance?account_id=1');
        $response
            ->assertNotFound(404)
            ->assertContent("0");
    }

    /**
     * @test
     *
     * @depends test_reset_application
     */
    public function test_withdraw_from_non_existing_account()
    {
        $response = $this->post('/event', [
            'origin' => "1",
            'amount' => 100,
            'type'   => 'withdraw'
        ]);

        $response
            ->assertNotFound()
            ->assertContent("0");
    }

    /**
     * @test
     *
     * @depends test_reset_application
     */
    public function test_transfer_from_non_existing_account()
    {
        $response = $this->post('/event', [
            'type'        => 'transfer',
            'origin'      => "1",
            'amount'      => 100,
            'destination' => "2",
        ]);

        $response
            ->assertNotFound()
            ->assertContent("0");
    }

    /**
     * @test
     *
     * @depends test_reset_application
     */
    public function create_account_by_deposit()
    {
        $response = $this->post('/event', [
            'destination' => "1",
            'amount'      => 100,
            'type'        => 'deposit'
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'destination' => [
                    'id'      => '1',
                    'balance' => 100
                ]
            ]);
    }

    /**
     * @test
     *
     * @depends create_account_by_deposit
     */
    public function test_get_balance_for_existing_account()
    {
        $response = $this->get('/balance?account_id=1');
        $response->assertOk();
    }

    /**
     * @test
     *
     * @depends create_account_by_deposit
     */
    public function test_deposit_into_existing_account()
    {
        $response = $this->post('/event', [
            'destination' => "1",
            'amount'      => 100,
            'type'        => 'deposit'
        ]);

        $response->assertSuccessful()->assertJson([
            'destination' => [
                'id'      => '1',
                'balance' => 200
            ]
        ]);
    }

    /**
     * @test
     *
     * @depends create_account_by_deposit
     */
    public function test_withdraw_from_existing_account()
    {
        $response = $this->post('/event', [
            'origin' => "1",
            'amount' => 50,
            'type'   => 'withdraw'
        ]);

        $response
            ->assertSuccessful()
            ->assertJson([
                'origin' => [
                    'id'      => '1',
                    'balance' => 150
                ]
            ]);
    }

    /**
     * @test
     *
     * @depends create_account_by_deposit
     */
    public function test_transfer_from_existing_account()
    {
        $response = $this->post('/event', [
            'origin'      => "1",
            'destination' => "2",
            'amount'      => 50,
            'type'        => 'transfer'
        ]);

        $response
            ->assertSuccessful()
            ->assertJson([
                'origin' => [
                    'id'      => '1',
                    'balance' => 100
                ],
                'destination' => [
                    'id'      => '2',
                    'balance' => 50
                ]
            ]);
    }
}
