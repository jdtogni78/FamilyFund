<?php
namespace Tests\Feature;

use App\Mail\FundQuarterlyReport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Tests\DataFactory;

class FundReportTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public $startDt;
    public $endDt;
    public $fund;
    public array $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->startDt = '2022-01-01';
        $this->endDt   = '2022-03-01';
        $this->verbose = false;
    }

    public function testEmail()
    {
        $factory = new DataFactory();
        $factory->createFundWithMatching();
        $fund = $this->fund = $factory->fund;
        $factory->fundAccount->email_cc = $email = "jtogni@gmail.com";
        $factory->fundAccount->save();
        $factory->createAssetWithPrice();
        $factory->createAssetWithPrice();

        Mail::fake();
        $this->postAPI();
        Mail::assertSent(FundQuarterlyReport::class, function ($mail) use ($email, $fund) {
            return $mail->fund->id === $fund->id &&
                $mail->hasTo($email);
        });


        $factory->fundAccount->email_cc = null;
        $factory->fundAccount->save();

        Mail::fake();
        $this->postAPI('ADM', 415);
        Mail::assertNotSent(FundQuarterlyReport::class);


        Mail::fake();
        $email = $factory->userAccount->email_cc;
        $factory->userAccount->email_cc = null;
        $factory->userAccount->save();
        $this->postAPI('REG', 415);
        Mail::assertNotSent(FundQuarterlyReport::class);

        Mail::fake();
        $factory->userAccount->email_cc = $email;
        $factory->userAccount->save();
        $this->postAPI('REG');
        Mail::assertSent(FundQuarterlyReport::class, $this->validateEmail($email, $fund));


        Mail::fake();
        $factory->createUser();
        $factory->createAccountMatching();
        $email2 = $factory->userAccount->email_cc;
        $factory->createTransactionWithMatching();
        $this->postAPI('REG');
        Mail::assertSent(FundQuarterlyReport::class, $this->validateEmail($email, $fund));
        Mail::assertSent(FundQuarterlyReport::class, $this->validateEmail($email2, $fund));
    }

    protected function postAPI($type = 'ADM', $code=200): mixed
    {
        $this->post = [
            'fund_id'   => $this->fund->id,
            'type'      => $type,
            'start_dt'  => $this->startDt,
            'end_dt'    => $this->endDt,
        ];

        if ($this->verbose) print_r("*** POST ".json_encode($this->post)."\n");
        $this->response = $this->json(
            'POST',
            '/api/fund_reports/', $this->post
        );

        $response = json_decode($this->response->getContent(), true);
        if ($this->verbose) print_r("response: " . json_encode($response,JSON_PRETTY_PRINT) . "\n");

        if ($code == 200)
            $this->assertApiSuccess();
        else
            $this->assertApiError($code);

        return $response;
    }

    public function validateEmail($email, $fund): \Closure
    {
        return function ($mail) use ($email, $fund) {
            return $mail->fund->id === $fund->id &&
                $mail->hasTo($email);
        };
    }
}
