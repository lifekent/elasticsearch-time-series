<?php

class StatsContollerTest extends TestCase
{

    public function providePulse()
    {
        $input = [
            'event'     => 'ad.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input]
        ];
    }


    /**
     * @dataProvider providePulse
     */
    public function testPulse($input)
    {
        $this->json('post', 'api/stats/pulse', $input)
            ->seeJson($input); 

    }


    public function providePulseUID()
    {
        $input = [
            'id'        => 123,
            'event'     => 'ad.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input]
        ];
    }


    /**
     * @dataProvider providePulseUID
     */
    public function testPulseUID($input)
    {
        $this->json('post', 'api/stats/pulse', $input)
            ->seeJson($input); 

    }

    public function providePulseValidationError()
    {
        $input = [
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input]
        ];
    }


    /**
     * @dataProvider providePulseValidationError
     */
    public function testPulseValidationError($input)
    {
        $this->post('api/stats/pulse', $input)
            ->seeJsonStructure([
                'Error'
            ]);

    }

}