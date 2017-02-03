<?php

class StatsContollerTest extends TestCase
{

    public function provide_pulse()
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
     * @dataProvider provide_pulse
     */
    public function test_pulse($input)
    {
        $this->json('post', 'api/stats/pulse', $input)
            ->seeJson($input); 

    }


    public function provide_pulse_uid()
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
     * @dataProvider provide_pulse_uid
     */
    public function test_pulse_uid($input)
    {
        $this->json('post', 'api/stats/pulse', $input)
            ->seeJson($input); 

    }

    public function provide_pulse_validation_error()
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
     * @dataProvider provide_pulse_validation_error
     */
    public function test_pulse_validation_error($input)
    {
        $this->post('api/stats/pulse', $input)
            ->seeJsonStructure([
                'Error'
            ]);

    }

}